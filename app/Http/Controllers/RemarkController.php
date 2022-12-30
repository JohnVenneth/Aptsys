<?php

namespace App\Http\Controllers;

use App\Models\Remarks;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    public function store(Request $request)
    {
        $remark = Remarks::create([
            'Remarks'=>$request->remarkIn,
            'appointment_id'=>$request->appointmentID,
            'patient_concern_id'=>$request->concernID
        ]);

        return response()->json([
            'status'=>200,
            'data'=>$remark
        ]);
    }

    public function index($id){

        $remarks= Remarks::where('appointment_id', $id)->get();

        return response()->json([
            'status'=>200,
            'remarks'=>$remarks,
        ]);
    }

    public function update(Request $request){

        /*$this->validate($request, [
            'text'=>'required|max:255'
         ]);*/

         $remarks=Remarks::find($request->remarkID);

         $remarks->Remarks=$request->text;

         $remarks->save();


        return response()->json([
            'status'=>200,
            'remarks'=>$remarks
        ]);
    }

    public function delete(Request $request){

        $remarks = Remarks::find($request->remarkID);

        $remarks->delete();

        return response()->json([
            'status'=>200,
            'ID'=>$request->remarkID
        ]);
    }

}
