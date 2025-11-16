<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * UC-003: Login User
     * Main Flow: Step 1-7
     */
    public function login(Request $request)
    {
        // Validasi input (Main Flow Step 3)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Attempt login (Main Flow Step 7)
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Log aktivitas login
            UserActivityLog::create([
                'user_id' => Auth::id(),
                'activity_type' => 'login',
                'activity_details' => 'User logged in successfully',
                'timestamp' => now(),
                'last_login' => now(),
            ]);

            return redirect()->intended('dashboard')
                ->with('success', 'Login berhasil!');
        }

        // Alternative Flow: Kredensial tidak valid
        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput();
    }

    /**
     * UC-003: Register User
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:users',
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            // Alternative Flow 1: Email tidak valid
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat user baru
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login setelah registrasi
        Auth::login($user);

        // Log aktivitas registrasi
        UserActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => 'register',
            'activity_details' => 'User registered successfully',
            'timestamp' => now(),
            'last_login' => now(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    /**
     * Logout User
     */
    public function logout(Request $request)
    {
        // Log aktivitas logout
        UserActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'logout',
            'activity_details' => 'User logged out',
            'timestamp' => now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logout berhasil!');
    }
}