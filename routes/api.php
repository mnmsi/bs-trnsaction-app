<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\MockController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('mock-response', [MockController::class, 'mockResponse']);
    Route::post('process-payment', [PaymentController::class, 'processPayment']);
    Route::post('callback', [CallbackController::class, 'callback']);
});
