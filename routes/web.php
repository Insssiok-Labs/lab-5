<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'index']);

Route::resource('transactions', TransactionController::class)->except('show');
