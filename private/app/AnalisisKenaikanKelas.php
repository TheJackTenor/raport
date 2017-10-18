<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisisKenaikanKelas extends Model
{
    protected $table = 'analisiskenaikankelas';

     public function datasiswa(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }
}
