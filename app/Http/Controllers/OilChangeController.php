<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilChangeCheckRequest;
use Illuminate\Http\RedirectResponse;

class OilChangeController extends Controller
{
    public function store(StoreOilChangeCheckRequest $request): RedirectResponse
    {
        return back();
    }
}
