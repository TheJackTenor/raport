<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DataKaryawanValidator;
use App\Http\Requests\DataKaryawanValidator2;
use Input;
use DB;
use Redirect;
use View;
use Image;
use Storage;

class KaryawanController extends Controller
{
//============================================DATA KARYAWAN CONTROLLER=================================================
    public function datakaryawan(){
        $data = DB::table('datakaryawan')->get();
        return View::make('manajemenkaryawan')->with('data',$data)->with(session()->forget('status'));
    }

    public function insertdatakaryawan(DataKaryawanValidator $validator){
        $foto = Input::file('foto');
        $img = Image::make(Input::file('foto'));
        $img -> resize(140,200);
        $img -> save('private/storage/app/'."foto-karyawan-".$foto->getClientOriginalName());
        $con = "foto-karyawan-".$foto->getClientOriginalName();


        $data = array(
            'namakaryawan' => Input::get('namakaryawan'),
            'email' => Input::get('email'),
            'posisiKaryawan' => Input::get('posisiKaryawan'),
            'alamat' => Input::get('alamat'),
            'foto' => $con
            );
         DB::table('datakaryawan')->insert($data);

        $value = DB::table('datakaryawan')->max('id');

        if (Input::get('posisiKaryawan') == 'TU') {
            $hak_akses = 4;
        }else{
            $hak_akses = 6;
        }

        $data2 = array(
            'id_karyawan' => $value,
            'username' => Input::get('namakaryawan'),
            'password' => bcrypt($value."1995"),
            'email' => Input::get('email'),
            'hak_akses' => $hak_akses
            );     
        DB::table('user')->insert($data2);
        return Redirect::to('manajemenkaryawan')->with('message','Data Karyawan Berhasil Ditambahkan !');
    }

    public function hapusdatakaryawan($id){
        $dataFoto = DB::table('datakaryawan')->select('foto')->where('id','=',$id)->first();
        Storage::delete($dataFoto);

        DB::table('datakaryawan')->where('id','=',$id)->delete();
        return Redirect::back()->with('message','Data Karyawan Berhasil Dihapus !');
    }

    public function tampiledit($id){
        $data = DB::table('datakaryawan')->where('id','=',$id)->first();
        return View::make('manajemenkaryawan')->with('data',$data)->with(session()->flash('status','yes'));
    }

    public function simpan(Request $request,DataKaryawanValidator2 $validator){
        if ($request->file('foto') == "") {
             $data = array(
                'namakaryawan' => Input::get('namakaryawan'),
                'email' => Input::get('email'),
                'alamat' => Input::get('alamat')
            );
        }else{
            Storage::delete(Input::get('idfoto'));

            $foto = Input::file('foto');
            $img = Image::make(Input::file('foto'));
            $img -> resize(140,200);
            $img -> save('private/storage/app/'."foto-karyawan-".$foto->getClientOriginalName());
            $con = "foto-karyawan-".$foto->getClientOriginalName();

             $data = array(
                'namakaryawan' => Input::get('namakaryawan'),
                'email' => Input::get('email'),
                'alamat' => Input::get('alamat'),
                'foto' => $con
            );
        } 

        DB::table('datakaryawan')->where('id','=',Input::get('id'))->update($data);
        return Redirect::to('manajemenkaryawan')->with('message','Data karyawan berhasil diubah !');
    }

//============================================DATA KARYAWAN CONTROLLER=================================================

//============================================DATA KELAS TU CONTROLLER=================================================

    public function kelasBK(){
        $data = DB::table('datakelasbk')->join('datakaryawan', function($join){
            $join->on('datakelasbk.id_karyawan','=','datakaryawan.id');
        })->join('datakelas', function($join2){
            $join2->on('datakelasbk.id_kelas','=','datakelas.id');
        })->select('datakelasbk.id_karyawan','datakaryawan.namakaryawan','datakelas.namakelas')->orderBy('datakaryawan.namakaryawan','asc')->get(); 

        $dataBK = DB::table('datakaryawan')->select('namakaryawan','id','status')->where('posisiKaryawan','=','BK')->get();

        $dataKelas = DB::table('datakelas')->select('id','namakelas')->get();
        $dataKelasExist = DB::table('datakelasbk')->select('id_kelas')->get();


        return View::make('datakelasbk')->with('data',$data)->with('databk',$dataBK)->with('dataKelas',$dataKelas)->with('dataKelasExist',$dataKelasExist)->with(session()->forget('status'));
    }

    public function simpanKelasBk(){
        $pilihKelas = Input::get('pilihkelas');

        foreach ($pilihKelas as $key => $value) {
            $data = array(
                'id_karyawan' => Input::get('pilihbk'),
                'id_kelas' => $value
                );
            DB::table('datakelasbk')->insert($data);
        }

        $ubahStatusKaryawan = array(
            'status' => 1
            );

        DB::table('datakaryawan')->where('id','=',Input::get('pilihbk'))->update($ubahStatusKaryawan);

        return Redirect::back();
    }

    public function hapusKelasBk($id){
        DB::table('datakelasbk')->where('id_karyawan','=',$id)->delete();

        $data = array(
            'status' => 0
            );
        DB::table('datakaryawan')->where('id','=',$id)->update($data);
        
        return Redirect::back();
    }

    public function editKelasBk($id){
        $dataBk = DB::table('datakaryawan')->select('id','namakaryawan')->where('id','=',$id)->first();

        $dataKelasChoosen = DB::table('datakelasbk')->join('datakelas', function($join) use($id){
            $join->on('datakelasbk.id_kelas','=','datakelas.id')->where('datakelasbk.id_karyawan','=',$id);
        })->select('datakelas.namakelas','datakelas.id')->get();

        $dataKelasUsed = DB::table('datakelas')->join('datakelasbk', function($join) use($id){
            $join->on('datakelas.id','=','datakelasbk.id_kelas')->where('datakelasbk.id_karyawan','<>',$id);
        })->select('datakelas.namakelas','datakelas.id')->get();

        $dataKelas = DB::table('datakelas')->select('namakelas','id')->get();

        return View::make('datakelasbk')->with('dataBk',$dataBk)->with('dataKelasChoosen',$dataKelasChoosen)->with('dataKelasUsed',$dataKelasUsed)->with('dataKelas',$dataKelas)->with(session()->set('status','true'));
    }

    public function simpanEditKelasBk(){
        DB::table('datakelasbk')->where('id_karyawan','=',Input::get('id'))->delete();

        $dataKelas = Input::get('pilihkelas');

        foreach ($dataKelas as $key => $value) {
            $data = array(
                'id_karyawan' => Input::get('id'),
                'id_kelas' => $value
                );
            DB::table('datakelasbk')->insert($data);
        }

        return Redirect::to('manajemenkaryawan/datakelasbk');
    }


}
