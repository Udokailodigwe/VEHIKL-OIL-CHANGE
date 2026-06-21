<?php

use App\Http\Controllers\OilChangeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/check', [OilChangeController::class, 'store']);
