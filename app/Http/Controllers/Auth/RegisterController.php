<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{

    // Menampilkan form register
    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return view('already_logged_in');
        }
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            auth()->login($user);
            return redirect()->route('home');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }
}
