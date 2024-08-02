<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WalletController::class, 'index']);
Route::get('/exchanges', [ExchangeRateController::class, 'getRates']);
Route::post('/transaction', [TransactionController::class, 'store'])->name('store.transaction');



