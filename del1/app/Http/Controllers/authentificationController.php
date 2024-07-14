<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->active == '1'){
                if (Auth::user()->role === 'professeur') {
                    return redirect()->intended('IuProf')->with('user', Auth::user());
                } else {
                     return redirect()->intended('IuAdmin')->with('user', Auth::user());
                }
            }else{
                return redirect()->back()->with('error', 'Votre compte n/est pas active');
            }
        } else {
            return redirect()->back()->with('error', 'Identifiants invalides, veuillez réessayer.');
        }
    }
    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
