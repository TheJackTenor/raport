<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SiswaDaftar;
use App\Http\Requests\SiswaDaftarValidator;
use App\Http\Requests\ResetPassword;
use View;
use DB;
use Input;
use Mail;
use Redirect;
use Crypt;
use URL;

error_reporting(0);

class SiswaDaftarController extends Controller
{
    public function show(){

    	if (!session()->has('siswafail') and session()->has('siswasuccess')) {
    		return View::make('siswadaftar')->with('message','Sebuah E-Mail berisi link untuk pendaftaran telah dikirimkan ke alamat E-mail anda dan akan sampai dalam 3-5 menit');
    	}elseif(session()->has('siswahas')){
            return View::make('siswadaftar')->with('message','Maaf, anda telah terdaftar');
        }elseif(session()->has('siswafail')){
    		return View::make('siswadaftar')->with('message','Maaf, Anda tidak terdaftar di dalam sistem');
    	}elseif(session()->has('naughty')){
            return View::make('siswadaftar')->with('message','Maaf, URL anda sudah kadaluarsa');
        }elseif(!session()->has('siswafail')){
            return View::make('siswadaftar')->with('message','Silahkan mendaftarkan diri ke sistem untuk melihat perkembangan nilai anda (Khusus Siswa)');
        }
    	
    }

    public function recognizing(SiswaDaftarValidator $siswadaftarvalidator){
    	$siswa = DB::table('datasiswa')->select('id')->where('email','=',Input::get('email'))->first();
        $user = DB::table('user')->select('id')->where('email','=',Input::get('email'))->first();

    	if (!$siswa) {
    		return Redirect::back()->with(session()->flash('siswafail','yes'));
    	}elseif($user){
            return Redirect::back()->with(session()->flash('siswahas','yes'));
        }else{
    		$enc = Crypt::encrypt($siswa->id);
    		$url = URL::to('/siswadaftar/'.$enc);

            $data = array(
                'enc' => $enc,
                'kd_user' => 0
                );
    		DB::table('resetpassword')->insert($data);

    		Mail::to(Input::get('email'))->send(new SiswaDaftar($url));
    		return Redirect::back()->with(session()->flash('siswasuccess','yes'));
    	}
    }

    public function register($id){
        $proov = DB::table('resetpassword')->select('enc','kd_user')->where('enc','=',$id)->where('kd_user','=',0)->first();

        if (!$proov) {
            return Redirect::back();
        }else{
            $dec = Crypt::decrypt($id);
            $username = DB::table('datasiswa')->select('namasiswa')->where('id','=',$dec)->first();
            return View::make('siswadaftardiri')->with('dec',$dec)->with('enc',$proov)->with('message','Selamat datang '.$username->namasiswa.'. Silahkan masukkan password yang akan anda gunakan untuk login ke sistem');
        }
    }

    public function create(ResetPassword $resetpassword){
        $proov = DB::table('resetpassword')->where('enc','=',Input::get('enc'))->where('kd_user','=',Input::get('kd'))->first();

        if ($proov) {
            $username = DB::table('datasiswa')->select('namasiswa','email')->where('id','=',Input::get('id'))->first();

        $data = array(
            'id_siswa' => Input::get('id'),
            'password' => bcrypt(Input::get('passwordconf')),
            'username' => $username->namasiswa,
            'email' => $username->email,
            'hak_akses' => 5
            );

        DB::table('user')->insert($data);

        DB::table('resetpassword')->where('enc','=',Input::get('enc'))->where('kd_user','=',Input::get('kd'))->delete();

        return View::make('email/success');
        }elseif(!$proov){
            return Redirect::to('siswadaftar')->with(session()->flash('naughty','yes'));
        }
        
    }
}
