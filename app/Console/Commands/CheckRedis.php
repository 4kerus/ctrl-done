<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class CheckRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('🔍 Проверка Redis...');

        // 1. Проверка соединения Redis
        try {
            Redis::set('check_redis_connection', 'ok', 'EX', 10);
            $value = Redis::get('check_redis_connection');
            $this->info("✅ Подключение к Redis: {$value}");
        } catch (\Exception $e) {
            $this->error("❌ Не удалось подключиться к Redis: " . $e->getMessage());
        }

        // 2. Проверка кэша
        try {
            Cache::put('redis_cache_test', 'cache_ok', 10);
            $cached = Cache::get('redis_cache_test');
            $this->info("✅ Кэш Redis: {$cached}");
        } catch (\Exception $e) {
            $this->error("❌ Проблема с Redis-кэшем: " . $e->getMessage());
        }

        // 3. Проверка очереди (ставим job в очередь, без исполнения)
        try {
            Queue::push(function () {
                logger()->info('Redis queue test job выполнена.');
            });
            $this->info("✅ Очередь Redis: job добавлена");
        } catch (\Exception $e) {
            $this->error("❌ Очередь Redis не работает: " . $e->getMessage());
        }

        // 4. Проверка сессии (если в CLI, сессии часто неактивны)
        try {
            Session::put('redis_session_test', 'session_ok');
            Session::save();
            $this->info("✅ Сессия Redis: сохранена (проверка ограничена в CLI)");
        } catch (\Exception $e) {
            $this->error("❌ Проблема с Redis-сессией: " . $e->getMessage());
        }

        $this->info('✅ Проверка Redis завершена.');
    }
}
