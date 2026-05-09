<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Throwable;

class RedisTestCommand extends Command
{
    protected $signature = 'redis:test {--connection=local : The Redis connection to test}';

    protected $description = 'Diagnose the Redis connection (useful for cPanel environments)';

    public function handle(): int
    {
        $connection = $this->option('connection');

        $this->info('PHP Redis extension loaded: ' . (extension_loaded('redis') ? 'YES' : 'NO'));
        $this->info('Predis available: ' . (class_exists(\Predis\Client::class) ? 'YES' : 'NO'));
        $this->info('REDIS_CLIENT: ' . config('database.redis.client', '(not set)'));
        $this->info('REDIS_SOCKET: ' . (env('REDIS_SOCKET') ?: '(not set – using TCP)'));
        $this->info('REDIS_HOST:   ' . (env('REDIS_HOST') ?: '127.0.0.1'));
        $this->info('REDIS_PORT:   ' . (env('REDIS_PORT') ?: '6379'));
        $this->newLine();

        // Common cPanel socket paths to probe
        $socketPaths = [
            env('REDIS_SOCKET'),
            '/tmp/redis.sock',
            '/var/run/redis/redis.sock',
            '/var/run/redis.sock',
        ];

        foreach (array_filter($socketPaths) as $path) {
            $exists = file_exists($path);
            $this->line('Socket ' . $path . ': ' . ($exists ? '<fg=green>EXISTS</>' : '<fg=red>not found</>'));
        }

        $this->newLine();
        $this->info("Testing Redis::connection('{$connection}') …");

        try {
            $redis = Redis::connection($connection);
            $pong  = $redis->ping();
            $this->info('<fg=green>PING → ' . (is_string($pong) ? $pong : 'OK') . '</>');

            $key = 'laravel:redis-test:' . uniqid();
            $redis->setex($key, 10, 'ok');
            $val = $redis->get($key);
            $redis->del($key);

            $this->info('<fg=green>SET/GET round-trip → ' . $val . '</>');
            $this->newLine();
            $this->info('<fg=green>Redis is working correctly!</>');

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Connection FAILED: ' . $e->getMessage());
            $this->newLine();
            $this->warn('Troubleshooting tips:');
            $this->line('  1. If a socket path exists above, set REDIS_SOCKET=<path> in your .env');
            $this->line('  2. If no socket found, verify cPanel → MultiPHP INI Editor enables redis.so');
            $this->line('  3. Try REDIS_CLIENT=predis in .env (pure-PHP, no extension needed)');
            $this->line('  4. Check cPanel terminal: redis-cli ping');

            return self::FAILURE;
        }
    }
}
