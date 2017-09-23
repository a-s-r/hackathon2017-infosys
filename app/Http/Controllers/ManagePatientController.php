<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

	public function patientData($crno, $device_id){
		//dd('welcome', $crno, $device_id);
		return response()->json(['name' => 'Abigail', 'state' => 'CA']);
	}
}
