<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadExcelValidator;
use DB;
use View;
use Input;
use Redirect;
use Excel;
use File;

class TidakHadirController extends Controller
{
     public function show(){
    	$content = DB::table('tidakhadir')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->get();

        $datasiswa = DB::table('datasiswa')->select('id','namasiswa','nis','nisn')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

        return View::make('formwali/tidakhadir')->with('content',$content)->with('datasiswa',$datasiswa);
    	
    }

    public function simpan(Request $request){
/*         
        for ($i=1; $i <= Input::get('forloop'); $i++) { 
            if (!Input::has('sakit'.$i))  {
                session()->flash('message','Data SIA ada yang kosong dan harus diisi !');
                session()->flash('error','true');
            }
            if (!Input::has('ijin'.$i)) {
                session()->flash('message','Data SIA ada yang kosong dan harus diisi !');
                session()->flash('error','true');
            }
            if (!Input::has('alpha'.$i)) {
                session()->flash('message','Data SIA ada yang kosong dan harus diisi !');
                session()->flash('error','true');
            }
        }
  */  	
        if (!session()->has('error')) {
           DB::table('tidakhadir')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->delete();

            for ($i=1; $i <= Input::get('forloop') ; $i++) { 
                $data = array(
                    'id_siswa' => Input::get('idsiswa'.$i),
                    'id_kelas' => session()->get('kelas'),
                    'sakit' => Input::get('sakit'.$i) == "" ? 0 : Input::get('sakit'.$i),
                    'ijin' => Input::get('ijin'.$i) == "" ? 0 : Input::get('ijin'.$i),
                    'alpha' => Input::get('alpha'.$i) == "" ? 0 : Input::get('alpha'.$i),
                    'eskul1' => Input::get('eskul1'.$i) == "" ? "-" : Input::get('eskul1'.$i),
                    'eskul2' => Input::get('eskul2'.$i) == "" ? "-" : Input::get('eskul2'.$i),
                    'eskul3' => Input::get('eskul3'.$i) == "" ? "-" : Input::get('eskul3'.$i),
                    'nilaieskul1' => Input::get('nilai1'.$i) == "" ? "-" : Input::get('nilai1'.$i),
                    'nilaieskul2' => Input::get('nilai2'.$i) == "" ? "-" : Input::get('nilai2'.$i),
                    'nilaieskul3' => Input::get('nilai3'.$i) == "" ? "-" : Input::get('nilai3'.$i),
                    'keteranganeskul1' => Input::get('keterangan1'.$i) == "" ? "-" : Input::get('keterangan1'.$i),
                    'keteranganeskul2' => Input::get('keterangan2'.$i) == "" ? "-" : Input::get('keterangan2'.$i),
                    'keteranganeskul3' => Input::get('keterangan3'.$i) == "" ? "-" : Input::get('keterangan3'.$i),
                    'prestasi1' => Input::get('prestasi1'.$i) == "" ? "-" : Input::get('prestasi1'.$i),
                    'prestasi2' => Input::get('prestasi2'.$i) == "" ? "-" : Input::get('prestasi2'.$i),
                    'prestasi3' => Input::get('prestasi3'.$i) == "" ? "-" : Input::get('prestasi3'.$i),
                    'keteranganprestasi1' => Input::get('keteranganpres1'.$i) == "" ? "-" : Input::get('keteranganpres1'.$i),
                    'keteranganprestasi2' => Input::get('keteranganpres2'.$i) == "" ? "-" : Input::get('keteranganpres2'.$i),
                    'keteranganprestasi3' => Input::get('keteranganpres3'.$i) == "" ? "-" : Input::get('keteranganpres3'.$i),
                    'catatan' => Input::get('catatan'.$i) == "" ? "-" : Input::get('catatan'.$i),
                    'tahunajaran' => session()->get('tahunajaran'),
                    'semester' => session()->get('semester')
                    );
                DB::table('tidakhadir')->insert($data);
                }
                session()->flash('message','Data daftar hadir & eksul telah di simpan');
                return Redirect::to('identitas/daftarhadir&eksul');
         }else{
            
            return Redirect::back()->withInput();
         }
    	
    	
    }

