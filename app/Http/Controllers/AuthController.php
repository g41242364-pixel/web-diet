<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'umur' => 'required|integer|min:1|max:120',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'umur.required' => 'Umur wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role' => 'pengguna',
        ]);

        Auth::login($user);
        return redirect()->route('pengguna.dashboard')->with('success', 'Registrasi berhasil! Selamat datang di SISD.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showLupaPassword()
    {
        return view('auth.lupa_password');
    }

    public function lupaPassword(Request $request)
    {
        // Cari email, tampilin form reset
        $request->validate(['email' => 'required|email|exists:users,email'], [
            'email.exists' => 'Email tidak ditemukan.',
        ]);

        // Simpan email di session untuk reset
        session(['reset_email' => $request->email]);
        return redirect()->route('reset.password.form')->with('info', 'Silakan buat password baru.');
    }

    public function showResetPassword()
    {
        if (!session('reset_email')) {
            return redirect()->route('lupa.password');
        }
        return view('auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('lupa.password')->withErrors(['email' => 'Sesi habis, silakan ulangi.']);
        }

        $user->update(['password' => Hash::make($request->password)]);
        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
    }

    private function redirectByRole($role)
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'ahli_gizi' => redirect()->route('ahligizi.dashboard'),
            default => redirect()->route('pengguna.dashboard'),
        };
    }
}
