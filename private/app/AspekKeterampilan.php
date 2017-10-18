<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekKeterampilan extends Model
{
   protected $table = 'aspekketerampilan';

    public function siswaaspekketerampilan(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }

     public function pelajaran(){
    	return $this->belongsTo('App\MataPelajaran','id_pelajaran');
    }


}