    public function unduhLayout(){
        $dataSiswa = DB::table('datasiswa')->select('nis','namasiswa')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

        $dir = storage_path('app/uploadexcel').session()->get('charkelas');
        Excel::load(storage_path('app/uploadexcel/Identitas Sis.xlsx'), function($reader) use($dataSiswa,$dir){
            $reader->sheet(0, function($sheet) use($dataSiswa){
                $cellIndex = 2;
                foreach ($dataSiswa as $value) {
                    $cellIndex++;
                    $sheet->cell('A'.$cellIndex, function($cell) use($cellIndex){
                        $cell->setValue($cellIndex-2);
                    });
                    $sheet->cell('B'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->nis);
                    });
                    $sheet->cell('C'.$cellIndex, function($cell) use($value){
                        $cell->setValue($value->namasiswa);
                    });
                }
            });
        })->store('xlsx',$dir);

        $excelSatu = Excel::load($dir.'/Identitas Sis.xlsx');
        File::deleteDirectory($dir);

        Excel::load(storage_path('app/uploadexcel/layoutUploadDataRapot.xlsx'), function($reader) use($excelSatu){
            $reader->removeSheetByIndex(1);
            foreach ($excelSatu->getAllSheets() as $sheet) {
                $reader->addExternalSheet($sheet);
            }
        })->export('xlsx');
    }

    public function uploadExcel(Request $request, UploadExcelValidator $validator){
        $file = Input::file('file');
        $request->file('file');
        $filename = "dataRapot".session()->get('kelas').$file->getClientOriginalName();
        $request->file->storeAs('uploadexcel',$filename);
        $fileLocation = storage_path('app/uploadexcel/'.$filename);
        //================================ CHECKING FILE IS THAT IN CORRECT FORMAT ==============================
        config(['excel.import.startRow' => 1 ]);
        $checkFile = Excel::selectSheets('dataRaport')->load(storage_path('app/uploadexcel/'.$filename), function($reader){})->get()->toArray();
        //dd($checkFile);
        $status = false;
        foreach ($checkFile as $value) {
            if (isset($value['signaturedatarapot'])) {
                $status = true;
                break;
            }
        }
        //================================ CHECKING FILE IS THAT IN CORRECT FORMAT ==============================

        if ($status == true) {
            config(['excel.import.startRow' => 2 ]);

            DB::table('tidakhadir')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->delete();

            Excel::filter('chunk')->selectSheets('dataRaport','Identitas Sis')->load(storage_path('app/uploadexcel/'.$filename))->chunk(250, function($reader){
                $cycle = true;
                foreach ($reader as $key) {
                    if ($cycle == false) {
                        break;
                    }
                    foreach ($key as $value) {
                        if ($value->nis == "stop") {
                            $cycle = false;
                            break;
                        }elseif ($value->nis != "" or $value->nis != 0) {
                            if ($value->nis != "NIS") {
                                $idSiswa = DB::table('datasiswa')->select('id')->where('nis','=',$value->nis)->first();

                                $data = array(
                                    'id_siswa' => $idSiswa->id,
                                    'id_kelas' => session()->get('kelas'),
                                    'sakit' => $value->sakit == "" ? 0 : $value->sakit,
                                    'ijin'=> $value->ijin == "" ? 0 : $value->ijin,
                                    'alpha' => $value->alpha == "" ? 0 : $value->alpha,
                                    'eskul1' => $value->ekskul1 == "" ? "-" : $value->ekskul1,
                                    'eskul2' => $value->ekskul2 == "" ? "-" : $value->ekskul2,
                                    'eskul3' => $value->ekskul3 == "" ? "-" : $value->ekskul3,
                                    'nilaieskul1' => $value->nilai1 == "" ? "-" : $value->nilai1,
                                    'nilaieskul2' => $value->nilai2 == "" ? "-" : $value->nilai2,
                                    'nilaieskul3' => $value->nilai3 == "" ? "-" : $value->nilai3,
                                    'keteranganeskul1' => $value->keterangan1 == "" ? "-" : $value->keterangan1,
                                    'keteranganeskul2' => $value->keterangan2 == "" ? "-" : $value->keterangan2,
                                    'keteranganeskul3' => $value->keterangan3 == "" ? "-" : $value->keterangan3,
                                    'prestasi1' => $value->prestasi1 == "" ? "-" : $value->prestasi1,
                                    'prestasi2' => $value->prestasi2 == "" ? "-" : $value->prestasi2,
                                    'prestasi3' => $value->prestasi3 == "" ? "-" : $value->prestasi3,
                                    'keteranganprestasi1' => $value->keteranganPres1 == "" ? "-" : $value->keteranganPres1,
                                    'keteranganprestasi2' => $value->keteranganPres2 == "" ? "-" : $value->keteranganPres2,
                                    'keteranganprestasi3' => $value->keteranganPres3 == "" ? "-" : $value->keteranganPres3,
                                    'catatan' => $value->catatanwali == "" ? "-" : $value->catatanwali,
                                    'tahunajaran' => session()->get('tahunajaran'),
                                    'semester' => session()->get('semester')
                                    );

                                DB::table('tidakhadir')->insert($data);
                            }                     
                        }
                        
                    }
                }

            });
            File::delete($fileLocation);
            return Redirect::back()->with(session()->flash('message','Proses impor daftar hadir & ekskul telah berhasil !'));
        }else{
            return Redirect::back()->with(session()->flash('error','Pilih layout excel yang benar'));
        }

        

    }
}
