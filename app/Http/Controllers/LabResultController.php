<?php

namespace App\Http\Controllers;

use App\Models\LabResults;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function store(Request $request, $aId,$pId){

        //dd($request);

        $request->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg'
        ]);

        $trimmed = str_replace(' ', '', trim($request->title));

        $imageName = time().'-'.$trimmed.'.'.$request->image->extension();

        $request->image->move(public_path('images'),$imageName);

        $labResults = LabResults::create([
            'ResultDoc'=>$imageName,
            'ResulTitle'=>$request->title,
            'Notes'=>$request->note,
            'appointment_id'=>$aId,
            'patients_id'=>$pId
        ]);

        return redirect("/displayAppt/".$aId);
    }
}
