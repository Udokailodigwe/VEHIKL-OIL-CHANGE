<?php

namespace Database\Factories;

use App\Models\OilChangeCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OilChangeCheck>
 */
class OilChangeCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'current_odometer' => 15000,
            'previous_odometer' => 10000,
            'previous_change_date' => now()->subMonths(1),
            'is_due_for_oil_change' => true,
        ];
    }
}
