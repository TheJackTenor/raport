<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokPelajaran;
use View;
use DB;
use Input;


class DokumentasiLegerController extends Controller
{
    public function dokumentasileger(){
        $semesterchoose = "";
    	$daftarsiswamodal = DB::table('datasiswa')->select('nisn','namasiswa','id')->get();
    	return View::make('formkaryawan/dokumentasileger')->with('daftarsiswamodal',$daftarsiswamodal)->with('semesterchoose',$semesterchoose)->with(session()->forget('showleger'))->with(session()->forget('idsiswa'));
    }

    public function searching(Request $request){
        $request->session()->flash('iwaw',$request->daftarsiswa);
        $namasiswa = DB::table('nilai')->join('datakelas', function($join) {
            $join->on('nilai.id_kelas','=','datakelas.id')->where('nilai.id_siswa','=',session()->get('iwaw'));
        })->select('datakelas.namakelas','datakelas.id','datakelas.golongankelas','datakelas.jurusankelas')->distinct()->get();

        foreach ($namasiswa as $key => $value) {
            $data[] = array("value"=> $value->id, "text"=> $value->namakelas);
            $request->session()->set('golongankelas',$value->golongankelas);
            $request->session()->set('jurusankelas',$value->jurusankelas);
            $request->session()->set('idsiswa',$request->daftarsiswa);
        }
        
    	return response()->json(array('options'=>$data));
    }

    public function show(){
        $daftarsiswamodal = DB::table('datasiswa')->select('nisn','namasiswa','id')->get();

        $semesterchoose = Input::get('semester');

        $findtahunajaran = DB::table('nilai')->select('tahunajaran')->where('id_siswa','=',Input::get('daftarsiswa'))->where('id_kelas','=',Input::get('kelas'))->first();

        session()->flash('findtahunajaran',$findtahunajaran->tahunajaran);

        $daftarsiswa = DB::table('datasiswa')->join('nilai', function($join){
            $join->on('datasiswa.id','=','nilai.id_siswa')->where('nilai.id_kelas','=',Input::get('kelas'))->where('tahunajaran','=',session()->get('findtahunajaran'));
        })->select('datasiswa.id','datasiswa.namasiswa','datasiswa.nis','datasiswa.nisn')->orderBy('datasiswa.nis','asc')->distinct()->get();


        $daftarpelajaran = KelompokPelajaran::where('jenjang','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('kelompok','<>',5)->get();

        $nilai = DB::table('nilai')->join('datasiswa', function($join) {
            $join->on('nilai.id_siswa','=','datasiswa.id')->where('nilai.id_kelas','=',Input::get('kelas'))->where('nilai.semester','=',Input::get('semester'))->where('nilai.tahunajaran','=',session()->get('findtahunajaran'));
            })->join('kelompokpelajaran', function($join2) {
            $join2->on('nilai.id_pelajaran','=','kelompokpelajaran.id_pelajaran')->where('kelompokpelajaran.jurusan','=',session()->get('jurusankelas'))->where('kelompokpelajaran.jenjang','=',session()->get('golongankelas'));
            })->select('datasiswa.nis','nilai.kd_aspek','nilai.nilai','nilai.id_siswa','nilai.id_pelajaran')->orderBy('datasiswa.nis','asc')->orderBy('kelompokpelajaran.kelompok','asc')->orderBy('nilai.id_pelajaran','asc')->get();
        
        $sia = DB::table('tidakhadir')->select('sakit','ijin','alpha','id_siswa')->where('id_kelas','=',Input::get('kelas'))->where('semester','=',Input::get('semester'))->where('tahunajaran','=',session()->get('findtahunajaran'))->get();


        return View::make('formkaryawan/dokumentasileger')->with('daftarpelajarans',$daftarpelajaran)->with('nilai',$nilai)->with('sia',$sia)->with('daftarsiswas',$daftarsiswa)->with('daftarsiswamodal',$daftarsiswamodal)->with('semesterchoose',$semesterchoose)->with(session()->flash('showleger','yes'));
    }
}
