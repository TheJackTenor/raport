<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use Input;
use JasperPHP\JasperPHP as JasperPHP;
use File;
use Response;
use Redirect;
use Storage;
use PDF;



class CetakRaportUTSController extends Controller
{
    public function show(){
      $datasiswa = DB::table('datasiswa')->select('id','namasiswa','nis','nisn')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

      return View::make('formwali/cetakraportuts')->with('datasiswas',$datasiswa);

    }

    public function cetak($mode,$id){
        $modeKkm = DB::table('pengaturan')->select('formatKKM')->first();

        if ($modeKkm->formatKKM == false) {
             $dataPelajaran = DB::table('kelompokpelajaran')->select('id_pelajaran')->where('jenjang','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('id_pelajaran','<>',34)->first();

             $kkms = DB::table('datadasarnilai')->select('ckmpengetahuan','ckmketerampilan')->where('gol_kelas','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('id_pelajaran','=',$dataPelajaran->id_pelajaran)->first();

             $brem1 = (100 - $kkms->ckmpengetahuan) / 3 + $kkms->ckmpengetahuan;
             $brem2 = 100 - (100 - $kkms->ckmpengetahuan) / 3;

             $range[1][1] = round($brem1);
             $range[1][2] = round($brem2);

             if ($kkms->ckmpengetahuan != $kkms->ckmketerampilan){
                $brem1 = (100 - $kkms->ckmketerampilan) / 3 + $kkms->ckmketerampilan;
                $brem2 = 100 - (100 - $kkms->ckmketerampilan) / 3;

                $range[2][1] = round($brem1);
                $range[2][2] = round($brem2);
             }

        }else{

            $dataPelajaran = DB::table('kelompokpelajaran')->select('id_pelajaran')->where('jenjang','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('id_pelajaran','<>',34)->get();

        

            foreach ($dataPelajaran as $key => $value) {
                $kkms = DB::table('datadasarnilai')->select('kkm')->where('gol_kelas','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('id_pelajaran','=',$value->id_pelajaran)->first();

                $kkmTemp[$key] = $kkms->kkm;
            }

            $kkm = array_unique($kkmTemp);
            sort($kkm);
        
    
            $sink = 0;
            $sink2 = 0;
            foreach ($kkm as $key => $value) {
                $sink++;
                if ($sink<=3) {
                    $sink2++;
                    $kkmVal[$sink2] = $value;
                }
            
            }
            if ($sink2<3) {
                for ($i=$sink2+1; $i <= 3 ; $i++) { 
                    $kkmVal[$i] = 0;
                }
            }


            for ($i=1; $i <= $sink2 ; $i++) { 
             $brem1 = (100 - $kkmVal[$i]) / 3 + $kkmVal[$i];
                $brem2 = 100 - (100 - $kkmVal[$i]) / 3;

                $range[$i][1] = round($brem1);
                $range[$i][2] = round($brem2);
            }

            if ($sink2<3) {
                for ($i=$sink2+1; $i <= 3 ; $i++) { 
                $range[$i][1] = 0;
                $range[$i][2] = 0;
                }
            }

        }

        $siswaname = DB::table('datasiswa')->select('namasiswa')->where('id','=',$id)->first();

        $kelas = str_replace(" ", "", session()->get('charkelas'));
        $nama = str_replace(" ", "", $siswaname->namasiswa);
        $tempat = str_replace(" ", "", session()->get('tempat'));

        $filename ="Raport_UTS_".$kelas."_".$nama;

        Storage::delete('/pdf/uts/'.$filename.'.pdf');

        $logo = DB::table('datamadrasah')->select('logo')->first();
        $logolocation = storage_path('/app/'.$logo->logo);

        
  	 
       $jasper = new JasperPHP;     

    if ($modeKkm->formatKKM == false) {

        if ($kkms->ckmpengetahuan == $kkms->ckmketerampilan) {
            $jasper->process(
            base_path() . '/masterreport/raportUtsSatuKkm.jasper',
            storage_path('app/pdf/uts/'.$filename.'/'),
            array("pdf"),
            array("jurusan" => session()->get('jurusankelas'), "jenjang" => session()->get('golongankelas'), "id_kelas" => session()->get('kelas'), "id_siswa" => $id, "semester"=> session()->get('semester'), "tahunajaran"=>session()->get('tahunajaran'), "logo"=>$logolocation, "tanggalbagi"=>session()->get('tanggal'), "tempat"=>$tempat, "kkm1"=>$kkms->ckmpengetahuan,"kkm2"=>$kkms->ckmketerampilan, "range11"=>$range[1][1], "range12"=>$range[1][2]),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();
        }else{
            $jasper->process(
            base_path() . '/masterreport/raportUtsSatuKkmBeda.jasper',
            storage_path('app/pdf/uts/'.$filename.'/'),
            array("pdf"),
            array("jurusan" => session()->get('jurusankelas'), "jenjang" => session()->get('golongankelas'), "id_kelas" => session()->get('kelas'), "id_siswa" => $id, "semester"=> session()->get('semester'), "tahunajaran"=>session()->get('tahunajaran'), "logo"=>$logolocation, "tanggalbagi"=>session()->get('tanggal'), "tempat"=>$tempat, "kkm1"=>$kkms->ckmpengetahuan,"kkm2"=>$kkms->ckmketerampilan, "range11"=>$range[1][1], "range12"=>$range[1][2], "range21"=>$range[2][1], "range22"=>$range[2][2]),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();
        }

        
    }else{
        $jasper->process(
            base_path() . '/masterreport/raportUtsTigaKkm.jasper',
            storage_path('app/pdf/uts/'.$filename.'/'),
            array("pdf"),
            array("jurusan" => session()->get('jurusankelas'), "jenjang" => session()->get('golongankelas'), "id_kelas" => session()->get('kelas'), "id_siswa" => $id, "semester"=> session()->get('semester'), "tahunajaran"=>session()->get('tahunajaran'), "logo"=>$logolocation, "tanggalbagi"=>session()->get('tanggal'), "tempat"=>$tempat, "kkm1"=>$kkmVal[1], "kkm2"=>$kkmVal[2], "kkm3"=>$kkmVal[3], "range11"=>$range[1][1], "range12"=>$range[1][2], "range21"=>$range[2][1], "range22"=>$range[2][2], "range31"=>$range[3][1], "range32"=>$range[3][2] ),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();
    }

     
            $c = 1;
            if ($mode == 'stream') {
                for     ($i=0; $i < $c; $i++) { 
                if (File::exists(storage_path('app/pdf/uts/'.$filename.'.pdf')))
                    {
                     sleep(3);
                        $file = File::get(storage_path('app/pdf/uts/'.$filename.'.pdf'));
                        return Response::make($file, 300, [
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'inline; filename="'.$filename.'"'
                        ]);

                    
                    }else{
                            $c++;
                        }
                }
            }elseif($mode == 'download'){
                for     ($i=0; $i < $c; $i++) { 
                if (File::exists(storage_path('app/pdf/uts/'.$filename.'.pdf')))
                    {
                     sleep(3);
                        $file = File::get(storage_path('app/pdf/uts/'.$filename.'.pdf'));
                        return Response::make($file, 200, [
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                        ]);

                    
                    }else{
                            $c++;
                        }
                }
            }         
    }

    public function ajax(Request $request){
        session()->set('tempat',$request->tempat);
        session()->set('tanggal',$request->tanggal);
    }

}
