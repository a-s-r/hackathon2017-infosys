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
					->select('a.name as patient_name','a.phone as patient_phone','a.email as patient_email','a.crno','a.token','a.queue_status','a.device_id','a.created_at as patient_register_date','b.name as department_name','b.room_no','b.floor','c.name as doctors_name','c.phone as doctor_phone')
					->get();
		return $data;
	}
	
	public static function getInfoOfToken($doctorId,$departmentId){
		$data = DB::select(DB::raw('SELECT * FROM patients where id=(select max(id) from patients where doctor_id='.$doctorId.' and department_id='.$departmentId.' and created_at like "%'.date('Y-m-d').'%")'));
		return $data;
	}
}
