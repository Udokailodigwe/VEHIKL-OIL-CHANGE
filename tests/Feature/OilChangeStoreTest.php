<?php

use App\Models\OilChangeCheck;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('persists a valid oil change check and redirects to result page', function () {
    $response = $this->post('/check', [
        'current_odometer' => 15000,
        'previous_odometer' => 10000,
        'previous_change_date' => now()->subMonths(1)->format('Y-m-d'),
    ]);

    $response->assertRedirect();

    $check = OilChangeCheck::first();
    expect($check)->not->toBeNull();
    expect($check->current_odometer)->toBe(15000);
    expect($check->is_due_for_oil_change)->toBeTrue();

    $response->assertRedirect(route('result.show', $check));
});
