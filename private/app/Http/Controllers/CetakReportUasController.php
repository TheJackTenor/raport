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
use App\KelompokPelajaran;
use LynX39\LaraPdfMerger\PdfManage;

class CetakReportUasController extends Controller
{
    public function show(){
        $semesterNow = DB::table('pengaturan')->select('semester')->first();
        $datasiswa = DB::table('datasiswa')->select('id','namasiswa','nis','nisn')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();
        $countanalisis = DB::table('analisiskenaikankelas')->where('id_kelas','=',session()->get('kelas'))->where('tahunajaran','=',session()->get('tahunajaran'))->count();


     return View::make('formwali/cetakraportuas')->with('datasiswas',$datasiswa)->with('statusanalisis',$countanalisis)->with('semesterNow',$semesterNow);
    }

    public function cetak($id){
        
        $kkm = DB::table('datadasarnilai')->select('kkm')->where('gol_kelas','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->first();
        $khasagama = DB::table('datapelajaran')->select('id')->where('pknoragama','=','Agama')->first();
        $khaspkn = DB::table('datapelajaran')->select('id')->where('pknoragama','=','PKN')->first();

        $range22 = (100 - $kkm->kkm) / 3 + $kkm->kkm;
        $range33 = 100 - (100 - $kkm->kkm) / 3;

        $range2 = round($range22);
        $range3 = round($range33);

        $jasper = new JasperPHP;

        $logo = DB::table('datamadrasah')->select('logo')->first();
        $logolocation = storage_path('/app/'.$logo->logo);

        $naikkelas = DB::table('analisiskenaikankelas')->select('kd_analisis')->where('id_siswa','=',$id)->first();

        if (session()->get('golongankelas') == "X") {
            $kekelas = "XI";
        }else{
            $kekelas = "XII";
        }

        if (session()->get('golongankelas') == "X") {            

        $filename1 = session()->get('kelas')."cetakraportuas1".$id;
        $filename2 = session()->get('kelas')."cetakraportuas2".$id;
        $filename3 = session()->get('kelas')."cetakraportuas3".$id;
        $filename4 = session()->get('kelas')."cetakraportuas4".$id;
        $filename5 = session()->get('kelas')."cetakraportuas5".$id;
        $filename6 = session()->get('kelas')."cetakraportuas6".$id;
        $filename7 = session()->get('kelas')."cetakraportuas7".$id;
        $filename8 = session()->get('kelas')."cetakraportuas8".$id;
        $filename9 = session()->get('kelas')."cetakraportuas9".$id;

        Storage::delete('/pdf/uas/'.$filename1.'.pdf');
        Storage::delete('/pdf/uas/'.$filename2.'.pdf');
        Storage::delete('/pdf/uas/'.$filename3.'.pdf');
        Storage::delete('/pdf/uas/'.$filename4.'.pdf');
        Storage::delete('/pdf/uas/'.$filename5.'.pdf');
        Storage::delete('/pdf/uas/'.$filename6.'.pdf');
        Storage::delete('/pdf/uas/'.$filename7.'.pdf');
        Storage::delete('/pdf/uas/'.$filename8.'.pdf');
        Storage::delete('/pdf/uas/'.$filename9.'.pdf');          

     $jasper->process(
            base_path() . '/masterreport/uashal1.jasper',
            storage_path('app/pdf/uas/'.$filename1.'/'),
            array("pdf"),
            array("id_siswa"=>$id , "logo"=>$logolocation),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

     $jasper->process(
            base_path() . '/masterreport/uashal2.jasper',
            storage_path('app/pdf/uas/'.$filename2.'/'),
            array("pdf"),
            array("logo"=>$logolocation),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

     $jasper->process(
            base_path() . '/masterreport/uashal3.jasper',
            storage_path('app/pdf/uas/'.$filename3.'/'),
            array("pdf"),
            array("id_siswa"=>$id, "tempat"=>session()->get('tempat') , "tanggalbagi"=>session()->get('tanggal2')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

    $jasper->process(
            base_path() . '/masterreport/uashal4.jasper',
            storage_path('app/pdf/uas/'.$filename4.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas'), "id_pelajaran_spiritual" => $khasagama->id, "id_pelajaran_sosial" => $khaspkn->id, "tanggalbagi"=>session()->get('tanggal2'), "tempat"=>session()->get('tempat')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

    $jasper->process(
            base_path() . '/masterreport/uashal5.jasper',
            storage_path('app/pdf/uas/'.$filename5.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "jurusan"=>session()->get('jurusankelas') , "golongankelas"=>session()->get('golongankelas') , "range1"=>$kkm->kkm , "range2"=>$range2 , "range3"=>$range3 , "tempat"=>session()->get('tempat') , "tanggalbagi"=>session()->get('tanggal')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();


      $jasper->process(
            base_path() . '/masterreport/uashal6revisi_check.jasper',
            storage_path('app/pdf/uas/'.$filename6.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "jurusan"=>session()->get('jurusankelas') , "golongankelas"=>session()->get('golongankelas')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();


      $jasper->process(
            base_path() . '/masterreport/uashal7.jasper',
            storage_path('app/pdf/uas/'.$filename7.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "naik"=>0 , "kelas"=>$kekelas , "tanggalbagi"=>session()->get('tanggal') , "tempat"=>session()->get('tempat')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

       $jasper->process(
            base_path() . '/masterreport/uashal8.jasper',
            storage_path('app/pdf/uas/'.$filename8.'/'),
            array("pdf"),
            array("id_siswa"=>$id),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

        $jasper->process(
            base_path() . '/masterreport/uashal9.jasper',
            storage_path('app/pdf/uas/'.$filename9.'/'),
            array("pdf"),
            array("id_siswa"=>$id),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

            $c = 1;

            for ($i=0; $i < $c; $i++) { 
                if (File::exists(storage_path('app/pdf/uas/'.$filename9.'.pdf')))
                {
                    sleep(10);
                    $pdf = new PdfManage;
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename1.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename2.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename3.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename4.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename5.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename6.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename7.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename8.'.pdf'), 'all');
                    $pdf->addPDF(storage_path('app/pdf/uas/'.$filename9.'.pdf'), 'all');

                    $iwaw = storage_path('app/pdf/uas/cetakraportuasfinal'.$id.session()->get('kelas').".pdf");
                    $pdf->merge('file', $iwaw, 'P');
      

                    
                }else{
                        $c++;
                    }
            }

           

        }else{

        $filename4 = session()->get('kelas')."cetakraportuas4".$id;
        $filename5 = session()->get('kelas')."cetakraportuas5".$id;
        $filename6 = session()->get('kelas')."cetakraportuas6".$id;
        $filename7 = session()->get('kelas')."cetakraportuas7".$id;

    $jasper->process(
            base_path() . '/masterreport/uashal4.jasper',
            storage_path($filename4.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();


    $jasper->process(
            base_path() . '/masterreport/uashal5.jasper',
            storage_path($filename5.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "jurusan"=>session()->get('jurusankelas') , "golongankelas"=>session()->get('golongankelas') , "range1"=>$kkm->kkm , "range2"=>$range2 , "range3"=>$range3 , "tempat"=>session()->get('tempat') , "tanggalbagi"=>session()->get('tanggal')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();


      $jasper->process(
            base_path() . '/masterreport/uashal6.jasper',
            storage_path($filename6.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "jurusan"=>session()->get('jurusankelas') , "golongankelas"=>session()->get('golongankelas')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

      $jasper->process(
            base_path() . '/masterreport/uashal7.jasper',
            storage_path($filename7.'/'),
            array("pdf"),
            array("semester"=>session()->get('semester') , "tahunajaran"=>session()->get('tahunajaran') , "id_siswa"=>$id , "id_kelas"=>session()->get('kelas') , "naik"=>$naikkelas->kd_analisis , "kelas"=>$kekelas , "tanggalbagi"=>session()->get('tanggal') , "tempat"=>session()->get('tempat')),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'metana',
                'password' => 'a1s'
                )
            )->execute();

            sleep(10);

            $pdf = new PdfManage;
            
            $pdf->addPDF(storage_path($filename4.'.pdf'), 'all');
            $pdf->addPDF(storage_path($filename5.'.pdf'), 'all');
            $pdf->addPDF(storage_path($filename6.'.pdf'), 'all');
            $pdf->addPDF(storage_path($filename7.'.pdf'), 'all');

            $iwaw = storage_path('app/pdf/uas/cetakraportuasfinal'.$id.session()->get('kelas').".pdf");
            $pdf->merge('file', $iwaw, 'P');

        }

        if (File::exists(storage_path('app/pdf/uas/cetakraportuasfinal'.$id.session()->get('kelas').".pdf")))
                {
                    $file = File::get(storage_path('app/pdf/uas/cetakraportuasfinal'.$id.session()->get('kelas').".pdf"));
                   return Response::make($file, 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="cetakraportuasfinal"'
                     ]);
                }




    }

    public function ajax(Request $request){

        if (session()->get('golongankelas') == "X") {
            session()->set('pilihSemester',$request->pilihSemester);
            session()->set('tempat',$request->tempat);
            session()->set('tanggal',$request->tanggal);
            session()->set('tanggal2',$request->tanggal2);
        }else{
            session()->set('pilihSemester',$request->pilihSemester);
            session()->set('tempat',$request->tempat);
            session()->set('tanggal',$request->tanggal);
        }
        
    }

     
}
