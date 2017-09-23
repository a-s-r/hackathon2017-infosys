<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Halls extends Model
{
    protected $table = 'halls';
	public $fillable = ['name','capacity'];
	
	public static function getAllHalls(){
		$halls = DB::table('halls')->paginate(1);
		return $halls;
	}
}
