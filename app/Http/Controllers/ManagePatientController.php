<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagePatientController extends Controller
{
    public function index(){
		$title = "Patients List";
		return view('ManagePatients.list')->with('title',$title);
	}
	
	public function add(){
		return view('ManagePatients.addPatient');
	}

	public function patientData($crno, $device_id){
		//dd('welcome', $crno, $device_id);
		return response()->json(['name' => 'Abigail', 'state' => 'CA']);
	}
}
