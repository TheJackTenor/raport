<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\KelompokPelajaran;
use App\AspekKeterampilan;
use App\AspekPengetahuan;
use App\AspekSikapSpiritual;
use App\AspekSikapSosial;
use DB;
use Input;
use JasperPHP\JasperPHP as JasperPHP;
use File;
use Response;
use Redirect;
use Storage;



class CetakLegerController extends Controller
{
    public function show(){

        $daftarsiswa = DB::table('datasiswa')->select('id','namasiswa','nis','nisn')->where('id_kelas','=',session()->get('kelas'))->orderBy('nis','asc')->get();

        $daftarpelajaran = KelompokPelajaran::where('jenjang','=',session()->get('golongankelas'))->where('jurusan','=',session()->get('jurusankelas'))->where('kelompok','<>',5)->get();

        $nilai = DB::table('nilai')->join('datasiswa', function($join) {
            $join->on('nilai.id_siswa','=','datasiswa.id')->where('nilai.id_kelas','=',session()->get('kelas'))->where('nilai.semester','=',session()->get('semester'))->where('nilai.tahunajaran','=',session()->get('tahunajaran'));
            })->join('kelompokpelajaran', function($join2) {
            $join2->on('nilai.id_pelajaran','=','kelompokpelajaran.id_pelajaran')->where('kelompokpelajaran.jurusan','=',session()->get('jurusankelas'))->where('kelompokpelajaran.jenjang','=',session()->get('golongankelas'));
            })->select('datasiswa.nis','nilai.kd_aspek','nilai.nilai','nilai.id_siswa','nilai.id_pelajaran')->orderBy('datasiswa.nis','asc')->orderBy('kelompokpelajaran.kelompok','asc')->orderBy('nilai.id_pelajaran','asc')->get();
        
        $sia = DB::table('tidakhadir')->select('sakit','ijin','alpha','id_siswa')->where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->get();


        return View::make('formwali/cetakleger')->with('daftarpelajarans',$daftarpelajaran)->with('nilai',$nilai)->with('sia',$sia)->with('daftarsiswas',$daftarsiswa);
    }

    public function cetak(){

        if (Input::get('emptysakit') == 1) {
            session()->flash('emptysakit','Data SIA');
        }
        if (Input::get('emptypengetahuan') == 1) {
            session()->flash('emptypengetahuan','Pengetahuan');
            session()->flash('emptynilai','true');
        }
        if (Input::get('emptyketerampilan') == 1) {
            session()->flash('emptyketerampilan','Keterampilan');
            session()->flash('emptynilai','true');
        }
        if (Input::get('emptysosial') == 1) {
            session()->flash('emptysosial','Sosial');
            session()->flash('emptynilai','true');
        }
         if (Input::get('emptyspiritual') == 1) {
            session()->flash('emptyspiritual','Spiritual');
            session()->flash('emptynilai','true');
        }


        if (session()->has('emptysakit') || session()->has('emptynilai')) {
            
            return Redirect::to('/hasil/cetakleger');

         }else{

            DB::table('cetakleger')->where('id_kelas','=',session()->get('kelas'))->delete();

        $temp = "";
       
        for ($i=1; $i <=Input::get('saverow') ; $i++) { 

            for($s=1; $s <= Input::get('savecell') ; $s++){             
                $save[$i][$s] = Input::get('cell'.$i.$s);   
            }

            for($m = $s ; $m <=22 ; $m++){
                $save[$i][$m] = 0;
            }
          
            if (Input::get('ids'.$i) != $temp) {
                $idr[$i] = Input::get('ids'.$i);
                $temp = Input::get('ids'.$i);
            }elseif(Input::get('ids'.$i) == $temp){
                $idr[$i] = $temp;
            }
                
        
                
            
        }

        for ($i=1; $i <=Input::get('saverow') ; $i++) {

            $data = array(             
            'id_kelas' => session()->get('kelas'),
            'id_siswa' => $idr[$i],      
            'aspek' => Input::get('atr'.$i.'3'),
            'n1' => $save[$i][1],
            'n2' => $save[$i][2],
            'n3' => $save[$i][3],
            'n4' => $save[$i][4],
            'n5' => $save[$i][5],
            'n6' => $save[$i][6],
            'n7' => $save[$i][7],
            'n8' => $save[$i][8],
            'n9' => $save[$i][9],
            'n10' => $save[$i][10],
            'n11' => $save[$i][11],
            'n12' => $save[$i][12],
            'n13' => $save[$i][13],
            'n14' => $save[$i][14],
            'n15' => $save[$i][15],
            'n16' => $save[$i][16],
            'n17' => $save[$i][17],
            'n18' => $save[$i][18],
            'n19' => $save[$i][19],
            'n20' => $save[$i][20],
            'n21' => $save[$i][21],
            'n22' => $save[$i][22],
            'jumlah' => Input::get('jumlah'.$i),
            'rerata' => Input::get('rerata'.$i),
            );

            DB::table('cetakleger')->insert($data);
        }

        $jasper = new JasperPHP;

        $kelas = str_replace(" ", "", session()->get('charkelas'));

        $filename = "cetakleger_".$kelas;

        Storage::delete('/pdf/leger/'.$filename.'.pdf');
             

     $jasper->process(
            base_path() . '/masterreport/leger.jasper',
            storage_path('app/pdf/leger/'.$filename.'/'),
            array("pdf"),
            array("jurusan" => session()->get('jurusankelas'), "jenjang" => session()->get('golongankelas'), "kelas" => session()->get('kelas'),"semester" => session()->get('semester'),"tahun" => session()->get('tahunajaran')),
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
                if (File::exists(storage_path('app/pdf/leger/'.$filename.'.pdf')))
                {
                    sleep(3);
                    $file = File::get(storage_path('app/pdf/leger/'.$filename.'.pdf'));
                     return Response::make($file, 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="'.$filename.'"'
                     ]);

                    
                }else{
                        $c++;
                    }
            }

            

         }
    }

    public function showreport($id){
        $file = File::get(storage_path($id.'.pdf'));

    return Response::make($file, 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="'.$id.'"'
        ]);
    }

    public function nyobo(){
        $sosial = AspekSikapSosial::where('id_kelas','=',session()->get('kelas'))->where('semester','=',session()->get('semester'))->where('tahunajaran','=',session()->get('tahunajaran'))->orderBy('nis','asc')->orderBy('kelompok','asc')->orderBy('id_pelajaran','asc')->get();

        echo "$sosial";

    }
}
