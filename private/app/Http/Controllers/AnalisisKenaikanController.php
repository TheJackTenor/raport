<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\AspekPengetahuan;
use App\AspekKeterampilan;
use App\KelompokPelajaran;
use App\AnalisisKenaikanKelas;
use View;
use Redirect;

error_reporting(E_ALL & ~E_NOTICE);

class AnalisisKenaikanController extends Controller
{
    public function analisis(){
    	DB::table('analisiskenaikankelas')->where('id_kelas','=',session()->get('kelas'))->delete();

    	$option = DB::table('pengaturan')->select('analisis','jumlah')->first();

    	$siswa = DB::table('datasiswa')->select('id')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

    	$agama = DB::table('datapelajaran')->select('id')->where('pknoragama','=','Agama')->first();
    	$pkn = DB::table('datapelajaran')->select('id')->where('pknoragama','=','PKN')->first();


    	$daftarpelajaran = KelompokPelajaran::where('jenjang','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('kelompok','<>',5)->get();
    	

    	if ($option->analisis == 0) {

    		foreach ($siswa as $siswas) {
    			$query = "";
    			$querys = "";
    			$status = 0;
    			$incre = 0;

    			$countagama = DB::table('nilai')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',3)->where('id_pelajaran','=',$agama->id)->where('predikat','<>','B')->where('predikat','<>','SB')->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->count();


    			if ($countagama != 0) {

    				$status = 1;


    				$predikat = DB::table('nilai')->select('predikat')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',3)->where('id_pelajaran','=',$agama->id)->where('semester','=','2/Genap')->where('predikat','<>','B')->where('predikat','<>','SB')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->first();


    				$query = "Aspek Spiritual = ".$predikat->predikat;
    			}

    			$countsosial = DB::table('nilai')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',4)->where('id_pelajaran','=',$pkn->id)->where('predikat','<>','B')->where('predikat','<>','SB')->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->count();

    			if ($countsosial != 0) {

    				$status = 1;

    				$predikat = DB::table('nilai')->select('predikat')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',4)->where('id_pelajaran','=',$pkn->id)->where('semester','=','2/Genap')->where('predikat','<>','B')->where('predikat','<>','SB')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->first();

    				$query.= " | Aspek Sosial = ".$predikat->predikat;
    			}

    			foreach ($daftarpelajaran as $daftar) {
                    $memoriPelajaran = false;

    				$ckm = DB::table('datadasarnilai')->select('ckmpengetahuan','ckmketerampilan')->where('jurusan','=',session()->get('jurusankelas'))->where('gol_kelas','=',session()->get('golongankelas'))->where('id_pelajaran','=',$daftar->id_pelajaran)->first();

    				$pengetahuan = DB::table('nilai')->select('nilai')->where('id_siswa','=',$siswas->id)->where('kd_aspek','=',1)->where('id_pelajaran','=',$daftar->id_pelajaran)->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->first();

    				if ($pengetahuan->nilai < $ckm->ckmpengetahuan) {
    					$incre++;
                        $memoriPelajaran = true;
    					if (!$pengetahuan) {
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}
    						
    					}else{
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = ".$pengetahuan->nilai." (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(PENGETAHUAN)  = ".$pengetahuan->nilai." (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN)  = ".$pengetahuan->nilai." (".$ckm->ckmpengetahuan.")";
    						}
    					}   					

    				}

    				$keterampilan = DB::table('nilai')->select('nilai')->where('id_siswa','=',$siswas->id)->where('kd_aspek','=',2)->where('id_pelajaran','=',$daftar->id_pelajaran)->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->first();

    				if ($keterampilan->nilai < $ckm->ckmketerampilan) {
                        if ($memoriPelajaran == false) {
                            $incre++;
                        }   					
    					if (!$keterampilan) {
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}
    						
    					}else{
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$keterampilan->nilai." (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$keterampilan->nilai." (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$keterampilan->nilai." (".$ckm->ckmketerampilan.")";
    						}
    					}
    					
    				}

    			}
    			
    			if ($incre > $option->jumlah) {

    				$status = 1;
    				$query.=$querys;

    				$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => $query
    					);

    			}elseif($incre <= $option->jumlah){

    				if ($status == 1) {

    					$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => $query
    					);

    				}elseif($status == 0){

    					$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => "-"
    					);

    				}

    			}

    			DB::table('analisiskenaikankelas')->insert($data);

    	}

    	}elseif($option->analisis == 1){

    		foreach ($siswa as $siswas) {
    			$query = "";
    			$querys = "";
    			$status = 0;
    			$incre = 0;

    
                $countagama = DB::table('nilai')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',3)->where('id_pelajaran','=',$agama->id)->where('predikat','<>','B')->where('predikat','<>','SB')->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->count();

    			if ($countagama != 0) {

    				$status = 1;

                   $predikat = DB::table('nilai')->select('predikat','semester')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',3)->where('id_pelajaran','=',$agama->id)->where('semester','=','2/Genap')->where('predikat','<>','B')->where('predikat','<>','SB')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->first();

                        $query.= "Aspek Spiritual = ".$predikat->predikat." (".$predikat->semester.") ";
                
    			}

    			$countsosial = DB::table('nilai')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',4)->where('id_pelajaran','=',$pkn->id)->where('predikat','<>','B')->where('predikat','<>','SB')->where('semester','=','2/Genap')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->count();

    			if ($countsosial != 0) {

    				$status = 1;

                        $predikat = DB::table('nilai')->select('predikat','semester')->where('id_siswa','=',$siswas->id)->where('id_kelas','=',session()->get('kelas'))->where('kd_aspek','=',4)->where('id_pelajaran','=',$pkn->id)->where('semester','=','2/Genap')->where('predikat','<>','B')->where('predikat','<>','SB')->where('tahunajaran','=',session()->get('tahunajaran'))->whereNotNull('id_karyawan')->first();

                        $query.= " | Aspek Sosial = ".$predikat->predikat." (".$predikat->semester.") ";
                    
    				
    			}

    			foreach ($daftarpelajaran as $daftar) {
                    $memoriPelajaran = false;

    				$ckm = DB::table('datadasarnilai')->select('ckmpengetahuan','ckmketerampilan')->where('jurusan','=',session()->get('jurusankelas'))->where('gol_kelas','=',session()->get('golongankelas'))->where('id_pelajaran','=',$daftar->id_pelajaran)->first();

    				$pengetahuan = DB::table('nilai')->where('id_kelas','=',session()->get('kelas'))->where('id_siswa','=',$siswas->id)->where('kd_aspek','=',1)->where('id_pelajaran','=',$daftar->id_pelajaran)->where('tahunajaran','=',session()->get('tahunajaran'))->sum('nilai');

                    $sumpengetahuan = $pengetahuan / 2;

    				if ($sumpengetahuan < $ckm->ckmpengetahuan) {
                        $memoriPelajaran = true;
    					$incre++;
    					if (!$sumpengetahuan) {
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = 0 (".$ckm->ckmpengetahuan.")";
    						}
    						
    					}else{
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN) = ".$sumpengetahuan." (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(PENGETAHUAN)  = ".$sumpengetahuan." (".$ckm->ckmpengetahuan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(PENGETAHUAN)  = ".$sumpengetahuan." (".$ckm->ckmpengetahuan.")";
    						}
    					}
    					

    				}

    				$keterampilan = DB::table('nilai')->where('id_kelas','=',session()->get('kelas'))->where('id_siswa','=',$siswas->id)->where('kd_aspek','=',2)->where('id_pelajaran','=',$daftar->id_pelajaran)->where('tahunajaran','=',session()->get('tahunajaran'))->sum('nilai');

                    $sumketerampilan = $keterampilan / 2;

    				if ($sumketerampilan < $ckm->ckmketerampilan) {
    					if ($memoriPelajaran == false) {
                            $incre++;
                        }
    					if (!$sumketerampilan) {
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = 0 (".$ckm->ckmketerampilan.")";
    						}
    						
    					}else{
    						if ($status == 1) {
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$sumketerampilan." (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre ==1){
    							$querys .=$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$sumketerampilan." (".$ckm->ckmketerampilan.")";
    						}elseif($status == 0 && $incre >1){
    							$querys .=" | ".$daftar->datapelajaran->namapelajaran."(KETERAMPILAN) = ".$sumketerampilan." (".$ckm->ckmketerampilan.")";
    						}
    					}
    					
    				}

    			}
    			
    			if ($incre > $option->jumlah) {

    				$status = 1;
    				$query.=$querys;

    				$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => $query
    					);

    			}elseif($incre <= $option->jumlah){

    				if ($status == 1) {

    					$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => $query
    					);

    				}elseif($status == 0){

    					$data = array(
    					'id_kelas' => session()->get('kelas'),
    					'id_siswa' => $siswas->id,
    					'tahunajaran' => session()->get('tahunajaran'),
    					'kd_analisis' => $status,
    					'keterangan' => "-"
    					);

    				}

    			}

    			DB::table('analisiskenaikankelas')->insert($data);
    			

    }
}
return Redirect::to('hasil/cetakraportuas/hasilanalisis');

}

public function show(){
	$data = AnalisisKenaikanKelas::where('id_kelas','=',session()->get('kelas'))->get();
	return View::make('formwali/analisiskenaikankelas')->with('data',$data);
}

}

    


