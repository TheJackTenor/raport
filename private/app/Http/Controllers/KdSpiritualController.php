<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use DB;
use Redirect;
use View;
use Session;
use Auth;

class KdSpiritualController extends Controller
{
    public function datakdspiritual(Request $request){

		$data= DB::table('kd')->select('kd')->where('id_karyawan','=',Session()->get('id_karyawan'))->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',3)->get();

		
		if ($data == '[]') {
			$request->session()->forget('camshaft');
			
		}
		elseif ($data != '[]') {

			$request->session()->set('camshaft','true');
		}

		 return View::make('formkaryawanbk/kdspiritual')->with('data1',$data); 
	}

	public function simpankdspiritual(){

		DB::table('kd')->where('id_karyawan','=',Session::get('id_karyawan'))->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('semester','=',Input::get('semester'))->where('tahunajaran','=',Input::get('tahunajaran'))->where('kd_kd','=',3)->delete();

		$s=0;
		for ($i=1; $i <= 10 ; $i++) { 
			$t="kd".$i;
			$tt="KD ".$i;
			if (Input::get($t) != "") {
				$data = array(
					'id_karyawan' => Session::get('id_karyawan'),
					'id_pelajaran' => Session()->get('pelajaran'),
					'id_kelas' => Session()->get('kelas'),
					'kd_kd' => 3,
					'kd' => Input::get($t),
					'nomor_kd' => $tt,
					'semester' => Input::get('semester'),
					'tahunajaran' => Input::get('tahunajaran')			
					);

				DB::table('kd')->insert($data);
			}
		}

		

		if (session()->has('swith') == false) {
			return Redirect::to('identitaskd/spiritual')->with(Session()->flash('pesan','Data KD pengetahuan berhasil disimpan !'));
		}elseif(session()->has('swith')){
			return Redirect::to('identitaskd/spiritual/filter')->with(Session()->flash('pesan','Data KD pengetahuan berhasil disimpan !'));
		}


	}

	public function ajax(Request $request){
		session()->set('semestertemp',$request->semester);
		session()->set('tahunajarantemp',$request->tahunajaran);
	}

	public function filter(Request $request){
		$data= DB::table('kd')->select('kd')->where('id_karyawan','=',Session::get('id_karyawan'))->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('semester','=',session()->get('semestertemp'))->where('tahunajaran','=',session()->get('tahunajarantemp'))->where('kd_kd','=',3)->get();

		if ($data == '[]') {
			$request->session()->forget('camshaft');
			
		}
		elseif ($data != '[]') {

			$request->session()->set('camshaft','true');
		}

		session()->flash('swith','switch');

		return View::make('formkaryawanbk/kdspiritual')->with('data1',$data); 
	}

}
