<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\NoAccessController;
use Illuminate\Support\Facades\Route;

//Jika belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
});

Route::get('/home', function () {
    return redirect('/logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');    
    Route::get('/no-access', [NoAccessController::class, 'index'])->name('noAccess');
});

Route::middleware(['auth', 'checkAccess:admin'])->group(function () {
    Route::post('/approved-peserta/store', [PesertaController::class, 'approvedProcess'])->name('approved-peserta-store');
    Route::get('/history-peserta/{id}', [PesertaController::class, 'showHistory'])->name('approved-history');
    Route::get('/approved-peserta', [PesertaController::class, 'approved'])->name('approved-peserta');
});

Route::middleware(['auth', 'checkAccess:user'])->group(function () {
    Route::get('/form-peserta', [PesertaController::class, 'form'])->name('form-peserta');
    Route::post('/form-peserta/store', [PesertaController::class, 'store'])->name('form-peserta-store');
   
});