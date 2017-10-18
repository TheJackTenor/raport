<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KelasValidator;
use App\Http\Requests\Kelas2Validator;
use App\KelasWali;
use App\GuruWali;
use Input;
use DB;
use Redirect;
use View;

class KelasController extends Controller
{
    public function inputkelas(KelasValidator $validator){
    	$data2 = array(
    		'statuswalikelas' => '1',
    		);

        $data3 = array(
            'hak_akses' => 3,
            );

    	$data = array(
    		'namakelas' => Input::get('namakelas'),
    		'jurusankelas' => Input::get('katjurusan'),
    		'jumlahkursi' => Input::get('kursi'),
    		'id_guru' => Input::get('pilihwali'),
    		'golongankelas' => Input::get('golongankelas'),
    		);
    	DB::table('dataguru')->where('id','=',Input::get('pilihwali'))->update($data2);
        DB::table('user')->where('id_guru','=',Input::get('pilihwali'))->update($data3);
    	DB::table('datakelas')->insert($data);
    	return Redirect::to('manajemenkelas/datakelas')->with('message','Data kelas berhasil ditambahkan !');
    }

    public function datakelas(){
    	$data = KelasWali::get();
    	$data2 = GuruWali::select('namaguru','id','nip','statuswalikelas')->get();
        return View::make('manajemenkelas')->with('swan',$data)->with('swan2',$data2)->with(session()->forget('status'));
    }

    public function hapuskelas($id, $id2){
    	$data = array(
			'statuswalikelas' => '0',
		);
        $data2 = array(
            'hak_akses' => 2,
        );

    	DB::table('dataguru')->where('id','=',$id2)->update($data);
        DB::table('user')->where('id_guru','=',$id2)->update($data2);
    	DB::table('datakelas')->where('id','=',$id)->delete();
    	return Redirect::to('manajemenkelas/datakelas')->with('message','Data kelas berhasil dihapus !');
    }

    public function edit($id){
    	$data2 = GuruWali::select('namaguru','id','nip','statuswalikelas')->get();
    	$data=DB::table('datakelas')->where('id','=',$id)->first();
    	return View::make('manajemenkelas')->with('revolution',$data)->with('swan2',$data2)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function editeksekutor(Kelas2Validator $validator){
if (Input::get('idwali') == Input::get('pilihwali')) {
	$data = array(
    		'namakelas' => Input::get('namakelas'),
    		'jurusankelas' => Input::get('katjurusan'),
    		'jumlahkursi' => Input::get('kursi'),
    		'golongankelas' => Input::get('golongankelas'),		
    		);
}
else{
	$data2 = array(
			'statuswalikelas' => '1',
		);
	$data3 = array(
			'statuswalikelas' => '0',
		);
    $data4 = array(
        'hak_akses' => 3
        );
    $data5 = array(
        'hak_akses' => 2
        );
	$data = array(
    		'namakelas' => Input::get('namakelas'),
    		'jurusankelas' => Input::get('katjurusan'),
    		'jumlahkursi' => Input::get('kursi'),
    		'id_guru' => Input::get('pilihwali'),
    		'golongankelas' => Input::get('golongankelas'),		
    		);
		DB::table('dataguru')->where('id','=',Input::get('pilihwali'))->update($data2);
    	DB::table('dataguru')->where('id','=',Input::get('idwali'))->update($data3);
        DB::table('user')->where('id_guru','=',Input::get('pilihwali'))->update($data4);
        DB::table('user')->where('id_guru','=',Input::get('idwali'))->update($data5);
}    	
    	DB::table('datakelas')->where('id','=',Input::get('id'))->update($data);   	
    	return Redirect::to('manajemenkelas/datakelas')->with('message','Data kelas berhasil di edit !');
    }
}
