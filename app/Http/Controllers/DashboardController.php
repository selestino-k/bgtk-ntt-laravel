<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\User;
use App\Services\ViewCounterService;

class DashboardController extends Controller
{
    public function index(ViewCounterService $counter)
    {
        $totalPosts     = Berita::count();
        $totalDocuments = Dokumen::count();
        $totalAdmins    = User::count();

        $visitorStats = $counter->getVisitorStats();

        // Chart: last 30 days visitor counts from Redis
        $chartData = $counter->getDailyChartData(30);

        return view('admin.dashboard', compact(
            'totalPosts',
            'totalDocuments',
            'totalAdmins',
            'visitorStats',
            'chartData',
        ));
    }
}
