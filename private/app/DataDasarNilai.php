<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDasarNilai extends Model
{
    protected $table = 'datadasarnilai';

    public function pelajaran(){
    	return $this->belongsTo('App\MataPelajaran','id_pelajaran');
    }
}
