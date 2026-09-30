<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatistics;

class DashboardController extends Controller
{
    public function index(DashboardStatistics $statistics)
    {
        return view('admin.dashboard', $statistics->counts());
    }
}