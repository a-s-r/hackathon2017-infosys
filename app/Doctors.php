<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    public static function isDoctorValid($phone){
        return Doctors::where('phone', $phone)->first();  
    }
}
