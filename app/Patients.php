<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    public static function getPatientFromCrno($crno){
        return Patients::where('crno', $crno)->first();  
    }

    public static function updateDeviceId($crno, $device_id){
        return Patients::where('crno', $crno)->update(['device_id' => $device_id]);
    }
}
