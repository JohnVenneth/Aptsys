<?php

namespace App\Http\Controllers;

use App\Models\Shifts;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function store(Request $request){

        //validate request
        $this->validate($request, [
            'Title'=>'required|max:255',
            'Timein'=>'required|date_format:H:i',
            'Timeout'=>'required|date_format:H:i',
         ]);


       $shift = Shifts::firstOrCreate([
            'ShiftTitle'=>$request->Title,
            'TimeIn'=>$request->Timein,
            'TimeOut'=>$request->Timeout
        ]);

        return response()->json([
            'status'=>200,
            'response'=>$shift
        ]);
    }
}
