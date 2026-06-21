<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
    protected $fillable = [
        'current_odometer',
        'previous_odometer',
        'previous_change_date',
        'is_due_for_oil_change',
    ];

    protected $casts = [
        'current_odometer' => 'integer',
        'previous_odometer' => 'integer',
        'previous_change_date' => 'date',
        'is_due_for_oil_change' => 'boolean',
    ];

    public function isDueByKm(): bool
    {
        return ($this->current_odometer - $this->previous_odometer) >= 5000;
    }

    public function isDueByDate(): bool
    {
        return $this->previous_change_date->lte(now()->subMonths(6));
    }

    public function isDue(): bool
    {
        return $this->isDueByKm() || $this->isDueByDate();
    }
}
