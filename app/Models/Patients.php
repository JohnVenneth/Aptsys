<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'PatFirstName',
        'PatMiddleName',
        'PatLastName',
        'PatEmail',
        'PatContact',
        'OtherToContact'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
