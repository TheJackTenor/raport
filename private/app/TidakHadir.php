<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TidakHadir extends Model
{
    protected $table = 'tidakhadir';

    public function jenengsiswo(){
    	return $this->belongsTo('App\DataSiswa','id_siswa');
    }
}
