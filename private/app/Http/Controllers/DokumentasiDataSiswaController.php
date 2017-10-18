<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;

class DokumentasiDataSiswaController extends Controller
{
    public function dokumentasisiswa(){
    	$daftarsiswa = DB::table('datasiswa')->select('nisn','namasiswa')->get();
    	return View::make('formkaryawan/dokumentasidatasiswa')->with('daftarsiswa',$daftarsiswa);
    }
}
