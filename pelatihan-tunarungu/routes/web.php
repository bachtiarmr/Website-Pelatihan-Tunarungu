<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Controller Admin (Perhatikan huruf kecil 'admin' sesuai folder Anda)
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\PesertaController;
use App\Http\Controllers\admin\MateriController as AdminMateriController;
use App\Http\Controllers\admin\KategoriPelatihanController;
use App\Http\Controllers\admin\QuizController;
use App\Http\Controllers\admin\SoalController; // <-- TAMBAHKAN INI
use App\Http\Controllers\admin\ProgresController;
use App\Http\Controllers\admin\KompetensiController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\PengaturanAkunController as AdminPengaturanAkunController;

// Controller Peserta
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\MateriController as PesertaMateriController;
use App\Http\Controllers\Peserta\PengaturanAkunController as PesertaPengaturanAkunController;
use App\Http\Controllers\Peserta\EvaluasiController as PesertaEvaluasiController;


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
| DASHBOARD, MATERI, EVALUASI, DAN PENGATURAN PESERTA
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

    // ==========================================
    // EVALUASI PESERTA
    // ==========================================
    
    Route::get('/evaluasi', [PesertaEvaluasiController::class, 'index'])
        ->name('peserta.evaluasi.index');

    Route::get('/evaluasi/{quiz}/kerjakan', [PesertaEvaluasiController::class, 'kerjakan'])
        ->whereNumber('quiz')
        ->name('peserta.evaluasi.kerjakan');

    Route::post('/evaluasi/{quiz}/submit', [PesertaEvaluasiController::class, 'submit'])
        ->whereNumber('quiz')
        ->name('peserta.evaluasi.submit');


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
        | KELOLA QUIZ & SOAL
        |--------------------------------------------------------------------------
        */

        // Route bawaan CRUD Quiz
        Route::resource('quiz', QuizController::class)
            ->except(['show']);

        // PERBAIKAN: Route Kelola Soal diarahkan ke SoalController
        Route::get('/quiz/{quiz}/soal', [SoalController::class, 'index'])->name('quiz.soal.index');
        Route::get('/quiz/{quiz}/soal/create', [SoalController::class, 'create'])->name('quiz.soal.create');
        Route::post('/quiz/{quiz}/soal', [SoalController::class, 'store'])->name('quiz.soal.store');


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