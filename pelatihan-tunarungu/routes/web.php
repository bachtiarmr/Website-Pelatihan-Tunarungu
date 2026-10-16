
<?php

use App\Http\Controllers\Admin\PesertaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ========================================
// HALAMAN UTAMA
// ========================================
Route::get('/', function () {
    return view('welcome');
})->name('home');


// ========================================
// REGISTRASI PESERTA
// ========================================
Route::middleware('guest')->group(function () {

    Route::get('/registrasi', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/registrasi', [AuthController::class, 'register'])
        ->name('register.process');


    // ========================================
    // LOGIN
    // ========================================
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
// DASHBOARD DAN MENU ADMIN
// ========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        // Daftar peserta
        Route::get('/peserta', [PesertaController::class, 'index'])
            ->name('peserta.index');

        // Detail peserta
        Route::get('/peserta/{pesertum}', [PesertaController::class, 'show'])
            ->whereNumber('pesertum')
            ->name('peserta.show');


        // Menu admin lainnya
        Route::get('/menu/{menu}', function (string $menu) {

            abort_unless(
                in_array($menu, [
                    'peserta',
                    'materi',
                    'quiz',
                    'progres',
                    'kompetensi',
                    'laporan',
                    'pengaturan'
                ], true),
                404
            );

            return view('admin.menu', compact('menu'));

        })->name('menu');

    });
