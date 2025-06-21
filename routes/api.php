<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdSlotController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\WinnerController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Ad slots
    Route::get('/ad-slots', [AdSlotController::class, 'index']);
    Route::get('/ad-slots/{id}', [AdSlotController::class, 'show']);
    
    // Bids
    Route::post('/ad-slots/{adSlot}/bids', [BidController::class, 'store']);
    Route::get('/ad-slots/{adSlot}/bids', [BidController::class, 'index']);
    Route::get('/user/bids', [BidController::class, 'userBids']);
    
    // Winners
    Route::get('/ad-slots/{adSlot}/winner', [WinnerController::class, 'show']);

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::post('/ad-slots', [AdSlotController::class, 'store']);
    });
});