<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;
use Throwable;

class ImportGeojsonFeatures extends Command
{
    protected $signature = 'geojson:import {--file= : Import one file from public/geojson}';

    protected $description = 'Import GeoJSON features from public/geojson into the database';

    public function handle(): int
    {
        $directory = public_path('geojson');
        $requestedFile = $this->option('file');

        if ($requestedFile) {
            $fileName = basename($requestedFile);
            if (!str_ends_with(strtolower($fileName), '.geojson')) {
                $fileName .= '.geojson';
            }

            $files = ["{$directory}/{$fileName}"];
        } else {
            $files = glob("{$directory}/*.geojson") ?: [];
        }

        if ($files === []) {
            $this->error('Tidak ada file GeoJSON yang ditemukan di public/geojson.');

            return self::FAILURE;
        }

        $totalProcessed = 0;

        foreach ($files as $filePath) {
            $sourceFile = basename($filePath);

            try {
                if (!is_file($filePath)) {
                    throw new RuntimeException("File {$sourceFile} tidak ditemukan.");
                }

                $contents = file_get_contents($filePath);
                if ($contents === false) {
                    throw new RuntimeException("File {$sourceFile} tidak dapat dibaca.");
                }

                $collection = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
                if (($collection['type'] ?? null) !== 'FeatureCollection' || !is_array($collection['features'] ?? null)) {
                    throw new RuntimeException("{$sourceFile} bukan GeoJSON FeatureCollection yang valid.");
                }

                $processed = 0;

                DB::transaction(function () use ($collection, $sourceFile, &$processed): void {
                    foreach (array_chunk($collection['features'], 1) as $features) {
                        $rows = [];
                        $timestamp = now();

                        foreach ($features as $feature) {
                            if (!is_array($feature) || ($feature['type'] ?? null) !== 'Feature') {
                                throw new RuntimeException("{$sourceFile} berisi fitur GeoJSON yang tidak valid.");
                            }

                            $properties = $feature['properties'] ?? null;
                            $geometry = $feature['geometry'] ?? null;

                            if ($properties !== null && !is_array($properties)) {
                                throw new RuntimeException("Properti fitur di {$sourceFile} harus berupa objek atau null.");
                            }

                            if ($geometry !== null && !is_array($geometry)) {
                                throw new RuntimeException("Geometri fitur di {$sourceFile} harus berupa objek atau null.");
                            }

                            $rawId = $feature['id'] ?? ($properties['FID'] ?? null);
                            $featureId = is_scalar($rawId) ? (string) $rawId : null;
                            $encodedFeature = json_encode(
                                $feature,
                                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION
                            );
                            $featureKey = hash('sha256', $featureId === null ? $encodedFeature : "id:{$featureId}");

                            $rows[] = [
                                'source_file' => $sourceFile,
                                'feature_id' => $featureId,
                                'feature_key' => $featureKey,
                                'geometry_type' => is_string($geometry['type'] ?? null) ? $geometry['type'] : null,
                                'geometry' => $geometry === null ? null : json_encode(
                                    $geometry,
                                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION
                                ),
                                'properties' => $properties === null ? null : json_encode(
                                    $properties,
                                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION
                                ),
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        }

                        if ($rows !== []) {
                            DB::table('geojson_features')->upsert(
                                $rows,
                                ['source_file', 'feature_key'],
                                ['feature_id', 'geometry_type', 'geometry', 'properties', 'updated_at']
                            );
                            $processed += count($rows);
                        }
                    }
                });

                $totalProcessed += $processed;
                $this->info("{$sourceFile}: {$processed} fitur diproses.");
            } catch (JsonException|RuntimeException $exception) {
                $this->error("{$sourceFile}: {$exception->getMessage()}");

                return self::FAILURE;
            } catch (Throwable $exception) {
                $this->error("Gagal mengimpor {$sourceFile}: {$exception->getMessage()}");

                return self::FAILURE;
            }
        }

        $this->info("Selesai. Total {$totalProcessed} fitur diproses.");

        return self::SUCCESS;
    }
}