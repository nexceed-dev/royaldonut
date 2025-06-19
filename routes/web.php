<?php

use App\Models\Donut;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donuts', function () {
    return view('donuts.index');
});
