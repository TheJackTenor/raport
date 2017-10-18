<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\MatapelajaranValidator;
use Input;
use DB;
use Redirect;
use View;

class MatapelajaranController extends Controller
{
    public function datapelajaran(){
    	$data = DB::table('datapelajaran')->where('namapelajaran','<>','-')->get();   	   
    	return View::make('manajemenpelajaran')->with('swan',$data)->with(session()->forget('status'));
    }

    public function inputmatapelajaran(MatapelajaranValidator $validator){
    	$data = array(
    		'namapelajaran' => Input::get('namapelajaran'),
            'pknoragama' => Input::get('pknoragama'),
            'agamaandbudi' => Input::get('agamaandbudi')
    		);
    	DB::table('datapelajaran')->insert($data);
    	return Redirect::to('manajemenpelajaran/datapelajaran')->with('message','Data kelas berhasil ditambahkan !');
    }

    public function edit($id){
    	$data = DB::table('datapelajaran')->where('id','=',$id)->first();
    	return View::make('manajemenpelajaran')->with('revolution',$data)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function editeksekutor(){
        $check = DB::table('datapelajaran')->select('pknoragama')->where('id','=',Input::get('id'))->first();
        if ($check->pknoragama == Input::get('pknoragama')) {
            $data = array(
            'namapelajaran' => Input::get('namapelajaran'),
            'pknoragama' => Input::get('pknoragama'),
            'agamaandbudi' => Input::get('agamaandbudi')
            );
            DB::table('datapelajaran')->where('id','=',Input::get('id'))->update($data);
            return Redirect::to('manajemenpelajaran/datapelajaran')->with('message','Data mata pelajaran berhasil di edit !');
        }else{
            $check2 = DB::table('datapelajaran')->where('pknoragama','=',Input::get('pknoragama'))->count();
            if ($check2 == 1) {     
                $string = 'manajemenpelajaran/datapelajaran/edit/'.Input::get('id');       
                return Redirect::to($string)->with(session()->flash('error','Sudah ada pelajaran yang berstatus '.Input::get('pknoragama')));
            }elseif($check2 != 1){
                $data = array(
                    'namapelajaran' => Input::get('namapelajaran'),
                    'pknoragama' => Input::get('pknoragama'),
                    'agamaandbudi' => Input::get('agamaandbudi')
                );
                DB::table('datapelajaran')->where('id','=',Input::get('id'))->update($data);
                return Redirect::to('manajemenpelajaran/datapelajaran')->with('message','Data mata pelajaran berhasil di edit !');
            }
            
        }
	
    }

    public function hapusmatapelajaran($id){
    	DB::table('datapelajaran')->where('id','=',$id)->delete();
    	return Redirect::to('manajemenpelajaran/datapelajaran')->with('message','Data mata pelajaran berhasil dihapus !');
    }
}
