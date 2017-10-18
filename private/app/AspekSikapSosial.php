<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekSikapSosial extends Model
{
     protected $table = 'aspeksikapsosial';

    public function siswaaspeksikapsosial(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }
}
