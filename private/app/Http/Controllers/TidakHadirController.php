<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Input;
use Redirect;

class TidakHadirController extends Controller
{
     public function show(){
    	$content = DB::table('tidakhadir')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->get();

        $datasiswa = DB::table('datasiswa')->select('id','namasiswa','nis','nisn')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

        return View::make('formwali/tidakhadir')->with('content',$content)->with('datasiswa',$datasiswa);
    	
    }

    public function simpan(Request $request){
    	$container = array('sakit','ijin','alpha','eskul1','eskul2','eskul3','nilai1','nilai2','nilai3','keterangan1','keterangan2','keterangan3','prestasi1','prestasi2','prestasi3','keteranganpres1','keteranganpres2','keteranganpres3','catatan');

        
    	for ($s=1; $s <= Input::get('forloop') ; $s++) { 
    		for ($i=0; $i <=18  ; $i++) { 
    			if (Input::get($container[$i].$s) == "") {
    				$value[$s][$i] = " ";
    			}elseif(Input::get($container[$i].$s) != ""){
    				$value[$s][$i] = Input::get($container[$i].$s);
    			}
    	}
    	}

      
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
    	
        if (!session()->has('error')) {
           DB::table('tidakhadir')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->delete();

            for ($i=1; $i <= Input::get('forloop') ; $i++) { 
                $data = array(
                    'id_siswa' => Input::get('idsiswa'.$i),
                    'id_kelas' => session()->get('kelas'),
                    'sakit' => $value[$i][0],
                    'ijin' => $value[$i][1],
                    'alpha' => $value[$i][2],
                    'eskul1' => $value[$i][3],
                    'eskul2' => $value[$i][4],
                    'eskul3' => $value[$i][5],
                    'nilaieskul1' => $value[$i][6],
                    'nilaieskul2' => $value[$i][7],
                    'nilaieskul3' => $value[$i][8],
                    'keteranganeskul1' => $value[$i][9],
                    'keteranganeskul2' => $value[$i][10],
                    'keteranganeskul3' => $value[$i][11],
                    'prestasi1' => $value[$i][12],
                    'prestasi2' => $value[$i][13],
                    'prestasi3' => $value[$i][14],
                    'keteranganprestasi1' => $value[$i][15],
                    'keteranganprestasi2' => $value[$i][16],
                    'keteranganprestasi3' => $value[$i][17],
                    'catatan' => $value[$i][18],
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
}
