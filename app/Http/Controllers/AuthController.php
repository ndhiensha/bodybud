<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * UC-003: Register User - Show Form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * UC-003: Register User - Process Registration
     */
    public function register(Request $request)
    {
        // DEBUG: Log semua input yang masuk
        Log::info('Register attempt', [
            'data' => $request->except('password', 'password_confirmation')
        ]);

        // Validasi input
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            // DEBUG: Log error validasi
            Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        try {
            // DEBUG: Sebelum create user
            Log::info('Creating user...');

            // Buat user baru
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->password,
            ]);

            // DEBUG: User berhasil dibuat
            Log::info('User created successfully', ['user_id' => $user->id]);

            // Log aktivitas registrasi (opsional, bisa diskip dulu untuk testing)
            try {
                UserActivityLog::create([
                    'user_id' => $user->id,
                    'activity_type' => 'register',
                    'activity_details' => 'User registered successfully',
                    'timestamp' => now(),
                    'last_login' => now(),
                ]);
            } catch (\Exception $e) {
                // Jika tabel activity log belum ada, skip saja
                Log::warning('Could not create activity log: ' . $e->getMessage());
            }

            // DEBUG: Sebelum redirect
            Log::info('Redirecting to login...');

            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');

        } catch (\Exception $e) {
            // DEBUG: Log error
            Log::error('Registration error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * UC-003: Login User - Show Form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * UC-003: Login User - Process Login
     */
    public function login(Request $request)
    {
        // DEBUG: Log login attempt
        Log::info('Login attempt', ['email' => $request->email]);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            Log::error('Login validation failed', ['errors' => $validator->errors()->toArray()]);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Attempt login
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            Log::info('Login successful', ['user_id' => Auth::id()]);

            // Log aktivitas login
            try {
                UserActivityLog::create([
                    'user_id' => Auth::id(),
                    'activity_type' => 'login',
                    'activity_details' => 'User logged in successfully',
                    'timestamp' => now(),
                    'last_login' => now(),
                ]);
            } catch (\Exception $e) {
                Log::warning('Could not create activity log: ' . $e->getMessage());
            }

            return redirect()->intended('dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name);
        }

        // Login gagal
        Log::warning('Login failed - invalid credentials', ['email' => $request->email]);
        
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah. Silakan coba lagi.'])
            ->withInput($request->only('email'));
    }

    /**
     * Logout User
     */
    public function logout(Request $request)
    {
        // Log aktivitas logout
        if (Auth::check()) {
            try {
                UserActivityLog::create([
                    'user_id' => Auth::id(),
                    'activity_type' => 'logout',
                    'activity_details' => 'User logged out',
                    'timestamp' => now(),
                ]);
            } catch (\Exception $e) {
                Log::warning('Could not create activity log: ' . $e->getMessage());
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logout berhasil!');
    }
}