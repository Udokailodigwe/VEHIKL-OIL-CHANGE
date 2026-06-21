<?php

use App\Models\OilChangeCheck;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows due message and original values on result page', function () {
    $check = OilChangeCheck::factory()->create([
        'current_odometer' => 15000,
        'previous_odometer' => 10000,
        'previous_change_date' => now()->subMonths(1),
        'is_due_for_oil_change' => true,
    ]);

    $response = $this->get(route('result.show', $check));

    $response->assertOk();
    $response->assertSee('due for an oil change', false);
    $response->assertSee('15000', false);
    $response->assertSee('10000', false);
});

it('shows not due message when check is not due', function () {
    $check = OilChangeCheck::factory()->create([
        'current_odometer' => 12000,
        'previous_odometer' => 10000,
        'previous_change_date' => now()->subMonths(2),
        'is_due_for_oil_change' => false,
    ]);

    $response = $this->get(route('result.show', $check));

    $response->assertOk();
    $response->assertSee('not due', false);
});

it('returns 404 for unknown result id', function () {
    $response = $this->get('/result/99999');

    $response->assertNotFound();
});

it('shows same result after refresh', function () {
    $check = OilChangeCheck::factory()->create([
        'is_due_for_oil_change' => true,
    ]);

    $first = $this->get(route('result.show', $check));
    $second = $this->get(route('result.show', $check));

    $first->assertSee('due for an oil change', false);
    $second->assertSee('due for an oil change', false);
});
