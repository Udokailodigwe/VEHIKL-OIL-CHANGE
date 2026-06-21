<?php

use App\Http\Controllers\OilChangeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OilChangeController::class, 'create'])->name('home');
Route::post('/check', [OilChangeController::class, 'store'])->name('check.store');
