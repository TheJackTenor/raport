<?php

namespace App\Http\Controllers;

use App\Mail\SiswaKonfirmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ResetPassword;
use Input;
use Redirect;
use View;
use DB;
use Crypt;
use URL;

error_reporting(0);

class ResetPasswordController extends Controller
{

	public function show(){
		if (!session()->has('resettrue') and session()->has('resetfail')) {
			return View::make('email/resetform')->with('message','E-Mail yang anda masukkan tidak terdaftar di sistem');
		}elseif (!session()->has('resettrue')) {
			return View::make('email/resetform')->with('message','Silahkan Masukkan E-Mail Anda Untuk Mereset Password');
		}elseif(session()->has('resettrue')){
			return View::make('email/resetform')->with('message','Pesan konfirmasi telah dikirim ke alamat e-mail anda, silahkan tunggu 3-4 menit untuk pesan sampai ke alamat e-mail anda')->with(session()->forget('resettrue'));
		}
		
	}


    public function reset(){
    	$guru = DB::table('dataguru')->select('email','id')->where('email','=',Input::get('email'))->first();

    	if ($guru->email) {
    		$enc = Crypt::encrypt($guru->id);
    		$url = URL::to('/resetpassword/'.$enc);

    		$guruinsert = array(
    			'enc' => $enc,
    			'kd_user' => 1
    			);

    		DB::table('resetpassword')->insert($guruinsert);

    		Mail::to(Input::get('email'))->send(new SiswaKonfirmasi($url));
    		return Redirect::back()->with(session()->flash('resettrue','yes'));
    	}elseif(!$guru->email){
    		return Redirect::back()->with(session()->flash('resetfail','yes'));
    	}
  
    }

    public function penetration($id){
    	$pene = DB::table('resetpassword')->where('enc','=',$id)->first();

    	if (!$pene) {
    		return Redirect::to('formlogon');
    	}elseif($pene){
    		$dec = Crypt::decrypt($id);
    		return View::make('email/reset_penetration')->with('message','Silahkan masukkan password yang baru')->with('dec',$dec)->with('kd_user',$pene)->with('enc',$id);
    	}

    }

    public function eksekusi(ResetPassword $resetpassword){
    	if (Input::get('kd') == 1) {
    		DB::table('user')->where('id_guru','=',Input::get('id'))->update(['password' => bcrypt(Input::get('passwordconf'))]);

    		DB::table('resetpassword')->where('enc','=',Input::get('enc'))->delete();

    		return View::make('email/success');
    	}
    }
}
