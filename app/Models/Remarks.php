<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    use HasFactory;

    protected $fillable = [
        'Remarks',
        'appointment_id',
        'patient_concern_id'
    ];

}
