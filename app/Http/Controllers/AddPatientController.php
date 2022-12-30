<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class AddPatientController extends Controller
{
    public function index(){
        return view('addPatient');
    }

    public function store( Request $request)
    {

        //validate request
        $this->validate($request, [
           'firstname'=>'required|max:255',
           'middlename'=>'required|max:255',
           'lastname'=>'required|max:255',
           'contact'=>'required|digits:11',
        ]);

        $request->user()->patients()->create([
            'PatFirstName'=>$request->firstname,
            'PatMiddleName'=>$request->middlename,
            'PatLastName'=>$request->lastname,
            'PatEmail'=>$request->email,
            'PatContact'=>$request->contact,
            'OtherToContact'=>$request->othercontact
        ]);

        $patients = Patients::latest()->first();//get the newly created patient record
        //dd($patients);

        // For a route with the following URI: profile/{id}

        return redirect("/patient/".$patients->id);
        /*return view('patients',[
            'patients'=>$patients
        ]);*/
    }
}
