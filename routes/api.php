<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/orders', [OrderController::class, 'index'])->name('api.orders.index');

Route::post('/orders/create', [OrderController::class, 'store'])->name('api.orders.store');

Route::put('/orders/confirm', [OrderController::class, 'update'])->name('api.orders.update');
