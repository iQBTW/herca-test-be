<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/marketings', [App\Http\Controllers\API\MarketingController::class, 'getAllMarketing']);

Route::get('/penjualankomisi', [App\Http\Controllers\API\PenjualanController::class, 'getPenjualanKomisi']);
Route::get('/penjualans', [App\Http\Controllers\API\PenjualanController::class, 'getAllPenjualan']);

Route::get('/cicilans', [App\Http\Controllers\API\CicilanController::class, 'getAllCicilan']);
Route::post('/cicilan', [App\Http\Controllers\API\CicilanController::class, 'store']);

Route::get('/pembayaran-cicilans', [App\Http\Controllers\API\PembayaranCicilanController::class, 'getAllPembayaranCicilan']);
Route::post('/pembayaran-cicilan', [App\Http\Controllers\API\PembayaranCicilanController::class, 'store']);
