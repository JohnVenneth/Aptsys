<?php

namespace App\Http\Controllers;

use App\Models\Remarks;
use App\Models\Patients;
use App\Models\Appointments;
use App\Models\LabResults;
use Illuminate\Http\Request;
use App\Models\PatientConcerns;

class AppointmentController extends Controller
{
    public function index($id)
    {
        $appointments=Appointments::find($id);
        $patients=Patients::find($appointments->patient_id); //this is a laravel collection
        $concerns=PatientConcerns::find($appointments->patient_concern_id);
        $remarks= Remarks::where('appointment_id', $id)->get();
        $labresults=LabResults::where('appointment_id', $id)->get();

        //dd($appointments,$patients);
        return view('apptDisplay',[
            'patients'=>$patients,
            'appointments'=>$appointments,
            'concerns'=>$concerns,
            'remarks'=>$remarks,
            'labresults'=>$labresults
        ]);
    }
}
