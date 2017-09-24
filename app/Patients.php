<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Patients extends Model
{

	protected $table = 'patients';
	public $fillable = ['name','department_id','doctor_id','age','address','hall_id','phone','phone','email','crno','token','queue_status','device_id'];
	
    public static function getAllPatients(){
		$data = DB::table('patients as a')
					->join('departments as b','a.department_id','=','b.id')
					->join('doctors as c','a.doctor_id','=','c.id')
					->select('a.id as pid','a.age','a.name as patient_name','a.phone as patient_phone','a.email as patient_email','a.crno','a.token','a.queue_status','a.device_id','a.created_at as patient_register_date','b.name as department_name','b.room_no','b.floor','c.name as doctors_name','c.phone as doctor_phone')
					->orderBy('a.created_at','desc')
					->paginate(5);
		return $data;
	}
	
	public static function getAllDepartmentDoctors(){
		$data = DB::table('patients as a')
					->join('departments as b','a.department_id','=','b.id')
					->join('doctors as c','a.doctor_id','=','c.id')
					->orderBy('a.created_at','desc')
					->paginate(5);
		return $data;
	}
	
	public static function getInfoOfToken($doctorId,$departmentId){
		$data = DB::select(DB::raw('SELECT * FROM patients where id=(select max(id) from patients where doctor_id='.$doctorId.' and department_id='.$departmentId.' and created_at like "%'.date('Y-m-d').'%")'));
		return $data;
	}

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

    public static function currentTokens($department_id, $doctor_id, $current_token){
        $current_date   =  date('Y-m-d');
        return Patients::where('department_id', $department_id)
                            ->where('doctor_id', $doctor_id)
                            ->where('queue_status', 0)
                            ->where('token', $current_token)
                            ->where('created_at', 'like', $current_date.'%')
                            ->first();
    }

}
