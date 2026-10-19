<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
use App\Http\Controllers\Admin\KategoriPelatihanController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\ProgresController;
use App\Http\Controllers\Admin\KompetensiController;
use App\Http\Controllers\Admin\LaporanController;

// Controller Peserta
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\MateriController as PesertaMateriController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| REGISTRASI DAN LOGIN
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD DAN MATERI PESERTA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:peserta'])->group(function () {

    // Dashboard peserta
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])
        ->name('dashboard');

    // Daftar materi yang sudah dipublikasikan admin
    Route::get('/materi', [PesertaMateriController::class, 'index'])
        ->name('peserta.materi.index');

    // Detail materi peserta
    Route::get('/materi/{materi}', [PesertaMateriController::class, 'show'])
        ->whereNumber('materi')
        ->name('peserta.materi.show');

});


/*
|--------------------------------------------------------------------------
| MENU ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | DATA PESERTA
        |--------------------------------------------------------------------------
        */

        Route::get('/peserta', [PesertaController::class, 'index'])
            ->name('peserta.index');

        Route::get('/peserta/{pesertum}', [PesertaController::class, 'show'])
            ->whereNumber('pesertum')
            ->name('peserta.show');


        /*
        |--------------------------------------------------------------------------
        | KELOLA MATERI
        |--------------------------------------------------------------------------
        */

        Route::resource('materi', AdminMateriController::class);


        /*
        |--------------------------------------------------------------------------
        | KATEGORI PELATIHAN
        |--------------------------------------------------------------------------
        */

        Route::get('/kategori', [KategoriPelatihanController::class, 'index'])
            ->name('kategori.index');

        Route::post('/kategori', [KategoriPelatihanController::class, 'store'])
            ->name('kategori.store');

        Route::delete('/kategori/{kategori}', [KategoriPelatihanController::class, 'destroy'])
            ->whereNumber('kategori')
            ->name('kategori.destroy');


        /*
        |--------------------------------------------------------------------------
        | KELOLA QUIZ
        |--------------------------------------------------------------------------
        */

        Route::resource('quiz', QuizController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | PROGRES PESERTA
        |--------------------------------------------------------------------------
        */

        Route::get('/progres', [ProgresController::class, 'index'])
            ->name('progres.index');


        /*
        |--------------------------------------------------------------------------
        | KOMPETENSI PESERTA
        |--------------------------------------------------------------------------
        */

        Route::get('/kompetensi', [KompetensiController::class, 'index'])
            ->name('kompetensi.index');


        /*
        |--------------------------------------------------------------------------
        | LAPORAN NILAI
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/menu/{menu}', function (string $menu) {

            abort_unless(
                in_array($menu, ['pengaturan'], true),
                404
            );

            return view('admin.menu', compact('menu'));

        })->name('menu');

    });
