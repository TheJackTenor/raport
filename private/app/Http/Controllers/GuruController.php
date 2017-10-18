<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\GuruValidator;
use App\Http\Requests\Guru2Validator;
use Input;
use DB;
use Redirect;
use View;
use Image;
use Illuminate\Contracts\Encryption\DecryptException;

class GuruController extends Controller
{
    public function inputguru(GuruValidator $validator){
    	$foto = Input::file('foto');
    	$img = Image::make(Input::file('foto'));
    	$img -> resize(140,200);
    	$img -> save('private/storage/app/'."foto-guru-".$foto->getClientOriginalName());
    	$con = "foto-guru-".$foto->getClientOriginalName();

        

    	$data = array(
    		'namaguru' => Input::get('namaguru'),
    		'nip' => Input::get('nip'),
    		'email' => Input::get('email'),
    		'alamat' => Input::get('alamat'),
    		'foto' => $con,
    		);
        DB::table('dataguru')->insert($data);
        $value = DB::table('dataguru')->max('id');

        $data2  = array(
            'email' => Input::get('email'),
            'id_guru' => $value,
            'username' => Input::get('namaguru'),
            'password' => bcrypt($value."1994"),
            'hak_akses' => '2'
            );
    	
        DB::table('user')->insert($data2);
    	return Redirect::to('manajemenguru/dataguru')->with('message','Data guru berhasil ditambahkan !');
    }

      public function dataguru(){
    	$data = DB::table('dataguru')->get();
        return View::make('manajemenguru')->with('swan',$data)->with(session()->forget('status'));
    }

    public function hapusguru($id,$id2){   	
    	Storage::delete($id2);
    	DB::table('dataguru')->where('id','=',$id)->delete();
    	return Redirect::to('manajemenguru/dataguru')->with('message','Data guru berhasil dihapus !');
    }

    public function edit($id){
    	$data=DB::table('dataguru')->where('id','=',$id)->first();
    	return View::make('manajemenguru')->with('revolution',$data)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

     public function editeksekutor(Request $request, Guru2Validator $validator){
     	if($request->file('foto') == ""){
			$data = array(
    		'namaguru' => Input::get('namaguru'),
    		'nip' => Input::get('nip'),
    		'email' => Input::get('email'),
    		'alamat' => Input::get('alamat'),
    		);
     	}
     	else{
     		Storage::delete(Input::get('idfoto'));

     		$foto = Input::file('foto');
    		$img = Image::make(Input::file('foto'));
    		$img -> resize(140,200);
    		$img -> save('private/storage/app/'.$foto->getClientOriginalName());

     		$data = array(
    			'namaguru' => Input::get('namaguru'),
    			'nip' => Input::get('nip'),
    			'email' => Input::get('email'),
    			'alamat' => Input::get('alamat'),
    			'foto' => $foto -> getClientOriginalName(),
    		);
     	}

        $data2 = array(
            'username' => Input::get('namaguru'),
            'email' => Input::get('email')
            );

        DB::table('user')->where('id_guru','=',Input::get('id'))->update($data2);    
        DB::table('dataguru')->where('id','=',Input::get('id'))->update($data);
    	return Redirect::to('manajemenguru/dataguru')->with('message','Data kelas berhasil di edit !');   	
    }
}
