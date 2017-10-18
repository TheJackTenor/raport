<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminValidator;
use DB;
use Input;
use View;
use Redirect;

class AdminController extends Controller
{
    public function dataadmin(){
    	$data = DB::table('user')->select('username','id','email')->where('hak_akses','=',1)->get();
    	return View::make('manajemenadmin')->with('swan',$data)->with(session()->forget('status'));
    }

    public function tambahadmin(AdminValidator $validator){
    	$data = array(
    		'username' => Input::get('namaadmin'),
    		'email' => Input::get('email'),
    		'password' => bcrypt(Input::get('password')),
    		'hak_akses' => 1
    		);
    	DB::table('user')->insert($data);

    	return Redirect::to('manajemenadmin/admin')->with('message','Data admin berhasil ditambahkan !');
    }

    public function tampileditadmin($id){
    	$data = DB::table('user')->select('username','email','id')->where('id','=',$id)->first();
    	return View::make('manajemenadmin')->with('swan',$data)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function proseseditadmin(){
    	$data = array(
    		'username' => Input::get('namaadmin'),
    		'email' => Input::get('email')
    		);
    	DB::table('user')->where('id','=',Input::get('id'))->update($data);

    	return Redirect::to('manajemenadmin/admin')->with('message','Data admin berhasil diubah !');

    }

    public function hapusadmin($id){
    	DB::table('user')->where('id','=',$id)->delete();
    	return Redirect::to('manajemenadmin/admin')->with('message','Data admin berhasil dihapus !');

    }
}
