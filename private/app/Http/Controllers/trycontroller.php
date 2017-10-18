<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP\JasperPHP as JasperPHP;
use File;
use Response;
use Redirect;
use Input;
use App\Http\Controllers\UserListImport;
use Excel;

class trycontroller extends Controller
{
	public function make(){
		$jasper = new JasperPHP;

  $filename = Input::get('namaguru');
 	File::makeDirectory(storage_path($filename));

$jasper->process(
    base_path() . '/masterreport/ajar1.jasper',
    storage_path($filename.'/'),
    array("pdf"),
    array("parameter1" => $filename),
    array(
    	'driver' => 'mysql',
    	'username' => 'phpmyadmin',
    	'host' => 'localhost',
    	'database' => 'metana',
    	'password' => 'telelmotor'
    	)
)->execute();
sleep(2);
if (File::exists(storage_path($filename.'/report1.pdf')))
{
     return Redirect::to('laporan/show/'.$filename);
}



	}
	
public function show($id){

 $file = File::get(storage_path($id.'/report1.pdf'));
    $response = Response::make($file, 200);
    // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
    $response->header('Content-Type', 'application/pdf');

    return $response;
 
}

public function mean(Request $request){
    session()->set('tanggal',$request->tanggal);
    session()->set('modekelas', $request->modekelas);
    session()->set('tanggal2', $request->tanggal2);
}

public function gen(){
    echo session()->get('tanggal');
    echo session()->get('tanggal2');
    echo session()->get('modekelas');
}

public function geng(UserListImport $import){
   

    $results = $import->get()->selectSheets('Sheet1');

     $import->dump();
}


}
