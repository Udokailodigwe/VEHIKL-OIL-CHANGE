<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilChangeCheckRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OilChangeController extends Controller
{
    public function create(): View
    {
        return view('oil-change.form');
    }

    public function store(StoreOilChangeCheckRequest $request): RedirectResponse
    {
        return back();
    }
}
