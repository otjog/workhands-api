<?php

use App\Http\Controllers\Api\AdvertController;
use Illuminate\Support\Facades\Route;

Route::controller(AdvertController::class)->group(function () {
    Route::get('/adverts', 'index');
    Route::post('/adverts', 'store');
    Route::get('/adverts/{id}', 'show');
});
