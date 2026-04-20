<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts     = Berita::count();
        $totalDocuments = Dokumen::count();
        $totalAdmins    = User::count();

        // Visitor stats placeholder — replace with your analytics source
        $visitorStats = [
            'today'     => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
            'thisMonth' => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
            'thisYear'  => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
            'homepage'  => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
        ];

        // Chart: last 30 days post counts by created_at date
        $chartData = Berita::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn($row) => [
                'date'  => \Carbon\Carbon::parse($row->date)->format('d M'),
                'total' => $row->total,
            ])
            ->toArray();

        return view('admin.dashboard', compact(
            'totalPosts',
            'totalDocuments',
            'totalAdmins',
            'visitorStats',
            'chartData',
        ));
    }
}
