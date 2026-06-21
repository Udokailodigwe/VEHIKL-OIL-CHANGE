<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOilChangeCheckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_odometer' => ['required', 'integer', 'gte:previous_odometer'],
            'previous_odometer' => ['required', 'integer'],
            'previous_change_date' => ['required', 'date', 'before:today'],
        ];
    }
}
