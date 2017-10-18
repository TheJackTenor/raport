<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\CekDeskripsiSikap;
use DB;
use Input;
use Redirect;


error_reporting(E_ALL & ~E_NOTICE);


class CekDeskripsiSikapController extends Controller
{
    public function show(){
        $khasagama = DB::table('datapelajaran')->select('id')->where('pknoragama','=','Agama')->first();
        $khaspkn = DB::table('datapelajaran')->select('id')->where('pknoragama','=','PKN')->first();

    	$spiritual = DB::table('nilai')->select('id_siswa','predikat','deskripsi','id')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('id_pelajaran','=',$khasagama->id)->where('kd_aspek','=',3)->whereNotNull('id_karyawan')->get();

        $sosial = DB::table('nilai')->select('id_siswa','predikat','deskripsi','id')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('id_pelajaran','=',$khaspkn->id)->where('kd_aspek','=',4)->whereNotNull('id_karyawan')->get();

        $datasiswa = DB::table('datasiswa')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();
        
    	
    	return View::make('formwali/cekdeskripsisikap')->with('spiritual',$spiritual)->with('sosial',$sosial)->with('datasiswas',$datasiswa)->with(session()->flash('status','true'));

    }

    public function simpan(){
        

        //deteksi form yang kosong
        for ($i=1; $i <= Input::get('saverow') ; $i++) { 
            if (!Input::has('spiritpre'.$i)) {
                session()->flash('message','Gagal menyimpan karena masih terdapat kolom yang kosong.');
            }
            if (!Input::has('spiritdes'.$i)) {
                session()->flash('message','Gagal menyimpan karena masih terdapat kolom yang kosong.');
            }
            if (!Input::has('sosialpre'.$i)) {
                session()->flash('message','Gagal menyimpan karena masih terdapat kolom yang kosong.');
            }
            if (!Input::has('sosialdes'.$i)) {
                session()->flash('message','Gagal menyimpan karena masih terdapat kolom yang kosong.');
            }
        }
        //

        if (!session()->has('message')) {

           for ($i=1; $i <= Input::get('saverow') ; $i++) { 
                $data = array(
                        'predikat' => Input::get('spiritpre'.$i),
                        'deskripsi' => Input::get('spiritdes'.$i)
                );

                DB::table('nilai')->where('id','=',Input::get('id_nilai_spiritual'.$i))->update($data);

                $data2 = array(
                        'predikat' => Input::get('sosialpre'.$i),
                        'deskripsi' => Input::get('sosialdes'.$i)
                );

                DB::table('nilai')->where('id','=',Input::get('id_nilai_sosial'.$i))->update($data2);

                }
            return Redirect::to('identitas/cekdeskripsisikap')->with(session()->flash('message','Data cek deskripsi sikap berhasil didupdate !'));
        }else{
            session()->flash('error','set');
            return Redirect::back()->withInput();
        }

        
    }

}