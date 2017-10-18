<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekPengetahuan extends Model
{
    protected $table = 'aspekpengetahuan';

    public function siswaaspekpengetahuan(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }

    public function pelajaran(){
    	return $this->belongsTo('App\MataPelajaran','id_pelajaran');
    }


}
