<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KelasValidator;
use App\Http\Requests\Kelas2Validator;
use App\Http\Requests\UploadExcelValidator;
use App\AspekKeterampilan;
use Input;
use DB;
use Redirect;
use View;
use Session;
use Auth;
use Excel;

error_reporting(0);

class AspekKeterampilanController extends Controller
{
     public function dataaspekketerampilann(){

        $datasiswa = DB::table('datasiswa')->select('namasiswa','id','nis')->where('id_kelas','=',Session()->get('kelas'))->orderBy('nis','asc')->get();

    	$keterampilan = DB::table('nilai')->join('detailnilai', function($join){
            $join->on('nilai.id','=','detailnilai.id_nilai')->where('nilai.id_kelas','=',Session()->get('kelas'))->where('nilai.id_pelajaran','=',Session()->get('pelajaran'))->where('nilai.id_guru','=',Session::get('id_guru'))->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'))->where('nilai.kd_aspek','=',2);
        })->select('nilai.id_siswa','nilai.nilai','nilai.predikat','nilai.id')->distinct()->get();

        $detail = DB::table('nilai')->join('detailnilai', function($join){
            $join->on('nilai.id','=','detailnilai.id_nilai')->where('nilai.id_kelas','=',Session()->get('kelas'))->where('nilai.id_pelajaran','=',Session()->get('pelajaran'))->where('nilai.id_guru','=',Session::get('id_guru'))->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'))->where('nilai.kd_aspek','=',2);
        })->select('detailnilai.kd','detailnilai.id_nilai')->get();

    	$data_kd = DB::table('kd')->select('kd')->where('id_kelas','=',Session()->get('kelas'))->where('id_pelajaran','=',Session()->get('pelajaran'))->where('id_guru','=',Session::get('id_guru'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',2)->get();

    	$data_kkm = DB::table('datadasarnilai')->select('kkm','ckmketerampilan')->where('id_pelajaran','=',session()->get('pelajaran'))->where('jurusan','=',session()->get('jurusankelas'))->where('gol_kelas','=',session()->get('golongankelas'))->first();

         if (session()->has('reload')) {
            session()->forget('message');
            session()->forget('failed');
        }

 		
    	return View::make('formguru/aspekketerampilan')->with('datasiswa',$datasiswa)->with('detail',$detail)->with('keterampilan',$keterampilan)->with('kontenkd',$data_kd)->with('infonilai',$data_kkm);
    
    }

    public function simpanaspekketerampilan(){
        DB::table('nilai')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',2)->delete();

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
                    'kd_aspek' => 2,          
                    'nilai' => $rerata[$i],
                    'predikat' => $predikat[$i],
                    'deskripsi' => $deskripsi[$i],
                    'ttt' => $tortt[$i],
                    'semester'=> session()->get('semester'),
                    'tahunajaran' => session()->get('tahunajaran')
                    );
            DB::table('nilai')->insert($data);

            $idnilai = DB::table('nilai')->select('id')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_siswa','=',Input::get('idsiswa'.$i))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',2)->first();

            for ($s=1; $s <= Input::get('savecol') ; $s++) { 
                $data2 = array(
                    'id_nilai' => $idnilai->id,
                    'kd' => Input::get('kd'.$s.'-'.$i)
                    );

                DB::table('detailnilai')->insert($data2);
            }
      
            
        }
        return Redirect::to('kompentensi/aspekketerampilan')->with(session()->flash('message', 'Data nilai aspek pengetahuan berhasil diupdate !' ));
    }

    public function upload(Request $request, UploadExcelValidator $validator){
        $file = Input::file('file');
        $request->file('file');
        $filename = "keterampilan".session()->get('kelas').session()->get('pelajaran').$file->getClientOriginalName();

        $request->file->storeAs('uploadexcel',$filename);

        //===================================CHECK IF THE EXCEL FILE IS CORRECT===============================================
        $excelChecker = Excel::selectSheets('KETERAMPILAN')->load(storage_path('app/uploadexcel/'.$filename), function($reader){

        })->get()->toArray();
        $status = false;
        foreach ($excelChecker as $key) {
            if (isset($key['nis']) && isset($key['kd1']) && isset($key['kd2']) && isset($key['kd3']) && isset($key['kd4']) && isset($key['kd5']) && isset($key['kd6']) && isset($key['kd7']) && isset($key['kd8']) && isset($key['kd9']) && isset($key['kd10']) && isset($key['kd11']) && isset($key['kd12']) && isset($key['kd13']) && isset($key['kd14']) ) {
                $status = true;
            }
        }      
         //===================================CHECK IF THE EXCEL FILE IS CORRECT===============================================

        if ($status == true) {
           
        
        Excel::filter('chunk')->selectSheets('Identitas KD','KETERAMPILAN','Identitas Sis')->load(storage_path('app/uploadexcel/'.$filename))->chunk(250 , function($reader) {

        $toggle = 0;
        $nomor = 0;

        DB::table('kd')->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_guru','=',Session::get('id_guru'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_kd','=',2)->delete();

        foreach ($reader as $key) {
            foreach ($key as $man) {
                if ($man->mm == "DESKRIPSI SINGKAT KOMPETENSI DASAR") {
                    $toggle++;
                }

                if ($toggle == 2 ) {
                    if ($man->mm != "DESKRIPSI SINGKAT KOMPETENSI DASAR" && $man->mm != "") {
                        $nomor++;
                        $charkd = "KD ".$nomor;
                        $data = array(
                            'nomor_kd' => $charkd,
                            'id_kelas' => session()->get('kelas'),
                            'id_pelajaran' => session()->get('pelajaran'),
                            'kd_kd' => 2,
                            'id_guru' => Session::get('id_guru'),
                            'kd' => $man->mm,
                            'semester' => session()->get('semester'),
                            'tahunajaran' => session()->get('tahunajaran')
                            );
                        DB::table('kd')->insert($data);
                    }
                }
            }
        }
        

         DB::table('nilai')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',2)->delete();

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
                                'kd_aspek' => 2,
                                'nilai' => 0,
                                'semester'=> session()->get('semester'),
                                'tahunajaran' => session()->get('tahunajaran')        
                                );
                            DB::table('nilai')->insert($data);

                             $idnilai = DB::table('nilai')->select('id')->where('id_guru','=',Session::get('id_guru'))->where('id_kelas','=',session()->get('kelas'))->where('id_pelajaran','=',session()->get('pelajaran'))->where('id_siswa','=',$id_siswa->id)->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->where('kd_aspek','=',2)->first();

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
}
