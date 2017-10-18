<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Input;
use Excel;
class RerataController extends Controller
{
    public function hitungRerata(){
        $dataSiswa = DB::table('datasiswa')->join('datakelas', function($join){
            $join->on('datasiswa.id_kelas','datakelas.id')->where('datasiswa.tahunmasuk','=',Input::get('angkatan'));
        })->select('datasiswa.id','datasiswa.nis','datasiswa.nisn','datasiswa.namasiswa','datakelas.golongankelas','datakelas.jurusankelas')->get();

        $daftarPelajaran = DB::table('kelompokpelajaran')->join('datapelajaran',function($join){
            $join->on('kelompokpelajaran.id_pelajaran','=','datapelajaran.id')->where('datapelajaran.id','!=',34);
        })->orderBy('kelompokpelajaran.jurusan','asc')->orderBy('kelompokpelajaran.jenjang','asc')->orderBy('kelompokpelajaran.kelompok','asc')->orderBy('kelompokpelajaran.id_pelajaran','asc')->get();

        $semesterChoosen = Input::get('semester');
        $divider = count($semesterChoosen);
        $siswaCount = 0;

         foreach ($dataSiswa as $siswa) {
            $siswaCount++;
            $urutNilai = 0;
            $urutPelajaran = 0;

            $namasiswa[$siswaCount] = $siswa->namasiswa;
            $nis[$siswaCount] = $siswa->nis;
            $nisn[$siswaCount] = $siswa->nisn;
            $jurusan[$siswaCount] = $siswa->jurusankelas;

            $dataPelajaran = DB::table('kelompokpelajaran')->select('id_pelajaran')->where('jenjang','=',$siswa->golongankelas)->where('jurusan','=',$siswa->jurusankelas)->where('kelompok','<>',5)->orderBy('kelompok','asc')->orderBy('id_pelajaran','asc')->get();

            foreach ($dataPelajaran as $pelajaran) {
                $urutPelajaran++;
                $rerataNilai[$siswaCount][$urutPelajaran] = 0;
                for ($i=1; $i <= 3; $i++) { 
                    $tahunBesar = Input::get('angkatan') + $i;
                    $tahunKecil = $tahunBesar - 1;
                    $tahunAjaran[$i] = $tahunKecil."/".$tahunBesar;

                    $getSemester = DB::table('nilai')->where('tahunajaran','=',$tahunAjaran[$i])->where('id_siswa','=',$siswa->id)->where('id_pelajaran','=',$pelajaran->id_pelajaran)->where('kd_aspek','=',1)->get();

                    if ($getSemester == '[]') {
                       $numberSemester = $i - 1;
                        $semesterTemp[0] = $i + $numberSemester;
                        $semesterTemp[1] = $i+$i;
                        foreach ($semesterTemp as $smstrTemp) {
                            foreach ($semesterChoosen as $smstrChoosen) {
                                if ($smstrTemp == $smstrChoosen) {
                                    $urutNilai++;
                                    $nilaiSiswa[$siswaCount][$urutNilai] = 0;
                                    if (empty($rerataNilaiFinal[$siswaCount][$urutPelajaran])) {
                                            $rerataNilaiFinal[$siswaCount][$urutPelajaran] = 0;
                                    }
                                }
                            }
                        }
                    }else{
                        $codeSigner = 0;
                        foreach ($getSemester as $key => $value) {
                            $codeSigner++;
                            if ($value->semester == "1/Ganjil") {
                                $semesterMemory = $value->semester;
                                $numberSemester = $i - 1;
                                $pelengkap = $i + $numberSemester;
                                foreach ($semesterChoosen as $semester) {
                                    if ($pelengkap == $semester) {
                                        $urutNilai++;
                                        $nilaiSiswa[$siswaCount][$urutNilai] = $value->nilai;
                                        $rerataNilai[$siswaCount][$urutPelajaran] = $rerataNilai[$siswaCount][$urutPelajaran] + $value->nilai;
                                        $rerataNilaiFinal[$siswaCount][$urutPelajaran] = $rerataNilai[$siswaCount][$urutPelajaran] / $divider;
                                        $rerataNilaiFinal[$siswaCount][$urutPelajaran] = round($rerataNilaiFinal[$siswaCount][$urutPelajaran],0,PHP_ROUND_HALF_UP);
                                    }
                                }                          
                            }elseif ($value->semester == "2/Genap") {
                                $semesterMemory = $value->semester;
                                $pelengkap = $i+$i;
                                foreach ($semesterChoosen as $semester) {
                                    if ($pelengkap == $semester) {
                                        $urutNilai++;
                                        $nilaiSiswa[$siswaCount][$urutNilai] = $value->nilai;
                                        $rerataNilai[$siswaCount][$urutPelajaran] = $rerataNilai[$siswaCount][$urutPelajaran] + $value->nilai;
                                        $rerataNilaiFinal[$siswaCount][$urutPelajaran] = $rerataNilai[$siswaCount][$urutPelajaran] / $divider;
                                        $rerataNilaiFinal[$siswaCount][$urutPelajaran] = round($rerataNilaiFinal[$siswaCount][$urutPelajaran],0,PHP_ROUND_HALF_UP);
                                    }
                                }           

                            }
                        }

                        if ($codeSigner == 1) {
                            if ($semesterMemory == "1/Ganjil") {
                                $pelengkap = $i+$i;
                                foreach ($semesterChoosen as $semester) {
                                    if ($pelengkap == $semester) {
                                        $urutNilai++;
                                        $nilaiSiswa[$siswaCount][$urutNilai] = 0;
                                        if (empty($rerataNilaiFinal[$siswaCount][$urutPelajaran])) {
                                            $rerataNilaiFinal[$siswaCount][$urutPelajaran] = 0;
                                        }
                                    }
                                }           
                            }elseif ($semesterMemory == "2/Genap") {
                                $numberSemester = $i - 1;
                                $pelengkap = $i + $numberSemester;
                                foreach ($semesterChoosen as $semester) {
                                    if ($pelengkap == $semester) {
                                        $nilaiSiswaTemp = $nilaiSiswa[$siswaCount][$urutNilai];
                                        $nilaiSiswa[$siswaCount][$urutNilai] = 0;
                                        $urutNilai++;
                                        $nilaiSiswa[$siswaCount][$urutNilai] = $nilaiSiswaTemp;
                                        if (empty($rerataNilaiFinal[$siswaCount][$urutPelajaran])) {
                                            $rerataNilaiFinal[$siswaCount][$urutPelajaran] = 0;
                                        }
                                    }
                                }       
                            }
                        }

                    }

                    

                }
            }

        }

    $temp = '';
    $noJenjang = 0;
    $higest = 0;
  foreach($daftarPelajaran as $daftar){
    if($daftar->jenjang != $temp){

        $noJenjang++;
        $noPelajaran = 1;
        $temp = $daftar->jenjang;
        $pelajaranTemp[$noPelajaran][$noJenjang] = $daftar->id_pelajaran;
        $qlf = false;

        if (empty($pelajaranChar[$noPelajaran])) {
          $pelajaranChar[$noPelajaran] = $daftar->namapelajaran;
        }

      if($noJenjang != 1){
          $tempNoJenjangReal = $noJenjang-1;
      }
      else{
          $tempNoJenjangReal = $noJenjang;
      }


      for($i=1 ; $i <= $tempNoJenjangReal ; $i++){
      if(isset($pelajaranTemp[$noPelajaran][$i])){
        if($pelajaranTemp[$noPelajaran][$i] == $daftar->id_pelajaran){
            $qlf = true;
            $tempNoJenjangReal = $i;    
        }
      }   
      }

      if($qlf == false){
          $pelajaranChar[$noPelajaran] = $pelajaranChar[$noPelajaran].'/'.$daftar->namapelajaran;
      }

     }elseif($daftar->jenjang == $temp){

        $noPelajaran++;
        $pelajaranTemp[$noPelajaran][$noJenjang] = $daftar->id_pelajaran;
        $qlf = false;

        if (empty($pelajaranChar[$noPelajaran])) {
          $pelajaranChar[$noPelajaran] = $daftar->namapelajaran;
        }

      if($noJenjang != 1){
          $tempNoJenjangReal = $noJenjang-1;
      }
      else {      
          $tempNoJenjangReal = $noJenjang;
        }

      for($i=1 ; $i <= $tempNoJenjangReal ; $i++){
      if(isset($pelajaranTemp[$noPelajaran][$i])){
        if($pelajaranTemp[$noPelajaran][$i] == $daftar->id_pelajaran){
            $qlf = true;
            $tempNoJenjangReal = $i;   
        }
      }   
      }

      if($qlf == false){   
          $pelajaranChar[$noPelajaran] = $pelajaranChar[$noPelajaran].'/'.$daftar->namapelajaran;
        }

    }

    if($noPelajaran > $higest){
        $higest = $noPelajaran;
    }

      
  }

 

  Excel::create('Rerata-'.Input::get('angkatan'), function($excel) use($pelajaranChar,$divider,$semesterChoosen,$nilaiSiswa,$rerataNilaiFinal,$namasiswa,$nis,$nisn,$jurusan) {  
    $excel->sheet('Sheet1', function($sheet) use($pelajaranChar,$divider,$semesterChoosen,$nilaiSiswa,$rerataNilaiFinal,$namasiswa,$nis,$nisn,$jurusan) {
        $theLeader = array('No','NAMA','NISN','NIS','Jurusan');
        $theLeaderLength = count($theLeader);
        $drive = 'A';
        $toggle = false;
        foreach ($theLeader as $leader) {
            if ($toggle == true) {
                $drive++;
                $driveContent = $drive;
            }
            $toggle = true;
            $sheet->cell($drive.'2', function($cell) use($leader) {
                $cell->setValue($leader);
                $cell->setFont(array(
                    'bold'       =>  true
                ));
                $cell->setAlignment('center');
                $cell->setValignment('center');
            });
            
            $sheet->setMergeColumn(array(
                'columns' => array($drive),
                'rows' => array(array(2,3))
            ));

            $sheet->cell($drive.'2', function($cell) use($leader) {
                $cell->setAlignment('center');
                $cell->setValignment('center');
            });


        }

        $togglePelajaran = false;
        foreach ($pelajaranChar as $pelajaran) {
            if ($togglePelajaran == true) {
                for ($i=1; $i <= $divider+1 ; $i++) { 
                    $drive++;
                    $driveMergeSlave = $drive;
                    $driveChild = $drive;
                }
            }else{
                $drive++;
                $driveMergeSlave = $drive;
                $driveChild = $drive;
            }

            for ($i=1; $i <= $divider ; $i++) { 
                $driveMerge = $driveMergeSlave++;
            }
            $togglePelajaran = true;
            $sheet->cell($drive.'2', function($cell) use($pelajaran) {
                $cell->setValue($pelajaran);
                $cell->setFont(array(
                    'bold'       =>  true
                ));
                $cell->setAlignment('center');
            });
            
            $sheet->mergeCells($drive.'2:'.$driveMerge.'2');

            $sheet->cell($drive.'2', function($cell) {
                $cell->setAlignment('center');
            });


            $toggleDriveChild = false;
            foreach ($semesterChoosen as $semester) {
                if ($toggleDriveChild == true) {
                    $driveChild++;
                }
                $toggleDriveChild = true;             
                $sheet->cell($driveChild.'3', function($cell) use($semester) {
                $cell->setValue($semester);
                $cell->setFont(array(
                    'bold'       =>  true
                ));
                $cell->setAlignment('center');
                });

            }

            $driveMerge++;
            $sheet->cell($driveMerge.'2', function($cell) {
                $cell->setValue('R');
                $cell->setFont(array(
                    'bold'       =>  true
                ));
            });

            $sheet->setMergeColumn(array(
                'columns' => array($driveMerge),
                'rows' => array(
                    array(2,3),
                )
            ));

            $sheet->cell($driveMerge.'2', function($cell) {
                $cell->setAlignment('center');
                $cell->setValignment('center');
            });
            

        }

       $sheet->setFreeze('A4');

       $rowLeader = 3;
       $leaderContentMultiplier = 0;
       foreach ($namasiswa as $siswa) {
        $rowLeader++;
        $leaderContentMultiplier++;
            $sheet->cell('A'.$rowLeader, function($cell) use($siswa,$leaderContentMultiplier) {
                $cell->setValue($leaderContentMultiplier);
            });
            $sheet->cell('B'.$rowLeader, function($cell) use($siswa) {
                $cell->setValue($siswa);
            });
            $sheet->cell('C'.$rowLeader, function($cell) use($nisn,$leaderContentMultiplier) {
                $cell->setValue($nisn[$leaderContentMultiplier]);
            });
            $sheet->cell('D'.$rowLeader, function($cell) use($nis,$leaderContentMultiplier) {
                $cell->setValue($nis[$leaderContentMultiplier]);
            });
            $sheet->cell('E'.$rowLeader, function($cell) use($jurusan,$leaderContentMultiplier) {
                $cell->setValue($jurusan[$leaderContentMultiplier]);
            });
       }

       $rowContent = 3;
       $siswaMultiplier = 0;
       $driveContentMemory = $driveContent;
       foreach ($nilaiSiswa as $nilaiStep1) {
        $rowContent++;
        $siswaMultiplier++;
        $driveContent = $driveContentMemory;
        $semesterMultiplier = 0;
        $pelajaranMultiplier = 0;
           foreach ($nilaiStep1 as $nilaiStep2) {
                $driveContent++;
                $semesterMultiplier++;
                $sheet->cell($driveContent.$rowContent, function($cell) use($nilaiStep2) {
                    $cell->setValue($nilaiStep2);
                    $cell->setAlignment('center');
                });

                if ($semesterMultiplier == $divider) {
                    $pelajaranMultiplier++;
                    $driveContent++;
                    $semesterMultiplier = 0;
                    $sheet->cell($driveContent.$rowContent, function($cell) use($rerataNilaiFinal,$siswaMultiplier,$pelajaranMultiplier) {
                        $cell->setValue($rerataNilaiFinal[$siswaMultiplier][$pelajaranMultiplier]);
                        $cell->setAlignment('center');
                    });

                }
           }
       }
        

    });



})->export('xlsx');
    


    }

}