<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruWali extends Model
{
    protected $table = 'dataguru';


    public function kelaswali(){
    	return $this->hasOne('App\KelasWali','id_guru');
    }

     public function matapelajarans(){
    	return $this -> belongsToMany('App\MataPelajaran','datamengajar','id_guru','id_pelajaran'); 
    }

    public function mengajarkelas(){
    	return $this -> belongsToMany('App\KelasWali','datamengajarkelas','id_guru','id_kelas');
    }

    public function user(){
        return $this -> hasOne('App\User','id_guru');
    }
}
