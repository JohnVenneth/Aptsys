<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\PatientConcerns;
use Illuminate\Http\Request;

class CreateAppointmentController extends Controller
{
    public function store( Request $request,$id)
    {

        //validate request
        $this->validate($request, [
           'title'=>'required|max:255',
           'concern'=>'required|max:255',
           'date' => 'required|date|after:today',
           'time'=>'required|date_format:H:i',
        ]);

        $concern = PatientConcerns::firstOrCreate([
            'ConcernTitle'=>$request->concern,
            'patient_id'=>$id,
        ]);

        Appointments::create([
            'AppTitle'=>$request->title,
            'AppDate'=>$request->date,
            'AppTime'=>$request->time,
            'AppStatus'=>0,
            'patient_concern_id'=>$concern->id,
            'patient_id'=>$id,
        ]);

        return redirect("/patient/".$id);
    }

    public function updateApptStatus($id){

        $appointments=Appointments::select('id','AppDate','AppStatus')->where('patient_id', $id)->get();

        $y=0;
        $countAppt = count($appointments);
        $dateToday = date("Y-m-d");
        $ids = array();

        for ($i=0;$i<$countAppt;$i++){
               if($appointments[$i]->AppDate < $dateToday)
               {
                array_push($ids,$appointments[$i]->id);
               }
        }

        if(count($ids)){
            $updatedAppt = Appointments::whereIn('id', $ids)->update(['AppStatus'=>1]);
        }

        return response()->json([
           'status'=>200,
           'Updated'=>$updatedAppt,
           'Today'=>$dateToday
        ]);
    }
}
