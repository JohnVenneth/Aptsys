<?php

namespace App\Http\Controllers;

use App\Models\Shifts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $shift = Shifts::get();

        return view('register',[
            'shifts'=>$shift
        ]);


    }

    public function store( Request $request)
    {
        //validate request
        $this->validate($request, [
           'name'=>'required|max:255',
           'contact'=>'required|digits:11',
           'email'=>'required|email|max:255',
           'acctype'=>'required|boolean',
           'shift'=>'required',
           'password'=>'required|confirmed',
        ]);

        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'acctype'=>$request->acctype,
            'password'=>Hash::make($request->password),
            'shift_id'=>$request->shift

        ]);
        //store user

        //sign the user in
        //dd($request->only('AccEmail','password'));
        //auth()->attempt($request->only('AccEmail','password'));
//this line works        auth()->login($user);
        //redirect
        return redirect()->route('calendar');
    }
}
