<?php

namespace App\Http\Controllers;

use App\Models\Shifts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function index ()
    {
        $details= User::find(auth()->user()->id);
        $userShift = Shifts::find($details->shift_id);
        $allAccs= User::get();
        $shifts = Shifts::get();

        $allAccounts = User::select('users.*','shifts.ShiftTitle','shifts.TimeIn','TimeOut')
        ->join('shifts','users.shift_id','=','shifts.id')
        ->get();

       // $array = (array) $allAccounts;

        return view('accounts',
        [
            'detail'=>$details,
            'usershift'=>$userShift,
            'shifts'=>$shifts,
            'allAccounts'=>$allAccounts
        ]);
    }

    public function show($id){

        $details=User::find($id);
        $accshift= Shifts::find($details->shift_id);
        $shifts = Shifts::get();

        return view('editAccount',
        [
            'detail'=>$details,
            'accshift'=>$accshift,
            'shifts'=>$shifts,
        ]);
    }

    public function update($id,Request $request, User $user)
    {
        //dd($id);
        //validate request
        $this->validate($request, [
            'name'=>'required|max:255',
            'contact'=>'required|digits:11',
            'email'=>'required|email|max:255',
            'acctype'=>'required|boolean',
            'shift'=>'required',
         ]);

         $user=User::find($id);

         $user->name=$request->name;
         $user->contact=$request->contact;
         $user->email=$request->email;
         $user->acctype=$request->acctype;
         $user->shift_id=$request->shift;

         $user->save();

        //$details=User::find(auth()->user()->id);
        return Redirect::route('accounts')->with('status','Account Updated');
    }
}
