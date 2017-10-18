<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasWali extends Model
{
    protected $table = 'datakelas';

    public function guruwali(){
    	return $this->belongsTo('App\GuruWali','id_guru');
    }

    public function datasiswa(){
    	return $this->hasMany('App\DataSiswa','id_kelas');
    }
}
