<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaturan;

class PengaturanController extends Controller
{
    public function simpan(Request $request){
    	$task = new Pengaturan();
    	$task->where('id','=',1)->update(['semester'=> $request->semester , 'tahunajaran' =>  $request->tahunajaran, 'analisis'=>$request->analisis, 'jumlah'=>$request->jumlah,'formatKKM'=>$request->formatKKM]);
    	return response()->json($task);
    }
}
