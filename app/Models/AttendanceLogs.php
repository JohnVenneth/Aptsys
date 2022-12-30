<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'AttDate',
        'AttTime',
        'Selfi',
        'AttOut',
        'SelfiOut',
    ];

    public function attuser()
    {
        return $this->belongsTo(User::class);
    }
}
