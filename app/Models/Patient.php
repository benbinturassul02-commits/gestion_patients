<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'telephone',
        'adresse',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_naissance)->age;
    }
}
