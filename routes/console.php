<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Task Scheduling
|--------------------------------------------------------------------------
| Sitemap otomatis di-generate setiap hari pukul 02:00 pagi.
| Pastikan cron job sudah dikonfigurasi di server production:
|   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
*/
Schedule::command('sitemap:generate')
    ->dailyAt('02:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/sitemap.log'));
