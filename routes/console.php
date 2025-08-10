<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule daily progress update for interns
Schedule::command('intern:update-progress')
    ->daily()
    ->at('00:01')
    ->name('daily-intern-progress-update')
    ->description('Update intern progress based on real-time dates')
    ->onSuccess(fn() => info('Intern progress updated successfully'))
    ->onFailure(fn() => error('Intern progress update failed'));

// Additional schedule: Update every hour during business hours (more frequent updates)
Schedule::command('intern:update-progress')
    ->hourly()
    ->between('8:00', '18:00')
    ->weekdays()
    ->name('hourly-intern-progress-update')
    ->description('Hourly intern progress update during business hours');
