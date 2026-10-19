<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengaturanAkunController extends Controller
{
    /**
     * Menampilkan halaman pengaturan akun peserta.
     */
    public function edit()
    {
        return view('peserta.pengaturan-akun', [
            'peserta' => Auth::user(),
        ]);
    }

    /**
     * Memperbarui informasi akun peserta.
     */
    public function update(Request $request)
    {
        $peserta = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($peserta->id),
            ],

            'password_lama' => [
                'required_with:password_baru',
                'nullable',
                'current_password',
            ],

            'password_baru' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama peserta wajib diisi.',
            'name.max' => 'Nama peserta maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',

            'password_lama.required_with' =>
                'Masukkan password lama untuk mengganti password.',

            'password_lama.current_password' =>
                'Password lama yang kamu masukkan salah.',

            'password_baru.min' =>
                'Password baru minimal 8 karakter.',

            'password_baru.confirmed' =>
                'Konfirmasi password baru tidak cocok.',
        ]);

        $peserta->name = $validated['name'];
        $peserta->email = $validated['email'];

        if (!empty($validated['password_baru'])) {
            $peserta->password = Hash::make(
                $validated['password_baru']
            );
        }

        $peserta->save();

        return redirect()
            ->route('peserta.pengaturan-akun.edit')
            ->with('success', 'Pengaturan akun berhasil diperbarui.');
    }
}
