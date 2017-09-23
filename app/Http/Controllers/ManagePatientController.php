<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Patients;

class ManagePatientController extends Controller
{
    public function index(){
		$title = "Patients List";
		return view('ManagePatients.list')->with('title',$title);
	}
	
	public function add(){
		return view('ManagePatients.addPatient');
	}

	public function getPatientFromCrno($crno){
		return Patients::getPatientFromCrno($crno);
	}

	public function updateDeviceId($crno, $device_id){
		return Patients::updateDeviceId($crno, $device_id);
	}


	public function patientData($crno, $device_id){
		/*
		Default Json View

		{
			"status": true,
			"data": {
				"patient_name": "ABC",
				"department": "Medicine",
				"floor": 2,
				"room_number": 45,
				"doctor_name": "Dr. Summit Verma",
				"patient_phone": 9914466774,
				"patient_email": "hjhjhj@gmail.com",
				"crno": 545454545,
				"waiting_hall": "XZ",
				"patient_token": 5,
				"token_status": 1,
				"token_total": 10
			}
		}
		*/

		//get device_id and crno
		//Check CR No is valid or not
		//if no then
			//return response()->json(['status' => false, 'data' => []]);
		//if yes
		//update device_id
			$this->updateDeviceId($crno, $device_id);
		//get patient record
			$patientData	=	$this->getPatientFromCrno($crno);
		dd($patientData->name);
		//get token status


		return response()->json(['status' => true, 'data' => []]);
	}

	public function isDoctorValid($doctor_phone){
		/*
		Default Json

			{
				"status": true,
				"otp": 1234,
				"data": {
					"name": "Dr.Summet Verma",
					"phone": 9914477885,
					"department": "Medicine",
					"floor": 2,
					"room_no": 45,
					"token_total": 50
				}
			}

		*/
		return response()->json(['status' => true, 'data' => []]);
	}

	public function tokenStatus($doctor_phone){
		/*
		Default Json

			{
			"status": true,
			"otp": 1234,
			"data": {
				"patient": {
					"name": "ABC",
							"department": "Medicine",
							"floor": 2,
							"room_number": 45,
							"doctor_name": "Dr. Summit Verma",
							"phone": 9914466774,
							"email": "hjhjhj@gmail.com",
							"crno": 545454545,
							"waiting_hall": "XZ",
							"token": 5
				},
				"token":{
				"status": 1,
						"total": 10
				}
			}
			}

		*/
		return response()->json(['status' => true, 'data' => []]);
	}
}
