<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use App\KelompokPelajaran;
use Redirect;
use View;

error_reporting(E_ALL & ~E_NOTICE);

class KelompokPelajaranController extends Controller
{	
	public function show(){
		$datatabel = KelompokPelajaran::orderBy('jenjang','asc')->orderBy('jurusan','asc')->orderBy('kelompok','asc')->orderBy('id_pelajaran','asc')->get();

		$datapelajaran = DB::table('datapelajaran')->select('namapelajaran','id')->where('namapelajaran','<>','-')->get();
    	return View::make('kelompokpelajaran')->with('datapelajaran',$datapelajaran)->with('datatabel',$datatabel)->with(session()->forget('status'));
	}

	public function simpan(){
		$pilihpelajaranArray = $_POST['pilihpelajaran'];
    	foreach ($pilihpelajaranArray as $key => $value) {
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => Input::get('kelompok'),
			'id_pelajaran' => $value
			);
		DB::table('kelompokpelajaran')->insert($data);
	}

	$amount = DB::table('kelompokpelajaran')->where('jenjang','=',Input::get('jenjang'))->where('jurusan','=',Input::get('jurusan'))->count();
	for ($i=$amount+1; $i <=27 ; $i++) { 
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 5,
			'id_pelajaran' => 34
			);
		DB::table('kelompokpelajaran')->insert($data);
	}

	return Redirect::to('manajemenpelajaran/kelompokpelajaran')->with('message','Data kelompok pelajaran berhasil ditambahkan !');

	}

	public function hapus($id,$id2){
		DB::table('kelompokpelajaran')->where('jenjang','=',$id)->where('jurusan','=',$id2)->delete();
		return Redirect::to('manajemenpelajaran/kelompokpelajaran')->with('message','Data kelompok pelajaran berhasil dihapus !');
	}

	public function tampiledit($id,$id2){
		$primary = KelompokPelajaran::where('jenjang','=',$id)->where('jurusan','=',$id2)->get();
		$primary2 = KelompokPelajaran::select('jenjang','jurusan')->where('jenjang','=',$id)->where('jurusan','=',$id2)->first();
		$secondary = DB::table('datapelajaran')->select('id','namapelajaran')->get();

		return View::make('kelompokpelajaran')->with('primary',$primary)->with('primary2',$primary2)->with('secondary',$secondary)->with(session()->flash('status','Silahkan edit data dengan benar !'));
	}

	public function prosesedit(){
		DB::table('kelompokpelajaran')->where('jenjang','=',Input::get('jenjang'))->where('jurusan','=',Input::get('jurusan'))->delete();

		if (Input::get('kelompoka') != "") {
		$kelompokaArray = $_POST['kelompoka'];
    	foreach ($kelompokaArray as $key => $value) {
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 1,
			'id_pelajaran' => $value
			);
		DB::table('kelompokpelajaran')->insert($data);
	}
	}

	if (Input::get('kelompokb') != "") {
	$kelompokbArray = $_POST['kelompokb'];
    	foreach ($kelompokbArray as $key => $value) {
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 2,
			'id_pelajaran' => $value
			);
		DB::table('kelompokpelajaran')->insert($data);
	}
	}

	if (Input::get('kelompokcp') != "") {
		$kelompokcpArray = $_POST['kelompokcp'];
    	foreach ($kelompokcpArray as $key => $value) {
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 3,
			'id_pelajaran' => $value
			);
		DB::table('kelompokpelajaran')->insert($data);
	}
	}
	
	if (Input::get('kelompokcl') != "") {
		$kelompokclArray = $_POST['kelompokcl'];
    	foreach ($kelompokclArray as $key => $value) {
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 4,
			'id_pelajaran' => $value
			);
		DB::table('kelompokpelajaran')->insert($data);
	}
	}

	$amount = DB::table('kelompokpelajaran')->where('jenjang','=',Input::get('jenjang'))->where('jurusan','=',Input::get('jurusan'))->count();
	for ($i=$amount+1; $i <=27 ; $i++) { 
		$data = array(
			'jenjang' => Input::get('jenjang'),
			'jurusan' => Input::get('jurusan'),
			'kelompok' => 5,
			'id_pelajaran' => 34
			);
		DB::table('kelompokpelajaran')->insert($data);
	
	}
   return Redirect::to('manajemenpelajaran/kelompokpelajaran')->with('message','Data kelompok pelajaran berhasil diedit !');
}

}
