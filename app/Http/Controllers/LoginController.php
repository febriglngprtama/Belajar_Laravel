<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index',[
            'title'=>'login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request){
       $credencials = $request->validate([
            // 'email' => 'required|email:dns',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credencials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
       return back()->with('loginError','login failed!!');

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
