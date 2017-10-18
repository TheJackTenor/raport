<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;
use Auth;
use Input;
use App\GuruWali;
use Redirect;
use Crypt;

class TransferNilaiController extends Controller
{
    public function cariPelajaran(Request $request){
    	$userId = $request->pilihGuruTransfer;
    	$tahunAjaran = session()->get('tahunajaran');
    	$daftarPelajaran = DB::table('nilai')->join('datapelajaran', function($join) use($userId, $tahunAjaran){
    		$join->on('nilai.id_pelajaran','=','datapelajaran.id')->where('nilai.id_guru','=',$userId)->where('nilai.tahunajaran','=',$tahunAjaran);
    	})->select('nilai.id_pelajaran','datapelajaran.namapelajaran')->distinct()->get();

    	foreach ($daftarPelajaran as $value) {
    		$pelajaran[] = array("value"=>$value->id_pelajaran, "text"=>$value->namapelajaran);
    	}

    	return Response()->json(array("options"=>$pelajaran));
    }

    public function cariKelas(Request $request){
    	$userId = $request->pilihGuruTransfer;
    	$tahunAjaran = session()->get('tahunajaran');
    	$pelajaranId = $request->pilihPelajaranTransfer;

    	$daftarKelas = DB::table('nilai')->join('datakelas', function($join) use($userId,$tahunAjaran,$pelajaranId){
    		$join->on('nilai.id_kelas','=','datakelas.id')->where('nilai.id_guru','=',$userId)->where('nilai.tahunajaran','=',$tahunAjaran)->where('nilai.id_pelajaran','=',$pelajaranId);
    	})->select('nilai.id_kelas','datakelas.namakelas')->distinct()->get();

    	foreach ($daftarKelas as $key) {
    		$value[] = array("value"=>$key->id_kelas, "text"=>$key->namakelas);
    	}

    	return Response()->json(array("options"=>$value));

    }

    public function cariGuruTertuju(Request $request){
    	$daftarGuru = DB::table('dataguru')->select('id','namaguru')->where('id','<>',$request->pilihGuruTransfer)->get();

    	foreach ($daftarGuru as $key) {
    		$value[] = array("value"=>$key->id, "text"=>$key->namaguru);
    	}

    	return Response()->json(array("options"=>$value));
    }

    public function cekGuruTertuju(Request $request){
        $cekPelajaran = DB::table('datamengajar')->where('id_pelajaran','=',$request->pilihPelajaranTransfer)->where('id_guru','=',$request->pilihGuruTertujuTransfer)->count();
        $cekKelas = DB::table('datamengajarkelas')->where('id_kelas','=',$request->pilihKelasTransfer)->where('id_guru','=',$request->pilihGuruTertujuTransfer)->count();

        return Response()->json(array("pelajaran"=>$cekPelajaran, "kelas"=>$cekKelas));
    }

    public function prosesTransferNilai(Request $request){
        if ($request->pelajaranToggle == 0) {
            $data = array(
                'id_guru' => $request->pilihGuruTertujuTransfer,
                'id_pelajaran' => $request->pilihPelajaranTransfer
                );
            DB::table('datamengajar')->insert($data);
        }

        if ($request->kelasToggle == 0) {
            $data = array(
                'id_guru' => $request->pilihGuruTertujuTransfer,
                'id_kelas' => $request->pilihKelasTransfer
                );
            DB::table('datamengajarkelas')->insert($data);
        }

        $data = array(
            'id_guru' => $request->pilihGuruTertujuTransfer
            );
        DB::table('kd')->where('id_guru','=',$request->pilihGuruTransfer)->where('id_pelajaran','=',$request->pilihPelajaranTransfer)->where('id_kelas','=',$request->pilihKelasTransfer)->where('tahunajaran','=',session()->get('tahunajaran'))->update($data);

        DB::table('nilai')->where('id_guru','=',$request->pilihGuruTransfer)->where('id_pelajaran','=',$request->pilihPelajaranTransfer)->where('id_kelas','=',$request->pilihKelasTransfer)->where('tahunajaran','=',session()->get('tahunajaran'))->update($data);

        return Response()->json(array("pesan"=>"Proses transfer nilai berhasil !"));
    }
}
