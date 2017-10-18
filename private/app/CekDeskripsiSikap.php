<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CekDeskripsiSikap extends Model
{
    protected $table = 'cekdeskripsisikap';

    public function siswa(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }
}
