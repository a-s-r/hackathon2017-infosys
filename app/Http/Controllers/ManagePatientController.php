<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Departments;
use App\Doctors;
use App\Halls;
use App\Patients;
use App\User;
use Twilio;

class ManagePatientController extends Controller
{
    public function index(){
		$title = "Patients List";
		$patients = Patients::getAllPatients();
		return view('ManagePatients.list')->with('title',$title)->with('patients',$patients);
	}
	
	public function add(){
		$departments = Departments::all();
		$doctors = Doctors::all();
		$halls = Halls::all();
		$patients = Patients::all();
		return view('ManagePatients.addPatient',['departments'=>$departments,'doctors'=>$doctors,'halls'=>$halls,'patients'=>$patients]);
	}
	
	public function save(Request $request){
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
			'phone' => 'required|unique:patients|max:10',
			'age' => 'required',
			//'email' => 'required|email|unique:patients',
			'hall' => 'required',
			'department' => 'required',
			'doctor' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('manage-patient/add/')
                        ->withInput()->withErrors($validator,'patient');
        }
		
		$patient = new Patients;
		$patient->name = $request->input('name');
		$patient->phone = $request->input('phone');
		$patient->email = $request->input('email');
		$patient->hall_id = $request->input('hall');
		$patient->department_id = $request->input('department');
		$patient->doctor_id = $request->input('doctor');
		$patient->age = $request->input('age');
		$patient->address = $request->input('address');
		
		$token = $this->createToken($request->input('doctor'),$request->input('department'));
		$crno = time();
		$insert = $patient->save();
		if($insert){
			Twilio::message("+918219452232","You are registered successfully. Your token is ".$token.". CRNO is ".$crno."");
			$request->session()->flash('alert-success',"Patient Registration Form Saved Successfully");
			return redirect('/manage-patient');
		}else{
			$request->session()->flash('alert-success',"Something going wrong. Please try again later.");
			return redirect('/manage-patient');
		}	
	}
	
	private function createToken($token,$departmentId){
		// Get the Last Number of the token created in the database for the particular doctor
		$tokensInfo = Patients::getInfoOfToken($token,$departmentId);
		if(!empty($tokensInfo) && !empty($tokenInfo[0]['token'])){
			$token = $token+1;
		}else{
			$token = 1;
		}
		return $token;
	}
	
	public function getDoctorsByDepartment($id){
		$data = Doctors::where('department_id', '=', $id)->get();
		if($data){
			echo json_encode(['status' => true, 'data' => $data]);
		}else{
			return response()->json(['status' => false]);
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
			$get_department	=	Departments::find($department_id);
			$get_doctor	=	Doctors::find($doctor_id);
			$get_hall	=	Halls::find($patientData->hall_id);
			
			$format	=	[
				"status"=> true,
				"data"=> [
					"patient_name" => $patientData->name,
					"department" => $get_department->name,
					"floor" => $get_department->floor,
					"room_number" => $get_department->room_no,
					"doctor_name" => $get_doctor->name,
					"patient_phone" => $patientData->phone,
					"patient_email" => $patientData->email,
					"crno" => $patientData->crno,
					"waiting_hall" => $get_hall->name,
					"patient_token" => $patientData->token,
					"token_status" => $tokenStatus['current'],
					"token_total" => $tokenStatus['total']
				]
			];
			
			// print final output
			// dd($format);

			// reponse in json
			return response()->json($format);
		}
	}
	
	/*
		isDoctorValid function api Default Json format

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
	public function isDoctorValid($doctor_phone){
		// get doctor phone number as request parameter
		$isDoctorValid	=	Doctors::isDoctorValid($doctor_phone);
		
		if(!$isDoctorValid){
			//if not valid
			return response()->json(['status' => false, 'data' => []]);
		}else{
			//if valid
			//send OTP
			$otp	=	rand(1000,9999);
			Twilio::message("+918219452232","Your HQMS One Time Password (OTP) is ".$otp);

			//format data according to response
			$get_department	=	Departments::find($isDoctorValid->department_id);
			$get_doctor	=	Doctors::find($isDoctorValid->id);
			//get token status
			$tokenStatus	=	$this->allTokenStatus($isDoctorValid->department_id, $isDoctorValid->id);
			
			$format	=	[
				"status"	=>	true,
				"otp"		=>	$otp,
				"data"		=>	[
					"name"	=>	$get_doctor->name,
					"phone"	=>	$get_doctor->phone,
					"department"	=>	$get_department->name,
					"floor"	=>	$get_department->floor,
					"room_no"	=>	$get_department->room_no,
					"token_total"	=>	$tokenStatus['total']
				]
			];

			dd($format);
			//send response to device with required data
			return response()->json(['status' => true, 'data' => []]);
		}
		
		
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
