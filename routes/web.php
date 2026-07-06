<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveiController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/survei', [SurveiController::class, 'index'])->name('survei.index');
Route::post('/survei', [SurveiController::class, 'simpan'])->name('survei.store');

Route::get('/terimakasih', function () {
    return view('terimakasih');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::delete('/responden/{id}', [AuthController::class, 'hapusResponden'])->name('responden.hapus');
    Route::get('/export-excel', [AuthController::class, 'exportExcel'])->name('export.excel');
});