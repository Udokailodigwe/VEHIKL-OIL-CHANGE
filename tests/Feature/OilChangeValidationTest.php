<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires all fields', function () {
    $response = $this->post('/check', []);

    $response->assertSessionHasErrors([
        'current_odometer',
        'previous_odometer',
        'previous_change_date',
    ]);
});

it('rejects current odometer less than previous odometer', function () {
    $response = $this->post('/check', [
        'current_odometer' => 1000,
        'previous_odometer' => 2000,
        'previous_change_date' => '2024-01-01',
    ]);

    $response->assertSessionHasErrors(['current_odometer']);
});

it('rejects a previous change date that is not in the past', function () {
    $response = $this->post('/check', [
        'current_odometer' => 5000,
        'previous_odometer' => 1000,
        'previous_change_date' => now()->format('Y-m-d'),
    ]);

    $response->assertSessionHasErrors(['previous_change_date']);
});
