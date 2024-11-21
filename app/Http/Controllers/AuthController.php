<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
        {
        $credentials = $request->only('email', 'password');

        // Cek apakah kredensial valid
        if (Auth::attempt($credentials)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // // Redirect berdasarkan role
            // $userRole = Auth::user();

            // if ($userRole == 'admin') {
            //     return redirect('/admin'); // Redirect ke halaman admin
            // } 
            // if (!$userRole->profile_completed) {
            //     return redirect('/profile-create'); // Redirect ke halaman user
            // }

            // Default redirect jika role tidak ditemukan
            return redirect('/flights');
        }

        // Jika login gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        }

        public function showLoginForm()
        {
            return view('auth.login');
        }

        public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);


        

    
        
        $role = 'user';  // Default role adalah 'user'
        if (strpos($request->email, '@admin.com') !== false) {
            $role = 'admin';
        }

        
        

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'profile_completed' => false, // Set role sesuai dengan domain email
        ]);

    
    

        // Arahkan ke halaman login setelah registrasi
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



}
