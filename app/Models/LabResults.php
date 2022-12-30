<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResults extends Model
{
    use HasFactory;

    protected $fillable = [
        'ResultDoc',
        'ResulTitle',
        'Notes',
        'appointment_id',
        'patients_id'
    ];

}
