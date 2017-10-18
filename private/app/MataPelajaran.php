<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class MataPelajaran extends Model
{

	protected $table = 'datapelajaran';

    public function guruwali(){
    	return $this -> belongsToMany('App\GuruWali','datamengajar','id_pelajaran','id_guru'); 
    }
}
