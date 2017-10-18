<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KelasValidator;
use App\Http\Requests\Kelas2Validator;
use App\Http\Requests\UploadExcelValidator;
use Illuminate\Support\Facades\Storage;
use App\AspekPengetahuan;
use Input;
use DB;
use Redirect;
use View;
use Session;
use Auth;
use Excel;
use File;
error_reporting(0);
class AspekPengetahuanController extends Controller
{
    public function dataaspekpengetahuan(){
        $datasiswa = DB::table('datasiswa')->select('namasiswa','id','nis')->where('id_kelas','=',Session()->get('kelas'))->orderBy('nis','asc')->get();

        $pengetahuan = DB::table('nilai')->select('id_siswa','nilai','predikat','id')->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('id_guru','=',Session::get('id_guru'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',1)->get();

        $detail = DB::table('nilai')->join('detailnilai', function($join){
            $join->on('nilai.id','=','detailnilai.id_nilai')->where('nilai.id_kelas','=',Session()->get('kelas'))->where('nilai.id_pelajaran','=',Session()->get('pelajaran'))->where('nilai.id_guru','=',Session::get('id_guru'))->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'))->where('nilai.kd_aspek','=',1);
        })->select('detailnilai.kd','detailnilai.id_nilai')->get();


        $data_kd = DB::table('kd')->select('kd')->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('id_guru','=',Session::get('id_guru'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',1)->get();

        $data_kkm = DB::table('datadasarnilai')->select('kkm','ckmpengetahuan')->where('id_pelajaran','=',session()->get('pelajaran'))->where('jurusan','=',session()->get('jurusankelas'))->where('gol_kelas','=',session()->get('golongankelas'))->first();


        if (session()->has('reload')) {
            session()->forget('message');
            session()->forget('failed');
        }

      
            return View::make('formguru/aspekpengetahuan')->with('datasiswa',$datasiswa)->with('pengetahuan',$pengetahuan)->with('kontenkd',$data_kd)->with('detail',$detail)->with('infonilai',$data_kkm)->with(session()->forget('status_pengetahuan'));
        
    }

    public function simpanaspekpengetahuan(){
        DB::table('nilai')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',1)->delete();

        for ($i=1; $i <= Input::get('saverow') ; $i++) { 
            if (Input::get('rerata'.$i) != "") {
                $rerata[$i] = Input::get('rerata'.$i);
                $predikat[$i] = Input::get('predikat'.$i);
                $deskripsi[$i] = Input::get('deskripsi'.$i);
                $tortt[$i] = Input::get('tt'.$i);
            }
            elseif (Input::get('rerata'.$i) == "") {
                $rerata[$i] = 0;
                $predikat[$i] = " ";
                $deskripsi[$i] = " ";
                $tortt[$i] = " ";
            }
        }     
        for ($i=1; $i <= Input::get('saverow') ; $i++) {               
                $data = array(
                    'id_guru' => Session::get('id_guru'),
                    'id_kelas' => session()->get('kelas'),
                    'id_pelajaran' => session()->get('pelajaran'),
                    'id_siswa' => Input::get('idsiswa'.$i),
                    'kd_aspek' => 1,          
                    'nilai' => $rerata[$i],
                    'predikat' => $predikat[$i],
                    'deskripsi' => $deskripsi[$i],
                    'ttt' => $tortt[$i],
                    'semester'=> session()->get('semester'),
                    'tahunajaran' => session()->get('tahunajaran')
                    );
            DB::table('nilai')->insert($data);

            $idnilai = DB::table('nilai')->select('id')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_siswa','=',Input::get('idsiswa'.$i))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',1)->first();

            for ($s=1; $s <= Input::get('savecol') ; $s++) { 
                $data2 = array(
                    'id_nilai' => $idnilai->id,
                    'kd' => Input::get('kd'.$s.'-'.$i)
                    );

                DB::table('detailnilai')->insert($data2);
            }
      
            
        }
        return Redirect::to('kompentensi/aspekpengetahuan')->with(session()->flash('message', 'Data nilai aspek pengetahuan berhasil diupdate !' ));
    }

    public function upload(Request $request, UploadExcelValidator $validator){
        $file = Input::file('file');
        $request->file('file');
        $filename = "pengetahuan".session()->get('kelas').session()->get('pelajaran').$file->getClientOriginalName();

        $request->file->storeAs('uploadexcel',$filename);

        //===================================CHECK IF THE EXCEL FILE IS CORRECT===============================================
        $excelChecker = Excel::selectSheets('PENGETAHUAN')->load(storage_path('app/uploadexcel/'.$filename), function($reader){

        })->get()->toArray();
        $status = false;
        foreach ($excelChecker as $key) {
            if (isset($key['nis']) && isset($key['kd1']) && isset($key['kd2']) && isset($key['kd3']) && isset($key['kd4']) && isset($key['kd5']) && isset($key['kd6']) && isset($key['kd7']) && isset($key['kd8']) && isset($key['kd9']) && isset($key['kd10']) && isset($key['kd11']) && isset($key['kd12']) && isset($key['kd13']) && isset($key['kd14']) ) {
                $status = true;
            }
        }      
         //===================================CHECK IF THE EXCEL FILE IS CORRECT===============================================

        if ($status == true) {
            
        
        Excel::filter('chunk')->selectSheets('Identitas KD','PENGETAHUAN','Identitas Sis')->load(storage_path('app/uploadexcel/'.$filename))->chunk(250 , function($reader) {

        $toggle = 0;
        $nomor = 0;

        DB::table('kd')->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_guru','=',Session::get('id_guru'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',1)->delete();

        foreach ($reader as $key) {
            foreach ($key as $man) {
                if ($man->mm == "DESKRIPSI SINGKAT KOMPETENSI DASAR") {
                    $toggle++;
                }

                if ($toggle < 2 ) {
                    if ($man->mm != "DESKRIPSI SINGKAT KOMPETENSI DASAR" && $man->mm != "") {
                        $nomor++;
                        $charkd = "KD ".$nomor;
                        $data = array(
                            'nomor_kd' => $charkd,
                            'id_kelas' => session()->get('kelas'),
                            'id_pelajaran' => session()->get('pelajaran'),
                            'id_guru' => Session::get('id_guru'),
                            'kd' => $man->mm,
                            'kd_kd' => 1,
                            'semester' => session()->get('semester'),
                            'tahunajaran' => session()->get('tahunajaran')  
                            );
                        DB::table('kd')->insert($data);
                    }
                }
            }
        }

         DB::table('nilai')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',1)->delete();

        $toggle = 0;
        $toggle2 = 0;
        foreach ($reader as $key) {
            foreach ($key as $man) {
                if ($man->nis != "") {
                    if ($man->kd1 == "stop") {
                        $toggle = 1;
                    }
                    if ($toggle == 0){
                        $toggle2++;
                        if ($toggle2 > 2) {
                            $id_siswa = DB::table('datasiswa')->select('id')->where('nis','=',$man->nis)->first();

                                                                                                         
                            $data = array(
                                'id_kelas' => session()->get('kelas'),
                                'id_pelajaran' => session()->get('pelajaran'),
                                'id_guru' => Session::get('id_guru'),
                                'id_siswa' => $id_siswa->id,
                                'kd_aspek' => 1,
                                'nilai' => 0,
                                'semester'=> session()->get('semester'),
                                'tahunajaran' => session()->get('tahunajaran')        
                                );
                            DB::table('nilai')->insert($data);

                             $idnilai = DB::table('nilai')->select('id')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_siswa','=',$id_siswa->id)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',1)->first();

                            for ($s=1; $s <= $nomor ; $s++) {
                                $name = "kd".$s;
                                $data2 = array(
                                    'id_nilai' => $idnilai->id,
                                    'kd' => $man->$name
                                );

                                DB::table('detailnilai')->insert($data2);
                            }


                        }
                        
                    }

                    
                }
                
            }
        }

        

 });
return Redirect::back()->with(session()->flash('reload','reload'));
}else{
    return Redirect::back()->with(session()->flash('message','File excel yang diimpor salah !'))->with(session()->flash('failed','failed'));
}

    
    }


    public function unduhLayoutNilai(){
        $datasiswa = DB::table('datasiswa')->select('namasiswa','id','nis')->where('id_kelas','=',Session()->get('kelas'))->orderBy('nis','asc')->get();
        $datakdspiritual = DB::table('kd')->select('nomor_kd','kd')->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('kd_kd','=',3)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->get();
        $datakdsosial = DB::table('kd')->select('nomor_kd','kd')->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('kd_kd','=',4)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->get();

        ini_set('memory_limit', '-1');
        $dir = storage_path('app/uploadexcel/').session()->get('charkelas').session()->get('charpelajaran');
        Excel::load(storage_path('app/uploadexcel/Identitas Sis.xlsx'), function($reader) use($datasiswa, $dir){

            $reader->sheet(0, function($sheet) use($datasiswa){
                $cellIndex = 2;
                foreach ($datasiswa as $value) {
                    $cellIndex++;
                    $sheet->cell('C'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->namasiswa);
                    });
                    $sheet->cell('B'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->nis);
                    });
                    $sheet->cell('A'.$cellIndex, function($cell) use($value,$cellIndex){
                        $cell->setValue($cellIndex-2);
                    });
                }
            });
            
        })->store('xlsx',$dir);


        $dir2 = storage_path('app/uploadexcel/').session()->get('charkelas').session()->get('charpelajaran')."datakkd";
        Excel::load(storage_path('app/uploadexcel/Identitas KD.xlsx'), function($reader) use($dir2, $datakdspiritual, $datakdsosial){
            $reader->sheet(0, function($sheet) use($datakdspiritual, $datakdsosial){
                $cellIndex = 42;
                foreach ($datakdspiritual as $key => $value) {
                    $cellIndex++;
                    $sheet->cell('C'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->nomor_kd);
                    });
                    $sheet->cell('D'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->kd);
                    });
                }
                $cellIndex = 52;
                foreach ($datakdsosial as $key => $value) {
                    $cellIndex++;
                    $sheet->cell('C'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->nomor_kd);
                    });
                    $sheet->cell('D'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->kd);
                    });
                }
            });
        })->store('xlsx',$dir2);

        $excelSatu = Excel::load($dir.'/Identitas Sis.xlsx');
        $excelDua = Excel::load($dir2.'/Identitas KD.xlsx');

        File::deleteDirectory($dir);
        File::deleteDirectory($dir2);

       Excel::load(storage_path('app/uploadexcel/LayoutUploadNilai.xlsx'), function($reader) use($excelSatu, $excelDua){
       
        $contentHeader = array(session()->get('charkelas'),session()->get('charpelajaran'), session()->get('semester'), session()->get('tahunajaran'));
        $contentCell1 = array('D4','D5','P4','P5');
        $contentCell2 = array('C4','C5','K4','K5');

        for ($i=1; $i <=4 ; $i++) { 
            $arrayIndex = -1;
            if ($i <= 2) {
                foreach ($contentCell1 as $value) {
                    $arrayIndex++;
                    $reader->sheet($i, function($sheet) use($value,$arrayIndex,$contentHeader){
                        $sheet->cell($value, function($cell) use($arrayIndex,$contentHeader){
                            $cell->setValue($contentHeader[$arrayIndex]);
                        });
                    });

                }
            }else{
                 foreach ($contentCell2 as $value) {
                    $arrayIndex++;
                    $reader->sheet($i, function($sheet) use($value,$arrayIndex,$contentHeader){
                        $sheet->cell($value, function($cell) use($arrayIndex,$contentHeader){
                            $cell->setValue($contentHeader[$arrayIndex]);
                        });
                    });

                }
            }
        }

        $reader->removeSheetByIndex(5);
        foreach ($excelSatu->getAllSheets() as $sheet) {
            $reader->addExternalSheet($sheet);
        }

        $reader->removeSheetByIndex(0);
        foreach ($excelDua->getAllSheets() as $sheet) {
           $reader->addExternalSheet($sheet);
        }


        })->export('xlsx');
       
    }
}
