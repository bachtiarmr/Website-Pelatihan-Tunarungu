
<?php

use Illuminate\Support\Facades\Route;

// Halaman Beranda
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Registrasi
Route::get('/registrasi', function () {
    return view('auth.register');
})->name('register');

// Proses pengiriman formulir registrasi
Route::post('/registrasi', function () {
    return 'Formulir registrasi berhasil dikirim!';
})->name('register.process');

// Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login (tes sementara)
Route::post('/login', function () {
    return 'Formulir login berhasil dikirim!';
})->name('login.process');

// Dashboard Peserta
Route::get('/dashboard', function () {
    return view('peserta.dashboard');
})->name('dashboard');
