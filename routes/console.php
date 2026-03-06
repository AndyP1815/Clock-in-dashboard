<?php

use App\Enums\Status;
use App\Models\ClockIn;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    // 1. Get only the records that need updating (Database level filtering)
    $invalidClockIns = ClockIn::where('status', Status::Pending->value)->get();

    foreach ($invalidClockIns as $clockIn) {
        // 2. Use updateQuietly to bypass the 'saving' boot method
        $clockIn->updateQuietly([
            'clock_out_time' => $clockIn->clock_in_time,
            'status' => Status::Forgotten->value,
        ]);
    }
})->dailyAt('04:00');
