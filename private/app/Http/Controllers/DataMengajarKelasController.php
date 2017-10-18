<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DataMengajarValidator;
use App\Http\Requests\DataMengajarKelasGuru;
use App\GuruWali;
use Input;
use DB;
use Redirect;
use View;
use Auth;
use Session;

class DataMengajarKelasController extends Controller
{

    //===========================================================ADMIN SECTION======================================================================//
    public function datamengajarkelas(){
    	$data = GuruWali::get();
    	$data2 = DB::table('datakelas')->select('id','namakelas')->get();
    	return View::make('datamengajarkelas')->with('datamengajarkelasjoin',$data)->with('datakelas',$data2)->with(session()->forget('status'));
    }

     public function inputdatamengajarkelas(){
    	$data2 = array(
    		'statusmengajarkelas' => '1',
    		);


    	$pilihkelasArray = $_POST['pilihkelas'];
    	foreach ($pilihkelasArray as $key => $value) {   	
    	$data = array(
    		'id_guru' => Input::get('pilihguru'),
    		'id_kelas' => $value,
    		);
    	DB::table('datamengajarkelas')->insert($data);
    	}
    	DB::table('dataguru')->where('id','=',Input::get('pilihguru'))->update($data2);
    	return Redirect::to('manajemenguru/datamengajarkelas')->with('message','Data mengajar berhasil ditambahkan !');
    }

    public function editdatamengajarkelas($id){
    	$data = GuruWali::find($id);
    	$data2 = DB::table('datakelas')->select('id','namakelas')->get();

    	return View::make('datamengajarkelas')->with('revolution2',$data)->with('revolution3',$data2)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    
	}

	 public function editeksekutor(){
    	DB::table('datamengajarkelas')->where('id_guru','=',Input::get('id'))->delete();
    	$pilihkelasArray = $_POST['pilihkelas'];
    	foreach ($pilihkelasArray as $key => $value) {   	
    	$data = array(
    		'id_guru' => Input::get('id'),
    		'id_kelas' => $value,
    		);
    	DB::table('datamengajarkelas')->insert($data);
    	}
    	return Redirect::to('manajemenguru/datamengajarkelas')->with('message','Data mengajar berhasil diupdate !');
    }


    //===========================================================ADMIN SECTION======================================================================//

    //===========================================================GURU SECTION======================================================================//

      public function datamengajarkelasguru(){
        $data = GuruWali::where('id','=',Session::get('id_guru'))->get();
        $data2 = DB::table('datakelas')->select('id','namakelas')->get();
        return View::make('formguru/datamengajarkelas')->with('datamengajarkelasjoin',$data)->with('datakelas',$data2)->with(session()->forget('status'));
    }

     public function inputdatamengajarkelasguru(DataMengajarKelasGuru $validator){
        $data2 = array(
            'statusmengajarkelas' => '1',
            );


        $pilihkelasArray = $_POST['pilihkelas'];
        foreach ($pilihkelasArray as $key => $value) {      
        $data = array(
            'id_guru' => Input::get('id_guru'),
            'id_kelas' => $value,
            );
        DB::table('datamengajarkelas')->insert($data);
        }
        DB::table('dataguru')->where('id','=',Input::get('id_guru'))->update($data2);
        return Redirect::back()->with('message','Data mengajar berhasil ditambahkan !');
    }


     public function editdatamengajarkelasguru($id){
        $data = GuruWali::find($id);
        $data2 = DB::table('datakelas')->select('id','namakelas')->get();

        return View::make('formguru/datamengajarkelas')->with('revolution2',$data)->with('revolution3',$data2)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    
    }

     public function editeksekutorguru(){
        DB::table('datamengajarkelas')->where('id_guru','=',Input::get('id'))->delete();
        $pilihkelasArray = $_POST['pilihkelas'];
        foreach ($pilihkelasArray as $key => $value) {      
        $data = array(
            'id_guru' => Input::get('id'),
            'id_kelas' => $value,
            );
        DB::table('datamengajarkelas')->insert($data);
        }
        return Redirect::to('manajemenguru/guru/datamengajarkelas')->with('message','Data mengajar berhasil diupdate !');
    }


    public function hapusdatamengajarkelas($id){
        DB::table('datamengajarkelas')->where('id_guru','=',$id)->delete();

        $data = array(
            'statusmengajarkelas' => '0'
            );
        DB::table('dataguru')->where('id','=',$id)->update($data);

        return Redirect::back()->with('message','Data mengajar kelas berhasil dihapus !');
    }

}
