<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use Input;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Http\UploadedFile;

error_reporting(E_ALL & ~E_NOTICE);
class DataMadrasahController extends Controller
{
    public function show(){
    	$dataguru = DB::table('dataguru')->select('namaguru','nip','id')->get();

    	$data = DB::table('datamadrasah')->first();

    	return View::make('datamadrasah')->with('datagurus',$dataguru)->with('datas',$data);
    }

      public function simpan(Request $request){

        if ($request->file('foto') == "") {
           $data = array(
            'namainstansi' => Input::get('namainstansi'),
            'namamadrasah' => Input::get('namamadrasah'),
            'nimnsm' => Input::get('nimnsm'),
            'jalan' => Input::get('jalan'),
            'desa' => Input::get('desa'),
            'kecamatan' => Input::get('kecamatan'),
            'kodepos' => Input::get('kodepos'),
            'telepon' => Input::get('telepon'),
            'kabupaten' => Input::get('kabupaten'),
            'provinsi' => Input::get('provinsi'),
            'website' => Input::get('website'),
            'email' => Input::get('email'),
            'id_guru' => Input::get('kepalasekolah')
            );
        }else{
            $hapuslogo = DB::table('datamadrasah')->select('logo')->where('id','=',1)->first();
            Storage::delete($hapuslogo->logo);
            $foto = Input::file('foto');
            $img = Image::make(Input::file('foto'));
            $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
                });
            $namafoto = $kelas = str_replace(" ", "", $foto->getClientOriginalName());
            
            $img -> save('private/storage/app/'."logoman-".$namafoto);

            $con = "logoman-".$namafoto;

            $data = array(
                'namainstansi' => Input::get('namainstansi'),
                'namamadrasah' => Input::get('namamadrasah'),
                'nimnsm' => Input::get('nimnsm'),
                'jalan' => Input::get('jalan'),
                'desa' => Input::get('desa'),
                'kecamatan' => Input::get('kecamatan'),
                'kodepos' => Input::get('kodepos'),
                'telepon' => Input::get('telepon'),
                'kabupaten' => Input::get('kabupaten'),
                'provinsi' => Input::get('provinsi'),
                'website' => Input::get('website'),
                'email' => Input::get('email'),
                'id_guru' => Input::get('kepalasekolah'),
                'logo' => $con
                );
        }

        
        DB::table('datamadrasah')->update($data);

        $nama = DB::table('datamadrasah')->select('namamadrasah')->first();
        session()->set('nama',$nama->namamadrasah);

        return Redirect::to('datamadrasah')->with(session()->flash('pesan','Data Madrasah Berhasil Di Update !'));
    }
}
