<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLogs;
use App\Models\Shifts;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceLog extends Controller
{
    public function index($id){

        $user = User::find($id);
        $shift = Shifts::find($user->shift_id);
        $attendance = AttendanceLogs::where('user_id',$id)->get()->toArray();


        return view('attlogs',
            [
                'user'=>$user,
                'shift'=>$shift,
                'attendance'=>$attendance
            ]);
    }
}
