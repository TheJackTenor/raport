<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ValidasiLogin;
use Input;
use DB;
use Redirect;
use View;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ValidasiLogin $validasi)
    {
        $data = array(
            'nama' => Input::get('name'),
            'alamat' => Input::get('address'),
            'kelas' => Input::get('class'),
            );
        DB::table('datasiswa')->insert($data);
        return Redirect::to('/read')->with('message','Data siswa berhasil ditambahkan !');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = DB::table('datasiswa')->get();
        return View::make('read')->with('swan',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=DB::table('datasiswa')->where('id_siswa','=',$id)->first();
        return View::make('introducing')->with('revolution',$data)->with(session()->flash('status', 'Silahkan ubah data dengan benar'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $data = array(
            'nama' => Input::get('name'),
            'alamat' => Input::get('address'),
            'kelas' => Input::get('class'),
             );
        DB::table('datasiswa')->where('id_siswa','=',Input::get('id_siswa'))->update($data);
        return Redirect::to('/read')->with('message','Data berhasil diedit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('datasiswa')->where('id_siswa','=',$id)->delete();
        return Redirect::to('/read')->with('message','Data berhasil dihapus !');
    }
}
