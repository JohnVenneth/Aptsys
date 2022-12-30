<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeinController extends Controller
{
    public function index($type)
    {
        return view('timein',['type'=>$type]);

    }

    public function store(Request $image){

      /*  $file = base64_decode($image['imgBase64']);
        $safeName = time().'- timeIn'.'.'.'png';
        $success = file_put_contents(public_path().'/attendancess/'.$safeName, $file);*/

        $image_64 = $image->imgBase64; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

      // find substring fro replace here eg: data:image/png;base64,

       $imahe = str_replace($replace, '', $image_64);

       $imahe = str_replace(' ', '+', $imahe);

       $imageName =time().'- timeIn'.'.'.$extension;

       $file = base64_decode($imahe);
       $success = file_put_contents(public_path().'/attendancess/'.$imageName, $file);
       //Storage::disk('public')->put($imageName, base64_decode($image));

        $image->user()->attendance()->create([
            'AttDate'=>$image->date,
            'AttTime'=>$image->time,
            'Selfi'=>$imageName,
        ]);


        return response()->json([
            'status'=>200,
            'img'=>$image->imgBase64,
        ]);

    }
}
