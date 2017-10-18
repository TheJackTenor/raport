<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokPelajaran extends Model
{
    protected $table = 'kelompokpelajaran';

    public function datapelajaran(){
    	return $this->belongsTo('App\MataPelajaran','id_pelajaran');
    }

}
