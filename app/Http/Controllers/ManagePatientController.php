<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
	
	public function save(Request $request){
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
			'phone' => 'required|unique:patients|max:10',
			'email' => 'required|email|unique:patients',
			'hall' => 'required',
			'department' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('manage-patient/add/')
                        ->withInput()->withErrors($validator,'patient');
        }
	}

	public function getPatientFromCrno($crno){
		return Patients::getPatientFromCrno($crno);
	}

	public function updateDeviceId($crno, $device_id){
		return Patients::updateDeviceId($crno, $device_id);
	}

	public function allTokenStatus($department_id, $doctor_id){
		//total number of tokens
		$total	=	Patients::allTokens($department_id, $doctor_id);
			
		//active token
		$active_tokens	=	Patients::activeTokens($department_id, $doctor_id);

		//current token
		$current_token	=	$active_tokens	+	1;

		//merge and return
		$merge	=	['total'=>$total, 'active'=>$active_tokens, 'current'=>$current_token];
		
		return $merge;
	}

	/*
		patientData API Default Json View

		we get device_id and crno

		and response will be

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

	public function patientData($crno, $device_id){
		//get device_id and crno
		//Check CR No is valid or not
		$isValidCrno	=	Patients::isValidCrno($crno);
		if(!$isValidCrno){
			//if not valid then
			return response()->json(['status' => false, 'data' => []]);
		}else{
			//else
			//update device_id
			$this->updateDeviceId($crno, $device_id);
			
			//get patient record
			$patientData	=	$this->getPatientFromCrno($crno);
			$department_id	=	$patientData->department_id;
			$doctor_id		=	$patientData->doctor_id;
			
			//get token status
			$tokenStatus	=	$this->allTokenStatus($department_id, $doctor_id);

			//format data according to response
			//$get_department	=	
			$format	=	[
				"status"=> true,
				"data"=> [
					"patient_name" => $patientData->name,
					"department" => $department_id,
					"floor" => $patientData->name,
					"room_number" => $patientData->name,
					"doctor_name" => $doctor_id,
					"patient_phone" => $patientData->phone,
					"patient_email" => $patientData->email,
					"crno" => $patientData->crno,
					"waiting_hall" => $patientData->hall_id,
					"patient_token" => $patientData->token,
					"token_status" => $tokenStatus['current'],
					"token_total" => $tokenStatus['total']
				]
			];
			
			dd($format);

			// reponse in json
			return response()->json(['status' => true, 'data' => []]);
		}
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
