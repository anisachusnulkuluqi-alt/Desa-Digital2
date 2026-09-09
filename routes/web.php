<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;

Route::resource('desa', DesaController::class);

Route::get('/', function () {
    return view('welcome');
});
