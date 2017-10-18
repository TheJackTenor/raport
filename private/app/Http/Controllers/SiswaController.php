<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SiswaValidator;
use App\Http\Requests\SiswaValidator2;
use App\Http\Requests\UploadSiswaValidator;
use App\DataSiswa;
use Input;
use DB;
use Redirect;
use View;
use Excel;
use Plupload;

class SiswaController extends Controller
{
    //============================================ADMIN SECTION===========================================
    public function inputsiswa(SiswaValidator $validator){
        if (!Input::has('namawali')) {
            $namawali = "-";
        }else{
            $namawali = Input::get('namawali');
        }

        if (!Input::has('nomorteleponwali')) {
            $teleponwali = "-";
        }else{
            $teleponwali = Input::get('nomorteleponwali');
        }

        if (!Input::has('alamatwali')) {
            $alamatwali = "-";
        }else{
            $alamatwali = Input::get('alamatwali');
        }

        if (!Input::has('pekerjaanwali')) {
            $pekerjaanwali = "-";
        }else{
            $pekerjaanwali = Input::get('pekerjaanwali');
        }

        $ttl = Input::get('tempatlahir').", ".Input::get('tanggallahir');

        $tahunmasuk = date("Y");


    	$data = array(
    		'namasiswa' => Input::get('namasiswa'),
    		'alamatsiswa' => Input::get('alamatsiswa'),
    		'nis' => Input::get('nis'),
    		'nisn' => Input::get('nisn'),
            'id_kelas' => Input::get('pilihkelas'),
            'email' => Input::get('email'),
    		'ttl' => $ttl,
    		'jeniskelamin' => Input::get('jeniskelamin'),
    		'agama' => Input::get('agama'),
    		'statusdalamkeluarga' => Input::get('statusdalamkeluarga'),
    		'anakke' => Input::get('anakke'),
    		'nomortelepon' => Input::get('nomortelepon'),
    		'sekolahasal' => Input::get('sekolahasal'),
    		'diterimakelas' => Input::get('diterimakelas'),
    		'diterimatanggal' => Input::get('diterimatanggal'),
    		'namaayah' => Input::get('namaayah'),
    		'namaibu' => Input::get('namaibu'),
    		'alamatortu' => Input::get('alamatortu'),
    		'nomorteleponortu' => Input::get('nomorteleponortu'),
    		'pekerjaanayah' => Input::get('pekerjaanayah'),
    		'pekerjaanibu' => Input::get('pekerjaanibu'),
    		'namawali' => $namawali,
    		'nomorteleponwali' => $teleponwali,
    		'alamatwali' => $alamatwali,
    		'pekerjaanwali' => $pekerjaanwali,
            'tahunmasuk' => $tahunmasuk
    		);
    	DB::table('datasiswa')->insert($data);
    	return Redirect::back()->with('message','Data siswa berhasil ditambahkan !');
    }

    public function datasiswa(){
        $kelas = DB::table('datakelas')->select('id','namakelas')->get();
    	$data = DataSiswa::orderBy('nis','asc')->get();
        $data2 = DB::table('datakelas')->select('id','namakelas')->get();
        return View::make('manajemensiswa')->with('swan',$data)->with('swan2',$data2)->with('kelas',$kelas)->with(session()->forget('status'));
    }

