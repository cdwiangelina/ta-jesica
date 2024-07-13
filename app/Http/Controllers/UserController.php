<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registerUser(Request $request){

        $validate = $request->validate([
            'username' => 'string|min:5|required|unique:users',
            'password' => 'min:5|required',
        ]);

        $validate['password'] = Hash::make($validate['password']); 
        User::create($validate);

        return redirect('/')->withSuccess('Berhasil Daftar. Silahkan Login!');        
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }
 
        return back()->with('LoginError', 'Login Gagal!');
    }

    public function logout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
