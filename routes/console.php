<?php

use App\Jobs\Tagihan;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('tagihan:cron')
    ->everyMinute()
    ->onFailure(function (Throwable $exception) {
        \Log::error('Tagihan cron job failed: ' . $exception->getMessage());
    });

Schedule::command('demo:cron')
    ->everyTwoHours();
