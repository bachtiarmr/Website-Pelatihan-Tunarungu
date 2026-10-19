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
use App\Http\Controllers\Admin\PengaturanAkunController as AdminPengaturanAkunController;

// Controller Peserta
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\MateriController as PesertaMateriController;
use App\Http\Controllers\Peserta\PengaturanAkunController as PesertaPengaturanAkunController;


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
| DASHBOARD, MATERI, DAN PENGATURAN PESERTA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:peserta'])->group(function () {

    // Dashboard Peserta
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])
        ->name('dashboard');

    // Materi Peserta
    Route::get('/materi', [PesertaMateriController::class, 'index'])
        ->name('peserta.materi.index');

    Route::get('/materi/{materi}', [PesertaMateriController::class, 'show'])
        ->whereNumber('materi')
        ->name('peserta.materi.show');

    // Pengaturan Akun Peserta
    Route::get('/pengaturan-akun', [
        PesertaPengaturanAkunController::class,
        'edit',
    ])->name('peserta.pengaturan-akun.edit');

    Route::put('/pengaturan-akun', [
        PesertaPengaturanAkunController::class,
        'update',
    ])->name('peserta.pengaturan-akun.update');

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

        // Dashboard Admin
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN AKUN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/pengaturan-akun', [
            AdminPengaturanAkunController::class,
            'edit',
        ])->name('pengaturan-akun.edit');

        Route::put('/pengaturan-akun', [
            AdminPengaturanAkunController::class,
            'update',
        ])->name('pengaturan-akun.update');


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

        Route::delete('/kategori/{kategori}', [
            KategoriPelatihanController::class,
            'destroy',
        ])->whereNumber('kategori')
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
        | MENU ADMIN LAINNYA
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
