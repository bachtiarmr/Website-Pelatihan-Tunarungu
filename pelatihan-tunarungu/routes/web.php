<?php

use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Registrasi peserta
Route::get('/registrasi', [AuthController::class, 'showRegister'])
    ->middleware('guest')
    ->name('register');

Route::post('/registrasi', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register.process');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard peserta
Route::get('/dashboard', function () {
    return view('peserta.dashboard');
})
    ->middleware(['auth', 'role:peserta'])
    ->name('dashboard');

// Dashboard admin
Route::get('/admin', function () {
    return view('admin.dashboard');
})
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

    Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/peserta', [PesertaController::class, 'index'])
            ->name('peserta.index');

        Route::get('/peserta/{pesertum}', [PesertaController::class, 'show'])
            ->whereNumber('pesertum')
            ->name('peserta.show');
    });

Route::get('/admin/menu/{menu}', function (string $menu) {
    abort_unless(
        in_array($menu, ['peserta', 'materi', 'quiz', 'progres', 'kompetensi', 'laporan', 'pengaturan'], true),
        404
    );

    return view('admin.menu', compact('menu'));
})
    ->middleware(['auth', 'role:admin'])
    ->name('admin.menu');
