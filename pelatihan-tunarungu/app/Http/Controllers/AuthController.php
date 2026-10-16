<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.register');
    }

    // Memproses registrasi peserta
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'nomor_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Membuat akun peserta baru
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nomor_hp' => $data['nomor_hp'],
            'password' => $data['password'],
            'role' => 'peserta',
        ]);

        // Setelah daftar, arahkan ke halaman login
        // Peserta harus login secara manual
        return redirect()->route('login')
            ->with(
                'success',
                'Registrasi berhasil! Silakan login menggunakan akun kamu.'
            );
    }

    // Menampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Memeriksa email dan password
        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->onlyInput('email');
        }

        // Memperbarui session setelah login
        $request->session()->regenerate();

        // Mengarahkan pengguna sesuai role
        return $this->redirectByRole()
            ->with('success', 'Login berhasil!');
    }

    // Pengalihan berdasarkan role pengguna
    private function redirectByRole()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, kembali ke halaman utama
        return redirect('/')
            ->with('success', 'Kamu berhasil logout.');
    }
}
