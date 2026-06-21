<?php

use App\Models\OilChangeCheck;
use Carbon\Carbon;

it('is not due when under km and time thresholds', function () {
    $check = new OilChangeCheck([
        'current_odometer' => 14999,
        'previous_odometer' => 10000,
        'previous_change_date' => Carbon::now()->subMonths(5),
    ]);

    expect($check->isDueByKm())->toBeFalse();
    expect($check->isDueByDate())->toBeFalse();
    expect($check->isDue())->toBeFalse();
});

it('is due by km when distance is exactly 5000 km', function () {
    $check = new OilChangeCheck([
        'current_odometer' => 15000,
        'previous_odometer' => 10000,
        'previous_change_date' => Carbon::now()->subMonths(1),
    ]);

    expect($check->isDueByKm())->toBeTrue();
    expect($check->isDue())->toBeTrue();
});

it('is due by date when previous change was more than six months ago', function () {
    $check = new OilChangeCheck([
        'current_odometer' => 11000,
        'previous_odometer' => 10000,
        'previous_change_date' => Carbon::now()->subMonths(6)->subDay(),
    ]);

    expect($check->isDueByDate())->toBeTrue();
    expect($check->isDue())->toBeTrue();
});

it('is due by date when previous change was exactly six months ago', function () {
    $check = new OilChangeCheck([
        'current_odometer' => 11000,
        'previous_odometer' => 10000,
        'previous_change_date' => Carbon::now()->subMonths(6),
    ]);

    expect($check->isDueByDate())->toBeTrue();
    expect($check->isDue())->toBeTrue();
});
