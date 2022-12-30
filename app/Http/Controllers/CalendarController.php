<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Attribute;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->email);
        return view('calendar');
    }

    public function getAppointment($y,$m,$d)
    {
        $date=date_create();
        date_date_set($date,$y,$m,$d);
        $appdate = date_format($date,"Y-m-d");

        $appointments = Appointments::select('appointments.id','appointments.AppDate','appointments.AppTime','appointments.patient_id','patients.PatFirstName','patients.PatLastName')
        ->join('patients','appointments.patient_id','=','patients.id')
        ->where('appointments.AppDate', $appdate)
        ->get();

        $myArr = array($y, $m, $d, $appdate);

        $myJSON = json_encode($myArr);

        return response()->json([
            'appts'=>$appointments,
        ],200);
    }
}
