<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdSlotController;
use App\Http\Controllers\BidController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/', [AdSlotController::class, 'index']);
Route::get('/ad-slots', [AdSlotController::class, 'index']);
Route::get('/ad-slots/{adSlot}', [AdSlotController::class, 'show']);
Route::post('/ad-slots/{adSlot}/bids', [BidController::class, 'store'])->middleware('auth');
Route::get('/bids', [BidController::class, 'userBids'])->middleware('auth')->name('bids.index');