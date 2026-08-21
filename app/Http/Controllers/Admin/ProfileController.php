<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ];

        if ($request->filled('email') && $request->email !== $user->email) {
            $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($user->id)];
            $messages['email.required'] = 'Email wajib diisi.';
            $messages['email.email'] = 'Format email tidak valid.';
            $messages['email.unique'] = 'Email sudah digunakan.';
        }

        if ($request->filled('current_password') || $request->filled('new_password') || $request->filled('new_password_confirmation')) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['new_password'] = ['required', 'string', 'min:8', 'confirmed'];
            $messages['current_password.required'] = 'Password saat ini wajib diisi.';
            $messages['current_password.current_password'] = 'Password saat ini tidak cocok.';
            $messages['new_password.required'] = 'Password baru wajib diisi.';
            $messages['new_password.min'] = 'Password baru minimal 8 karakter.';
            $messages['new_password.confirmed'] = 'Konfirmasi password baru tidak cocok.';
        }

        $validated = $request->validate($rules, $messages);

        $user->name = $validated['name'];

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (isset($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
