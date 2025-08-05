<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RoomController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::resource('hotels', HotelController::class);
// Route::apiResource('locations', LocationController::class);
// Route::apiResource('rooms', RoomController::class);