<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Halls;
use Illuminate\Support\Facades\Validator;

class ManageHallController extends Controller
{
    public function index(){
		$halls = Halls::getAllHalls();
		return view('ManageHalls.list')->with('halls',$halls);
	}
	
	public function add(){
		return view('ManageHalls.addHall');
	}
	
	public function save(Request $request){
		$validator = Validator::make($request->all(), [
            'hall_name' => 'required|max:30',
			'capacity' => 'required|max:5',
        ]);

        if ($validator->fails()) {
            return redirect('manage-hall/add')
                        ->withErrors($validator,'addHall');
        }
		$halls = new Halls;
		$halls->name = $request->input('hall_name');
		$halls->capacity = $request->input('capacity');
		$insert = $halls->save();
		if($insert){
			$request->session()->flash('alert-success',"Hall Saved Successfully");
			return redirect('/manage-hall');
		}else{
			$request->session()->flash('alert-success',"Something going wrong. Please try again later.");
			return redirect('/manage-hall');
		}		
	}
	
	public function edit($id){
		$hall = Halls::find($id);		
		return view('ManageHalls.editHall')->with('hall',$hall);
	}
	
	public function update(Request $request){
		$validator = Validator::make($request->all(), [
            'hall_name' => 'required|max:30',
			'capacity' => 'required|max:5',
        ]);

        if ($validator->fails()) {
            return redirect('manage-hall/edit/'.$id)
                        ->withErrors($validator,'addHall');
        }
		
		$halls = new Halls;
		$id = $request->input('id');
		$name = $request->input('hall_name');
		$capacity = $request->input('capacity');
		
		$update = Halls::where('id',$id)
          ->update(['name' => $name,'capacity'=>$capacity,'updated_at'=>date('Y-m-d h:i:s')]);
		 
		if($update){
			$request->session()->flash('alert-success',"Hall Updated Successfully");
			return redirect('/manage-hall');
		}else{
			$request->session()->flash('alert-success',"Something going wrong. Please try again later.");
			return redirect('/manage-hall');
		}
	}
	
	public function deleteHall(Request $request,$id){
		$hall = Halls::find($id);
		$delete = $hall->delete();
		if($delete){
			$request->session()->flash('alert-success',"Hall Deleted Successfully");
			return redirect('/manage-hall');
		}else{
			$request->session()->flash('alert-success',"Something going wrong. Please try again later.");
			return redirect('/manage-hall');
		}
	}
}	