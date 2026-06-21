<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOilChangeCheckRequest;
use App\Models\OilChangeCheck;
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
        $check = new OilChangeCheck($request->validated());
        $check->is_due_for_oil_change = $check->isDue();
        $check->save();

        return redirect()->route('result.show', $check);
    }

    public function show(OilChangeCheck $oilChangeCheck): View
    {
        return view('oil-change.result', ['check' => $oilChangeCheck]);
    }
}
