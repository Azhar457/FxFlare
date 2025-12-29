<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule asset price updates every 15 minutes
Schedule::command('assets:update-prices')
    ->everyFifteenMinutes()
    ->withoutOverlapping()
    ->runInBackground();
