<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PengaturanAkunController extends Controller
{
    public function edit()
    {
        return view('admin.pengaturan-akun', [
            'admin' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],

            'password_lama' => [
                'required_with:password_baru',
                'current_password',
            ],

            'password_baru' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama admin wajib diisi.',
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

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password_baru'])) {
            $admin->password = $validated['password_baru'];
        }

        $admin->save();

        return redirect()
            ->route('admin.pengaturan-akun.edit')
            ->with('success', 'Pengaturan akun berhasil diperbarui.');
    }
}
