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
    
    public static function isValidCrno($crno){
        return Patients::where('crno', $crno)->first();
    }

    public static function allTokens($department_id, $doctor_id){
        $current_date   =  date('Y-m-d');
        return Patients::where('department_id', $department_id)
                            ->where('doctor_id', $doctor_id)
                            ->where('created_at', 'like', $current_date.'%')
                            ->count();
    }

    public static function activeTokens($department_id, $doctor_id){
        $current_date   =  date('Y-m-d');
        return Patients::where('department_id', $department_id)
                            ->where('doctor_id', $doctor_id)
                            ->where('queue_status', 1)
                            ->where('created_at', 'like', $current_date.'%')
                            ->count();
    }
}
