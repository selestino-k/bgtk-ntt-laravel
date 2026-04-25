<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Jenssegers\Agent\Agent;
use Throwable;

class ViewCounterService
{
    private const DEDUP_TTL = 3600;       // 1 hour deduplication window
    private const DAILY_TTL  = 86400 * 35; // Keep daily keys for 35 days

    private Agent $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    /**
     * Record a page view.
     *
     * @param  string  $pageKey  e.g. 'homepage' or 'berita:42'
     * @param  string  $ip       visitor IP address
     */
    public function record(string $pageKey, string $ip): void
    {
        try {
            $redis = Redis::connection('upstash');

            // Deduplicate: one count per IP per page per hour
            $dedupKey = 'viewed:' . $pageKey . ':' . md5($ip);
            if ($redis->get($dedupKey)) {
                return;
            }
            $redis->setex($dedupKey, self::DEDUP_TTL, 1);

            $device  = $this->agent->isMobile() ? 'mobile' : 'desktop';
            $date    = now()->format('Y-m-d');
            $month   = now()->format('Y-m');
            $year    = now()->format('Y');

            // Page-specific all-time counters
            $redis->incr("views:{$pageKey}:total");
            $redis->incr("views:{$pageKey}:{$device}");

            // Aggregate daily counters (auto-expire after 35 days)
            $dailyTotal  = "views:all:daily:{$date}:total";
            $dailyDevice = "views:all:daily:{$date}:{$device}";
            $redis->incr($dailyTotal);
            $redis->incr($dailyDevice);
            $redis->expire($dailyTotal,  self::DAILY_TTL);
            $redis->expire($dailyDevice, self::DAILY_TTL);

            // Monthly counters
            $redis->incr("views:all:monthly:{$month}:total");
            $redis->incr("views:all:monthly:{$month}:{$device}");

            // Yearly counters
            $redis->incr("views:all:yearly:{$year}:total");
            $redis->incr("views:all:yearly:{$year}:{$device}");
        } catch (Throwable) {
            // Fail silently — never let analytics break the page
        }
    }

    /**
     * Get all-time view counts for a specific page.
     */
    public function getPageViews(string $pageKey): array
    {
        try {
            $redis = Redis::connection('upstash');

            return [
                'total'   => (int) ($redis->get("views:{$pageKey}:total")   ?? 0),
                'mobile'  => (int) ($redis->get("views:{$pageKey}:mobile")  ?? 0),
                'desktop' => (int) ($redis->get("views:{$pageKey}:desktop") ?? 0),
            ];
        } catch (Throwable) {
            return ['total' => 0, 'mobile' => 0, 'desktop' => 0];
        }
    }

    /**
     * Get aggregated visitor stats for the admin dashboard.
     */
    public function getVisitorStats(): array
    {
        try {
            $redis = Redis::connection('upstash');

            $today = now()->format('Y-m-d');
            $month = now()->format('Y-m');
            $year  = now()->format('Y');

            return [
                'today' => [
                    'total'   => (int) ($redis->get("views:all:daily:{$today}:total")   ?? 0),
                    'mobile'  => (int) ($redis->get("views:all:daily:{$today}:mobile")  ?? 0),
                    'desktop' => (int) ($redis->get("views:all:daily:{$today}:desktop") ?? 0),
                ],
                'thisMonth' => [
                    'total'   => (int) ($redis->get("views:all:monthly:{$month}:total")   ?? 0),
                    'mobile'  => (int) ($redis->get("views:all:monthly:{$month}:mobile")  ?? 0),
                    'desktop' => (int) ($redis->get("views:all:monthly:{$month}:desktop") ?? 0),
                ],
                'thisYear' => [
                    'total'   => (int) ($redis->get("views:all:yearly:{$year}:total")   ?? 0),
                    'mobile'  => (int) ($redis->get("views:all:yearly:{$year}:mobile")  ?? 0),
                    'desktop' => (int) ($redis->get("views:all:yearly:{$year}:desktop") ?? 0),
                ],
                'homepage' => $this->getPageViews('homepage'),
            ];
        } catch (Throwable) {
            return [
                'today'     => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
                'thisMonth' => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
                'thisYear'  => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
                'homepage'  => ['total' => 0, 'mobile' => 0, 'desktop' => 0],
            ];
        }
    }

    /**
     * Get daily visitor totals for the last N days (for charts).
     */
    public function getDailyChartData(int $days = 30): array
    {
        try {
            $redis = Redis::connection('upstash');
            $data  = [];

            for ($i = $days - 1; $i >= 0; $i--) {
                $date  = now()->subDays($i)->format('Y-m-d');
                $label = now()->subDays($i)->format('d M');
                $total = (int) ($redis->get("views:all:daily:{$date}:total") ?? 0);
                $data[] = ['date' => $label, 'total' => $total];
            }

            return $data;
        } catch (Throwable) {
            return [];
        }
    }
}
