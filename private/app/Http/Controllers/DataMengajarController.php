<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DataMengajarValidator;
use App\KelasWali;
use App\GuruWali;
use App\Http\Requests\DataMengajarGuru;
use Input;
use DB;
use Redirect;
use View;
use Auth;
use Session;

class DataMengajarController extends Controller
{

    //==========================================================ADMINISTRATOR SECTION========================================================================//
    public function datamengajar(){
    	$data = DB::table('dataguru')->select('id','namaguru','nip','statusmengajar')->get();
    	$data2 = DB::table('datapelajaran')->select('id','namapelajaran')->where('namapelajaran','<>','-')->get();
    	$data3 = GuruWali::get();

    	return View::make('datamengajar')->with('dataguru',$data)->with('datapelajaran',$data2)->with('datamengajarjoin',$data3)->with(session()->forget('status'));
    }

    public function inputdatamengajar(DataMengajarValidator $validator){
    	$data2 = array(
    		'statusmengajar' => '1',
    		);


    	$pilihpelajaranArray = $_POST['pilihpelajaran'];
    	foreach ($pilihpelajaranArray as $key => $value) {   	
    	$data = array(
    		'id_guru' => Input::get('pilihguru'),
    		'id_pelajaran' => $value,
    		);
    	DB::table('datamengajar')->insert($data);
    	}
    	DB::table('dataguru')->where('id','=',Input::get('pilihguru'))->update($data2);
    	return Redirect::to('manajemenguru/datamengajar')->with('message','Data mengajar berhasil ditambahkan !');
    }
    
    public function hapusdatamengajar($id){
    	$data = array(
    		'statusmengajar' => '0',
    		);
    	DB::table('datamengajar')->where('id_guru','=',$id)->delete();
    	DB::table('dataguru')->where('id','=',$id)->update($data);

    	return Redirect::to('manajemenguru/datamengajar')->with('message','Data mengajar berhasil dihapus !');
    }

    public function edit($id){
    	$data2 = GuruWali::find($id);
    	$data=DB::table('dataguru')->select('nip','namaguru','id')->where('id','=',$id)->first();
    	$data3=DB::table('datapelajaran')->select('id','namapelajaran')->get();
    	return View::make('datamengajar')->with('revolution',$data)->with('revolution2',$data2)->with('revolution3',$data3)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function editeksekutor(DataMengajarValidator $validator){
    	DB::table('datamengajar')->where('id_guru','=',Input::get('id'))->delete();
    	$pilihpelajaranArray = $_POST['pilihpelajaran'];
    	foreach ($pilihpelajaranArray as $key => $value) {   	
    	$data = array(
    		'id_guru' => Input::get('id'),
    		'id_pelajaran' => $value,
    		);
    	DB::table('datamengajar')->insert($data);
    	}
    	return Redirect::to('manajemenguru/datamengajar')->with('message','Data mengajar berhasil diupdate !');
    }

    //==========================================================ADMINISTRATOR SECTION========================================================================//

    public function datamengajarguru(){
        $data2 = DB::table('datapelajaran')->select('id','namapelajaran')->where('namapelajaran','<>','-')->get();
        $data3 = GuruWali::where('id','=',Session::get('id_guru'))->get();

        return View::make('formguru/datamengajar')->with('datapelajaran',$data2)->with('datamengajarjoin',$data3)->with(session()->forget('status'));
    }

     public function inputdatamengajarguru(DataMengajarGuru $validator){
        $data2 = array(
            'statusmengajar' => '1',
            );


        $pilihpelajaranArray = $_POST['pilihpelajaran'];
        foreach ($pilihpelajaranArray as $key => $value) {      
        $data = array(
            'id_guru' => Input::get('id_guru'),
            'id_pelajaran' => $value,
            );
        DB::table('datamengajar')->insert($data);
        }
        DB::table('dataguru')->where('id','=',Input::get('id_guru'))->update($data2);
        return Redirect::back()->with('message','Data mengajar berhasil ditambahkan !');
    }

    public function editguru($id){

        $data2 = GuruWali::find($id);
        $data=DB::table('dataguru')->select('nip','namaguru','id')->where('id','=',$id)->first();
        $data3=DB::table('datapelajaran')->select('id','namapelajaran')->get();
        return View::make('formguru/datamengajar')->with('revolution',$data)->with('revolution2',$data2)->with('revolution3',$data3)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));

    }


     public function editeksekutorguru(DataMengajarValidator $validator){
        DB::table('datamengajar')->where('id_guru','=',Input::get('id'))->delete();
        $pilihpelajaranArray = $_POST['pilihpelajaran'];
        foreach ($pilihpelajaranArray as $key => $value) {      
        $data = array(
            'id_guru' => Input::get('id'),
            'id_pelajaran' => $value,
            );
        DB::table('datamengajar')->insert($data);
        }
        return Redirect::to('manajemenguru/guru/datamengajar')->with('message','Data mengajar berhasil diupdate !');
    }


    
}
