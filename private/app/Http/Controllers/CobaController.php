<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Input;

class CobaController extends Controller
{
    public function save(){
    	$data = array(
    		'pelajaran' => Input::get('pilihpelajaran'),
    		'kelas' => Input::get('pilihkelas'),


    		);

    	DB::table('cobaaja')->insert($data);
    	return Redirect::to('homelanding');
    }
}
