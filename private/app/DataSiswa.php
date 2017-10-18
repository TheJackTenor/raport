<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class DataSiswa extends Model
{

	protected $table = 'datasiswa';

    public function datakelas(){
    	return $this->belongsTo('App\KelasWali','id_kelas');
    }

    public function nilaipengetahuan(){
    	return $this->belongsTo('App\AspekPengetahuan','id_siswa');
    }
}
