<?php

namespace App\Http\Controllers;

use App\Models\PatientConcerns;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class PatientConcernController extends Controller
{
    public function update (Request $request){

        $concern = PatientConcerns::find($request->concernID);

        $concern->ConcernTitle=$request->text;

        $concern->save();

        return response()->json([
           'status'=>200,
           'concern'=>$concern
        ]);
    }

    public function store(Request $request){

        $concern = PatientConcerns::firstOrCreate([
            'ConcernTitle'=>$request->text,
            'patient_id'=>$request->patientID
        ]);

        return response()->json([
            'status'=>200,
            'response'=>$concern
        ]);
    }
}
