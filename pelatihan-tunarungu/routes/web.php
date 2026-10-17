<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\KategoriPelatihanController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ProgresController;
use App\Http\Controllers\Admin\KompetensiController;
use App\Http\Controllers\Admin\LaporanController;

// ========================================
// HALAMAN UTAMA
// ========================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========================================
// REGISTRASI DAN LOGIN
// ========================================
Route::middleware('guest')->group(function () {
    Route::get('/registrasi', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/registrasi', [AuthController::class, 'register'])
        ->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

// ========================================
// LOGOUT
// ========================================
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ========================================
// DASHBOARD PESERTA
// ========================================
Route::get('/dashboard', function () {
    return view('peserta.dashboard');
})
    ->middleware(['auth', 'role:peserta'])
    ->name('dashboard');

// ========================================
// MENU ADMIN
// ========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Data peserta
        Route::get('/peserta', [PesertaController::class, 'index'])
            ->name('peserta.index');

        Route::get('/peserta/{pesertum}', [PesertaController::class, 'show'])
            ->whereNumber('pesertum')
            ->name('peserta.show');

        // Kelola materi
        Route::resource('materi', MateriController::class);

        // Kelola kategori pelatihan
        Route::get('/kategori', [KategoriPelatihanController::class, 'index'])
            ->name('kategori.index');

        Route::post('/kategori', [KategoriPelatihanController::class, 'store'])
            ->name('kategori.store');

        Route::delete('/kategori/{kategori}', [KategoriPelatihanController::class, 'destroy'])
            ->name('kategori.destroy');

        // Kelola kuis
        Route::resource('quiz', QuizController::class)
            ->except(['show']);

        // Progres peserta
        Route::get('/progres', [ProgresController::class, 'index'])
            ->name('progres.index');

        // Kompetensi peserta
        Route::get('/kompetensi', [KompetensiController::class, 'index'])
            ->name('kompetensi.index');

        // Laporan nilai peserta
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        // Menu pengaturan
        Route::get('/menu/{menu}', function (string $menu) {
            abort_unless(
                in_array($menu, ['pengaturan'], true),
                404
            );

            return view('admin.menu', compact('menu'));
        })->name('menu');
    });
