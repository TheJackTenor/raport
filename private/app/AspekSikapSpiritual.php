<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekSikapSpiritual extends Model
{
      protected $table = 'aspeksikapspiritual';

    public function siswaaspeksikapspiritual(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }

    public function catchjenispelajaran(){
    	return $this->belongsTo('App\MataPelajaran','id_pelajaran');
    }
}
