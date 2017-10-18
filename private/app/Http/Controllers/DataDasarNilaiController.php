<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KelasValidator;
use App\Http\Requests\Kelas2Validator;
use App\DataDasarNilai;
use Input;
use DB;
use Redirect;
use View;
use Session;
use Auth;

class DataDasarNilaiController extends Controller
{
    public function datadasarnilai(){

    	$data = DataDasarNilai::orderBy('id_pelajaran','asc')->orderBy('jurusan','asc')->orderBy('gol_kelas','asc')->get();
    	$datapelajaran = DB::table('datapelajaran')->select('id','namapelajaran')->where('namapelajaran','<>','-')->get();


    	return View::make('datadasarnilai')->with('value',$data)->with('valuepelajaran',$datapelajaran)->with(session()->forget('status'));

    }

    public function simpandatadasarnilai(){

        $jurusanpelajaranArray = $_POST['jurusanpelajaran'];
        $golongankelasArray = $_POST['golongankelas'];

        foreach ($golongankelasArray as $bey => $golongan) {

            foreach ($jurusanpelajaranArray as $key => $jurusan) {
                $data = array(
                    'id_pelajaran' => Input::get('datapelajaran'),
                    'jurusan' => $jurusan,
                    'gol_kelas' => $golongan,
                    'kkm' => Input::get('kkm'),
                    'ckmpengetahuan' => Input::get('ckmpengetahuan'),
                    'ckmketerampilan' => Input::get('ckmketerampilan'),
                    'ckmsikap' => Input::get('ckmsikap'),
                    );

                 DB::table('datadasarnilai')->insert($data);

            }
        } 	
    	return Redirect::to('manajemenpelajaran/manajemendatadasarnilai')->with(Session()->flash('message','Data dasar nilai berhasil ditambahkan !'));
    }

    public function edit($id){
    	$data=DataDasarNilai::find($id);
    	return View::make('datadasarnilai')->with('revolution',$data)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function prosesedit(){
    	$data = array(
    		'id_pelajaran' => Input::get('datapelajaran'),
    		'jurusan' => Input::get('jurusanpelajaran'),
    		'gol_kelas' => Input::get('golongankelas'),
    		'kkm' => Input::get('kkm'),
    		'ckmpengetahuan' => Input::get('ckmpengetahuan'),
    		'ckmketerampilan' => Input::get('ckmketerampilan'),
    		'ckmsikap' => Input::get('ckmsikap'),
    		);
    	DB::table('datadasarnilai')->where('id','=',Input::get('id'))->update($data);

    	return Redirect::to('manajemenpelajaran/manajemendatadasarnilai')->with(Session()->flash('message','Data dasar nilai berhasil diedit !'));
    }

    public function hapus($id){
    	DB::table('datadasarnilai')->where('id','=',$id)->delete();
    	return Redirect::to('manajemenpelajaran/manajemendatadasarnilai')->with('message','Data dasar nilai berhasil dihapus !');
    }
}
