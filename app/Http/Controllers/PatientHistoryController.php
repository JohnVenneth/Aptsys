<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    public function index()
    {

        $patients=Patients::get(); //this is a laravel collection

        return view('patientHistory',[
            'patients'=>$patients
        ]);
    }
}
