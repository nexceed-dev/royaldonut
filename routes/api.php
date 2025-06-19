<?php

use App\Http\Controllers\Api\DonutsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::apiResource('donuts', DonutsController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
