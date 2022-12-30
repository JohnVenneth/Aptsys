<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required',
         ]);

         if (!auth()->attempt($request->only('email','password'))){
            $request->session()->regenerate();
            return back()->with('status','Invalid Log-in Credentials');
         }

         return redirect()->route('calendar');

         /*$credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('calendar');
        }

        return back()->with('status','Invalid Log-in Credentials');*/
    }
}
