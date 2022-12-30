<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\LabResults;
use App\Models\PatientConcerns;
use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index($id)
    {

        $patients=Patients::find($id); //this is a laravel collection
        $appointments=Appointments::where('patient_id', $id)->get();
        $concerns=PatientConcerns::where('patient_id', $id)->get();
        $labResult=LabResults::where('patients_id', $id)->get();

        //dd($appointments,$patients);
        return view('patients',[
            'patients'=>$patients,
            'appointments'=>$appointments,
            'concerns'=>$concerns,
            'labResults'=>$labResult
        ]);
    }

    public function update(Request $request){ //Edit Patient

        $patVal = $request->validate([
                'firstname'=>'required|max:255',
                'middlename'=>'required|max:255',
                'lastname'=>'required|max:255',
                'contact'=>'required|digits:11',
             ]);

         $patient=Patients::find($request->patID);

         $patient->PatFirstName=$request->firstname;
         $patient->PatMiddleName=$request->middlename;
         $patient->PatLastName=$request->lastname;
         $patient->PatContact=$request->contact;
         $patient->OtherToContact=$request->othercontact;
         $patient->PatEmail=$request->email;

         $patient->save();

        return response()->json([
            'status'=>200,
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'contact'=>$request->contact,
            'othercontact'=>$request->othercontact,
            'email'=>$request->email,
        ]);
    }

}
