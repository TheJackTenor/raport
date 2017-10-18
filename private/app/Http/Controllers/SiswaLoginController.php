<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use Input;
use Auth;

error_reporting(0);

class SiswaLoginController extends Controller
{
    public function nilai(){

        if (request()->is('nilai/pengetahuan')) {
            $message = 'Nilai Pengetahuan';
            $url = 'nilai/pengetahuan/view';
        }elseif (request()->is('nilai/keterampilan')) {
            $message = 'Nilai Keterampilan';
            $url = 'nilai/keterampilan/view';
        }elseif (request()->is('nilai/spiritual')) {
            $message = 'Nilai Spiritual';
            $url = 'nilai/spiritual/view';
        }elseif (request()->is('nilai/sosial')) {
            $message = 'Nilai Sosial';
            $url = 'nilai/sosial/view';
        }

    	return View::make('formsiswa/nilaipengetahuan')->with(session()->forget('status_pengetahuan'))->with('message',$message)->with('url',$url);
    }

    public function nilaipreview(){

        if (request()->is('nilai/pengetahuan/view')) {
            $message = 'Nilai Pengetahuan';
            $kd = 1;
        }elseif (request()->is('nilai/keterampilan/view')) {
             $message = 'Nilai Keterampilan';
            $kd = 2;
        }elseif (request()->is('nilai/spiritual/view')) {
            $message = 'Nilai Spiritual';
            $kd = 3;
        }elseif (request()->is('nilai/sosial/view')) {
             $message = 'Nilai Sosial';
            $kd = 4;
        }

        $datasiswa = DB::table('datasiswa')->select('namasiswa','id','nis')->where('id','=',Auth()->user()->id_siswa)->get();

        session()->flash('kd',$kd);
        

        $pengetahuan = DB::table('nilai')->select('id_siswa','nilai','predikat','id','id_guru','deskripsi','ttt')->where('id_kelas','=',Session()->get('id_kelas'))->where('id_pelajaran','=',Input::get('pelajaran'))->where('id_siswa','=',Auth::user()->id_siswa)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',$kd)->first();

        $detail = DB::table('nilai')->join('detailnilai', function($join){
            $join->on('nilai.id','=','detailnilai.id_nilai')->where('nilai.id_kelas','=',Session()->get('id_kelas'))->where('nilai.id_pelajaran','=',Input::get('pelajaran'))->where('nilai.id_siswa','=',Auth::user()->id_siswa)->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'))->where('nilai.kd_aspek','=',session()->get('kd'));
        })->select('detailnilai.kd','detailnilai.id_nilai')->get();

        $data_kd = DB::table('kd')->select('kd')->where('id_kelas','=',Session()->get('id_kelas'))->where('id_pelajaran','=',Input::get('pelajaran'))->where('id_guru','=',$pengetahuan->id_guru)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',$kd)->get();

        $data_kkm = DB::table('datadasarnilai')->select('kkm','ckmpengetahuan')->where('id_pelajaran','=',Input::get('pelajaran'))->where('jurusan','=',session()->get('jurusankelas'))->where('gol_kelas','=',session()->get('golongankelas'))->first();

        $namapelajaran = DB::table('datapelajaran')->select('namapelajaran','id')->where('id','=',Input::get('pelajaran'))->first();

      
            return View::make('formsiswa/nilaipengetahuan')->with('datasiswa',$datasiswa)->with('pengetahuan',$pengetahuan)->with('detail',$detail)->with('kontenkd',$data_kd)->with('infonilai',$data_kkm)->with('namapelajaran',$namapelajaran)->with(session()->set('status_pengetahuan','yes'))->with('message',$message);
    }

}



