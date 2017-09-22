<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio;
class MessageController extends Controller
{
   public function index(){
	    return view('users');
   }
   
   public function sendMessage(Request $request){
	   
	   Twilio::message("+918219452232",$request->input('sendmessage'));
	   die();
   }
}