    public function edit($id){
    	$data= DataSiswa::find($id);
        $data2=DB::table('datakelas')->select('id','namakelas')->get();
    	return View::make('manajemensiswa')->with('revolution',$data)->with('swanedit',$data2)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

    public function editeksekutor(Request $request, SiswaValidator2 $validator){
        
        if (!Input::has('namawali')) {
            $namawali = "-";
        }else{
            $namawali = Input::get('namawali');
        }

        if (!Input::has('nomorteleponwali')) {
            $teleponwali = "-";
        }else{
            $teleponwali = Input::get('nomorteleponwali');
        }

        if (!Input::has('alamatwali')) {
            $alamatwali = "-";
        }else{
            $alamatwali = Input::get('alamatwali');
        }

        if (!Input::has('pekerjaanwali')) {
            $pekerjaanwali = "-";
        }else{
            $pekerjaanwali = Input::get('pekerjaanwali');
        }

    		$data = array(
    		'namasiswa' => Input::get('namasiswa'),
    		'alamatsiswa' => Input::get('alamatsiswa'),
    		'nis' => Input::get('nis'),
    		'nisn' => Input::get('nisn'),
            'email' => Input::get('email'),
    		'ttl' => Input::get('ttl'),
    		'jeniskelamin' => Input::get('jeniskelamin'),
    		'agama' => Input::get('agama'),
    		'statusdalamkeluarga' => Input::get('statusdalamkeluarga'),
    		'anakke' => Input::get('anakke'),
    		'nomortelepon' => Input::get('nomortelepon'),
    		'sekolahasal' => Input::get('sekolahasal'),
    		'diterimakelas' => Input::get('diterimakelas'),
    		'diterimatanggal' => Input::get('diterimatanggal'),
    		'namaayah' => Input::get('namaayah'),
    		'namaibu' => Input::get('namaibu'),
    		'alamatortu' => Input::get('alamatortu'),
    		'nomorteleponortu' => Input::get('nomorteleponortu'),
    		'pekerjaanayah' => Input::get('pekerjaanayah'),
    		'pekerjaanibu' => Input::get('pekerjaanibu'),
    		'namawali' => $namawali,
            'nomorteleponwali' => $teleponwali,
            'alamatwali' => $alamatwali,
            'pekerjaanwali' => $pekerjaanwali,
            'id_kelas' => Input::get('pilihkelas'),
    		);
    	DB::table('datasiswa')->where('id','=',Input::get('id'))->update($data);
    	return Redirect::to('manajemensiswa/datasiswa')->with('message','Data siswa berhasil di edit !');
    }

    public function hapussiswa($id){
    	DB::table('datasiswa')->where('id','=',$id)->delete();
    	return Redirect::to('manajemensiswa/datasiswa')->with('message','Data siswa berhasil dihapus !');
    }
    //============================================ADMIN SECTION===========================================


    //=========================================WALI KELAS SECTION=========================================
    public function datasiswawali(){
        $data = DataSiswa::orderBy('nis','asc')->where('id_kelas','=',session()->get('kelas'))->get();
        $data2 = DB::table('datakelas')->select('id','namakelas')->get();
        return View::make('formwali/manajemensiswa')->with('swan',$data)->with('swan2',$data2)->with(session()->forget('status'));
    }

    public function hapusbulk(){
        $nissiswaArray = Input::get('pilihsiswa');
        foreach ($nissiswaArray as $key => $value) {
            DB::table('datasiswa')->where('id','=',$value)->delete();
        }
        return Redirect::back()->with('message','Data siswa berhasil dihapus !');

    }

    public function findclass(Request $request){
        $datakelas = DB::table('datakelas')->select('id','namakelas')->where('golongankelas','=',$request->golkelas)->get();

        foreach ($datakelas as $key => $value) {
            $data[] = array("value"=> $value->id, "text"=> $value->namakelas);
        }

        return response()->json(array('options'=>$data));
        
    }

    public function naikkelas(Request $request){

        $check = DB::table('migrasi')->where('kelaslama','=',session()->get('kelas'))->count();

        if ($check == 0) {
            $aba = json_decode($request->id_siswa);
            foreach ($aba as $key => $value) {
                $data = array(
                    'id_siswa' => $value,
                    'kelaslama' => $request->kelaslama,
                    'kelasbaru' => $request->kelasbaru,
                    'status' => 'Pending'
                    );
            DB::table('migrasi')->insert($data);
            }

            session()->set('statusmigrasi','Pending');
            return response()->json(array('isipesan'=>'Siswa yang terpilih telah masuk dalam daftar pending dan menunggu konfirmasi dari wali kelas yang dituju','pesan'=>'Berhasil !','status'=>1));
        }else{

             return response()->json(array('isipesan'=>'Anda sudah melakukan migrasi kelas, silahkan tunggu konfirmasi dari wali kelas yang dituju','pesan'=>'Kesalahan !','status'=>0));

        }
       
    }

    public function resetnaikkelas(Request $request){
        DB::table('migrasi')->where('kelaslama','=',$request->id_kelas)->delete();
        session()->set('statusmigrasi','Tidak ada');
        return response()->json();
    }

    public function daftarsiswa(Request $request){

        session()->flash('id_kelas',$request->id_kelas);

        $daftarsiswa = DB::table('migrasi')->join('datasiswa', function($join){
                    $join->on('migrasi.id_siswa','=','datasiswa.id')->where('migrasi.kelaslama','=',session()->get('id_kelas'))->where('migrasi.status','=','Pending');
                })->select('datasiswa.namasiswa','datasiswa.nisn')->orderBy('datasiswa.nis','asc')->get();

        foreach ($daftarsiswa as $key => $value) {
            $nama[] = $value->namasiswa;
            $nisn[] = $value->nisn;
        }
         return response()->json(array('nama'=>$nama, 'nisn'=>$nisn));
    }

    public function cancelconfirmation(Request $request){
        $cancel = array(
            'status' => 'Ditolak'
            );
        DB::table('migrasi')->where('kelaslama','=',$request->id_kelas)->where('kelasbaru','=',session()->get('kelas'))->update($cancel);

         return response()->json();


    }

    public function clean(Request $request){
        $datakelas = DB::table('migrasi')->join('datakelas', function($join){
                    $join->on('migrasi.kelaslama','=','datakelas.id')->where('migrasi.kelasbaru','=',session()->get('kelas'))->where('migrasi.status','=','Pending');
                })->join('dataguru',function($join2){
                    $join2->on('datakelas.id_guru','=','dataguru.id');
                })->select('migrasi.kelaslama','datakelas.namakelas','dataguru.namaguru')->groupBy('migrasi.kelaslama')->get();

                if ($datakelas == "[]") {
                    session()->set('migrasikonfirmasi',0);
                    return response()->json(array('status'=>0, 'no'=>0));
                }elseif($datakelas != "[]"){
                    $no = 0;
                    foreach ($datakelas as $key => $value) {
                        $no++;
                        $text = $value->namakelas." - ".$value->namaguru;
                        $data[] = array(
                            'value' => $value->kelaslama,
                            'text' => $text
                        );


                    }
                    session()->set('migrasikonfirmasi',$no);
                    return response()->json(array('options'=>$data, 'status'=>1, 'no'=>$no));

                }     
    }

    public function okconfirmation(Request $request){
        $idsiswa = DB::table('migrasi')->select('id_siswa')->where('kelaslama','=',$request->id_kelas)->where('kelasbaru','=',session()->get('kelas'))->get();

        foreach ($idsiswa as $key => $value) {
            $datanew = array(
                'id_kelas' => session()->get('kelas')
                );
            DB::table('datasiswa')->where('id','=',$value->id_siswa)->update($datanew);
        }

       $statusmigrasi = array(
            'status' => 'Sukses'
            );
        DB::table('migrasi')->where('kelaslama','=',$request->id_kelas)->where('kelasbaru','=',session()->get('kelas'))->update($statusmigrasi);

        return response()->json();
    }

     public function editwali($id){
        $data= DataSiswa::find($id);
        $data2=DB::table('datakelas')->select('id','namakelas')->get();
        return View::make('formwali/manajemensiswa')->with('revolution',$data)->with('swanedit',$data2)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
    }

     public function editeksekutorwali(Request $request, SiswaValidator2 $validator){
        
        if (!Input::has('namawali')) {
            $namawali = "-";
        }else{
            $namawali = Input::get('namawali');
        }

        if (!Input::has('nomorteleponwali')) {
            $teleponwali = "-";
        }else{
            $teleponwali = Input::get('nomorteleponwali');
        }

        if (!Input::has('alamatwali')) {
            $alamatwali = "-";
        }else{
            $alamatwali = Input::get('alamatwali');
        }

        if (!Input::has('pekerjaanwali')) {
            $pekerjaanwali = "-";
        }else{
            $pekerjaanwali = Input::get('pekerjaanwali');
        }

            $data = array(
            'namasiswa' => Input::get('namasiswa'),
            'alamatsiswa' => Input::get('alamatsiswa'),
            'nis' => Input::get('nis'),
            'nisn' => Input::get('nisn'),
            'email' => Input::get('email'),
            'ttl' => Input::get('ttl'),
            'jeniskelamin' => Input::get('jeniskelamin'),
            'agama' => Input::get('agama'),
            'statusdalamkeluarga' => Input::get('statusdalamkeluarga'),
            'anakke' => Input::get('anakke'),
            'nomortelepon' => Input::get('nomortelepon'),
            'sekolahasal' => Input::get('sekolahasal'),
            'diterimakelas' => Input::get('diterimakelas'),
            'diterimatanggal' => Input::get('diterimatanggal'),
            'namaayah' => Input::get('namaayah'),
            'namaibu' => Input::get('namaibu'),
            'alamatortu' => Input::get('alamatortu'),
            'nomorteleponortu' => Input::get('nomorteleponortu'),
            'pekerjaanayah' => Input::get('pekerjaanayah'),
            'pekerjaanibu' => Input::get('pekerjaanibu'),
            'namawali' => $namawali,
            'nomorteleponwali' => $teleponwali,
            'alamatwali' => $alamatwali,
            'pekerjaanwali' => $pekerjaanwali,
            'id_kelas' => Input::get('pilihkelas'),
            );
    
        DB::table('datasiswa')->where('id','=',Input::get('id'))->update($data);
        return Redirect::to('wali/manajemensiswa')->with('message','Data siswa berhasil di edit !');
    }

    //=========================================IMPOR EXCEL FOR BOTH=========================================

    public function imporsiswa(Request $request, UploadSiswaValidator $validator){

       

        Plupload::receive('file', function ($file){
            $file->move(storage_path().'/app/uploadexcel/', Input::get('id_kelas').$file->getClientOriginalName());


            config(['excel.import.startRow' => 1 ]);

        Excel::filter('chunk')->selectSheets('Sheet1')->load(storage_path('/app/uploadexcel/'.Input::get('id_kelas').$file->getClientOriginalName()))->chunk(250, function($reader){

            DB::table('datasiswa')->where('id_kelas','=',Input::get('id_kelas'))->delete();

          
            $tahunmasuk = Input::get('tahunDiterima');

            $iteration = 0;
            foreach ($reader as $siswa) {
               $iteration++;
                    if ($iteration > 2) {
                        if ($siswa->nis) {

                            if ($siswa->jk == "Laki-laki" or $siswa->jk == "L") {
                                $jeniskelamin = 'L';
                            }elseif ($siswa->jk == "Perempuan" or $siswa->jk == "P") {
                                $jeniskelamin = 'P';
                            }

                            if ($siswa->diterimakelas == "X") {
                                $diterimakelas = 10;
                            }elseif ($siswa->diterimakelas == "XI") {
                                $diterimakelas = 11;
                            }elseif ($siswa->diterimakelas == "XII") {
                                $diterimakelas = 12;
                            }else{
                                $diterimakelas = "";
                            }


                       $data = array(
                        'namasiswa' => $siswa->nama,
                        'alamatsiswa' => $siswa->alamatdidik,
                        'nis' => $siswa->nis,
                        'nisn' => $siswa->nisn,
                        'ttl' => $siswa->ttl,
                        'jeniskelamin' => $jeniskelamin,
                        'agama' => $siswa->agama,
                        'statusdalamkeluarga' => $siswa->sdk,
                        'anakke' => $siswa->anakke,
                        'nomortelepon' => $siswa->telepon,
                        'sekolahasal' => $siswa->sekolahasal,
                        'diterimakelas' => $diterimakelas,
                        'diterimatanggal' => $siswa->diterimatanggal,
                        'namaayah' => $siswa->namaayah,
                        'namaibu' => $siswa->namaibu,
                        'alamatortu' => $siswa->alamatortu,
                        'nomorteleponortu' => $siswa->teleponortu,
                        'pekerjaanayah' => $siswa->pekerjaanayah,
                        'pekerjaanibu' => $siswa->pekerjaanibu,
                        'namawali' => $siswa->namawali,
                        'nomorteleponwali' => $siswa->teleponwali,
                        'alamatwali' => $siswa->alamatwali,
                        'pekerjaanwali' => $siswa->pekerjaanwali,
                        'id_kelas' => Input::get('id_kelas'),
                        'tahunmasuk' => $tahunmasuk
                        );
                       DB::table('datasiswa')->insert($data);
                    }
                }
            }

            

        });
        Storage::delete('/uploadexcel/'.Input::get('id_kelas').$file->getClientOriginalName());
        
    });

return Redirect::back()->with('message','Data siswa berhasil ditambahkan !');
    }


    public function unduhLayout(){
        return response()->download(storage_path().'/app/uploadexcel/LayoutUploadSiswa.xlsx');
    }

}
