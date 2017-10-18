@extends('headquarters')
@section('content')
<style type="text/css">
  th {
    text-align: center;
  }
</style>


<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Siswa
		<small>Data Siswa</small>
		</h1>
	</section>


	<section class="content">
		
<div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Siswa</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none">
              <i class="fa fa-minus"></i></button> <a href="{{URL('layout/siswa')}}"><button type="button" class="btn btn-success btn-flat btn-xs">Unduh Layout Excel</button></a>       
          </div>
          @endif
            </div>

            @if(Session::has('status'))

            @else
     
            <div class="box-body">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('message')}}
              </div>
            @endif
            <div class="table-responsive">
            {{Form::open(array('role'=>'form','url'=>'wali/manajemensiswa/bulk/hapus','enctype'=>'multipart/form-data'))}}
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                <th><input type="checkbox" id="comando" class="flat-red"></th>
                  <th width="10px">No.</th>
                  <th>Nama Siswa</th>
                  <th>NIS</th>
                  <th>NISN</th>
                  <th>Kelas</th>
                  <th>E-Mail</th>
                  <th>Tempat, Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Status Dalam Keluarga</th>
                  <th>Anak ke</th>
                  <th>Alamat Peserta Didik</th>
                  <th>Nomor Telepon Rumah</th>
                  <th>Sekolah Asal</th>
                  <th>Diterima di Kelas</th>
                  <th>Diterima Tanggal</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Alamat Orang Tua</th>
                  <th>Nomor Telepon Ortu</th>
                  <th>Pekerjaan Ayah</th>
                  <th>Pekerjaan Ibu</th>
                  <th>Nama Wali</th>
                  <th>Nomor Telepon Wali</th>
                  <th>Alamat Wali</th>
                  <th>Pekerjaan Wali</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @foreach($swan as $swans => $data)             
                <tr>
                  @php
                    $swans++;
                  @endphp
                   <td align="center"><input type="checkbox"  class="flat-red" id="pilihsiswa" name="pilihsiswa[]" value="{{$data->id}}"></td>
                  <td>{{$swans}}</td>
                  <td><p style="width: 200px">{{$data->namasiswa}}</p></td>
                  <td>{{$data->nis}}</td>
                  <td>{{$data->nisn}}</td>
                  <td>{{$data->datakelas->namakelas}}</td>
                  <td>{{$data->email}}</td>
                  <td><p style="width: 200px">{{$data->ttl}}</p></td>

                  <td><p style="width: 110px">{{$data->jeniskelamin}}</p></td>
                  <td>{{$data->agama}}</td>
                  <td><p style="width: 170px">{{$data->statusdalamkeluarga}}</p></td>
                  <td><p style="width: 80px">{{$data->anakke}}</p></td>

                  <td><p style="width: 300px">{{$data->alamatsiswa}}</p></td>
                  <td>{{$data->nomortelepon}}</td>
                  <td>{{$data->sekolahasal}}</td>
                  <td>{{$data->diterimakelas}}</td> 

                  <td>{{$data->diterimatanggal}}</td>
                  <td><p style="width: 200px"></p>{{$data->namaayah}}</td>
                  <td><p style="width: 200px"></p>{{$data->namaibu}}</td>
                  <td><p style="width: 300px">{{$data->alamatortu}}</p></td> 

                  <td>{{$data->nomorteleponortu}}</td>
                  <td>{{$data->pekerjaanayah}}</td>
                  <td>{{$data->pekerjaanibu}}</td>
                  <td>{{$data->namawali}}</td>

                  <td>{{$data->nomorteleponwali}}</td>
                  <td>{{$data->alamatwali}}</td>
                  <td>{{$data->pekerjaanwali}}</td>                        
                  <td width="15%"><center><a href="{{URL('/manajemensiswa/datasiswa/hapus')}}/{{$data->id}}"><button type="button" class="btn btn-danger btn-flat btn-xs btn-xs">Hapus</button></a> <a href="{{URL('/manajemensiswa/datasiswa/edit')}}/{{$data->id}}"><button type="button" class="btn btn-warning btn-flat btn-xs btn-xs">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                <th><input type="checkbox" id="comando" class="flat-red"></th>
                  <th width="10px">No.</th>
                  <th>Nama Siswa</th>
                  <th>NIS</th>
                  <th>NISN</th>
                  <th>Kelas</th>
                  <th>E-Mail</th>
                  <th>Tempat, Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Status Dalam Keluarga</th>
                  <th>Anak ke</th>
                  <th>Alamat Peserta Didik</th>
                  <th>Nomor Telepon Rumah</th>
                  <th>Sekolah Asal</th>
                  <th>Diterima di Kelas</th>
                  <th>Diterima Tanggal</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Alamat Orang Tua</th>
                  <th>Nomor Telepon Ortu</th>
                  <th>Pekerjaan Ayah</th>
                  <th>Pekerjaan Ibu</th>
                  <th>Nama Wali</th>
                  <th>Nomor Telepon Wali</th>
                  <th>Alamat Wali</th>
                  <th>Pekerjaan Wali</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <button id="exehapus" type="submit" style="display: none;"></button>
              {{Form::close()}}
              </div>
              <div class="btn-group">
              <button id="adding" type="button" class="btn btn-success btn-flat" style="margin-top: 10px;">Tambah Data
              </button>
              <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" style="margin-top: 10px;">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>

               <ul class="dropdown-menu" role="menu">
                    <li><a href="#" data-toggle="modal" data-target="#import" id="importing">Import Excel</a></li>
                  </ul>

              </div>

               <button type="button" id="bulkoption" disabled="disabled" class="btn btn-warning btn-flat dropdown-toggle pull-right" data-toggle="dropdown" style="margin-top: 10px;">Bulk Option 
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu pull-right" role="menu" style="margin-top: -10px">
                    <li data-toggle="modal" data-target="#exampleModal"><a href="#">Hapus Data Terpilih</a></li>
                  </ul>
            </div>
            @endif           
          </div>
        </div>     
      </div>
  

  

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary @if(!$errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Siswa</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">
              
            <button id="coll" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none">
              <i class="fa fa-minus"></i></button>
            
          </div>
          @endif
            </div>
            <!-- /.box-header -->
            <!-- form start {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}} -->
            @if(Session::has('status'))
              @else
            {{Form::open(array('role'=>'form','url'=>'manajemensiswa/datasiswa/prosestambahsiswa','enctype'=>'multipart/form-data'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namasiswa') ? 'has-error' : ''}}"> 
                {{Form::label('namasiswa','Nama Siswa',['class'=>'control-label'])}}                    
                {{Form::text('namasiswa','',['placeholder'=>'Masukkan nama siswa','class'=>'form-control'])}}

                  @if($errors->has('namasiswa'))
                    <span class="help-block">
                      <strong>{{$errors->first('namasiswa')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nis') ? 'has-error' : ''}}">                  
                    {{Form::label('nis','NIS',['class'=>'control-label'])}}                   
                     {{Form::text('nis','',['placeholder'=>'Masukkan NIS siswa','class'=>'form-control','id'=>'nis'])}}
                    @if($errors->has('nis'))
                      <span class="help-block">
                        <strong>{{$errors->first('nis')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('nisn') ? 'has-error' : ''}}">
                  {{Form::label('nisn','NISN')}}
                  {{Form::text('nisn','',['placeholder'=>'Masukkan NISN siswa','class'=>'form-control','id'=>'nisn'])}}
                    @if($errors->has('nisn'))
                    <span class="help-block">
                      <strong>{{$errors->first('nisn')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('pilihkelas') ? 'has-error' : ''}}">                  
                    {{Form::label('pilihkelas','Kelas',['class'=>'control-label'])}}                   
                     <select name="pilihkelas" id="pilihkelas" class="form-control select2" style="width: 100%">
                     @foreach($swan2 as $data2)
                       <option value="{{$data2->id}}">{{$data2 -> namakelas}}</option>
                     @endforeach     
                  </select>
                    @if($errors->has('pilihkelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('pilihkelas')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','E-Mail')}}
                  {{Form::email('email','',['placeholder'=>'Masukkan E-Mail siswa','class'=>'form-control','id'=>'email'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="col-md-3">
                  <div class="form-group {{$errors->has('tempatlahir') ? 'has-error' : ''}}" style="margin-left: -15px">
                  {{Form::label('tempatlahir','Tempat Lahir')}}
                  {{Form::text('tempatlahir','',['placeholder'=>'Contoh -> Bantul, Sleman, Gunung Kidul','class'=>'form-control', 'style'=>'width:110%'])}}
                    @if($errors->has('tempatlahir'))
                    <span class="help-block">
                      <strong>{{$errors->first('tempatlahir')}}</strong>
                    </span>
                  @endif
                  </div>
                </div>
                 
         
              <div class="form-group {{$errors->has('tanggallahir') ? 'has-error' : ''}}">                
                <label class="control-label">Tanggal Lahir</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggallahir" class="form-control" id="datepicker">
                </div>
              </div>
     
                <div class="form-group {{$errors->has('jeniskelamin') ? 'has-error' : ''}}">                  
                    {{Form::label('jeniskelamin','Jenis Kelamin',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="jeniskelamin" class="flat-red" value="L"> L
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jeniskelamin" class="flat-red" value="P"> P
                    </label>
                    </div>  

                    @if($errors->has('jeniskelamin'))
                      <span class="help-block">
                        <strong>{{$errors->first('jeniskelamin')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">                  
                    {{Form::label('agama','Agama',['class'=>'control-label'])}}                   
                     <select name="agama" id="agama" class="form-control">
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Konghuchu</option>
                  </select>
                    @if($errors->has('agama'))
                      <span class="help-block">
                        <strong>{{$errors->first('agama')}}</strong>
                      </span>
                    @endif           
                </div>

                 <div class="form-group {{$errors->has('statusdalamkeluarga') ? 'has-error' : ''}}">                  
                    {{Form::label('statusdalamkeluarga','Status Dalam Keluarga',['class'=>'control-label'])}}   
                    <div class="form-control" style="padding-left: 0px;">                
                    <label class="radio-inline">
                      <input type="radio" name="statusdalamkeluarga" class="flat-red" value="Anak Kandung"> Anak Kandung
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="statusdalamkeluarga" class="flat-red" value="Anak Angkat"> Anak Angkat
                    </label>
                    </div>

                    @if($errors->has('statusdalamkeluarga'))
                      <span class="help-block">
                        <strong>{{$errors->first('statusdalamkeluarga')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('anakke') ? 'has-error' : ''}}">
                  {{Form::label('anakke','Anak ke')}}
                  {{Form::text('anakke','',['placeholder'=>'Anak ke ?','class'=>'form-control'])}}
                    @if($errors->has('anakke'))
                    <span class="help-block">
                      <strong>{{$errors->first('anakke')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatsiswa') ? 'has-error' : ''}}">
                  {{Form::label('alamatsiswa','Alamat')}}
                  {{Form::textarea('alamatsiswa','',['placeholder'=>'Masukkan alamat siswa','class'=>'form-control'])}}
                    @if($errors->has('alamatsiswa'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatsiswa')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nomortelepon') ? 'has-error' : ''}}">
                  {{Form::label('nomortelepon','Nomor Telepon')}}
                  {{Form::text('nomortelepon','',['placeholder'=>'Masukkan nomor telepon siswa','class'=>'form-control'])}}
                    @if($errors->has('nomortelepon'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomortelepon')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('sekolahasal') ? 'has-error' : ''}}">
                  {{Form::label('sekolahasal','Sekolah Asal (SMP/MTs)')}}
                  {{Form::text('sekolahasal','',['placeholder'=>'Masukkan sekolah asal (SMP/MTs)','class'=>'form-control'])}}
                    @if($errors->has('sekolahasal'))
                    <span class="help-block">
                      <strong>{{$errors->first('sekolahasal')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('diterimakelas') ? 'has-error' : ''}}">                  
                    {{Form::label('diterimakelas','Diterima di kelas',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">                  
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="10"> 10
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="11"> 11
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="12"> 12
                    </label>
                    </div>
                    @if($errors->has('diterimakelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('diterimakelas')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('diterimatanggal') ? 'has-error' : ''}}">                
                <label class="control-label">Diterima Tanggal</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="diterimatanggal" class="form-control" id="datepicker2">
                </div>
                 @if($errors->has('diterimatanggal'))
                    <span class="help-block">
                      <strong>{{$errors->first('diterimatanggal')}}</strong>
                    </span>
                  @endif   
              </div>

                <div class="form-group {{$errors->has('namaayah') ? 'has-error' : ''}}">
                  {{Form::label('namaayah','Nama Ayah')}}
                  {{Form::text('namaayah','',['placeholder'=>'Masukkan nama ayah','class'=>'form-control'])}}
                    @if($errors->has('namaayah'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaayah')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namaibu') ? 'has-error' : ''}}">
                  {{Form::label('namaibu','Nama Ibu')}}
                  {{Form::text('namaibu','',['placeholder'=>'Masukkan nama ibu','class'=>'form-control'])}}
                    @if($errors->has('namaibu'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaibu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatortu') ? 'has-error' : ''}}">
                  {{Form::label('alamatortu','Alamat Orang Tua')}}
                  {{Form::textarea('alamatortu','',['placeholder'=>'Masukkan alamat orang tua','class'=>'form-control'])}}
                    @if($errors->has('alamatortu'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatortu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nomorteleponortu') ? 'has-error' : ''}}">
                  {{Form::label('nomorteleponortu','Nomor Telepon Orang Tua')}}
                  {{Form::text('nomorteleponortu','',['placeholder'=>'Masukkan nomor telepon orang tua','class'=>'form-control'])}}
                    @if($errors->has('nomorteleponortu'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomorteleponortu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanayah') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanayah','Pekerjaan Ayah')}}
                  {{Form::text('pekerjaanayah','',['placeholder'=>'Masukkan pekerjaan ayah','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanayah'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanayah')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanibu') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanibu','Pekerjaan Ibu')}}
                  {{Form::text('pekerjaanibu','',['placeholder'=>'Masukkan pekerjaan ibu','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanibu'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanibu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namawali') ? 'has-error' : ''}}">
                  {{Form::label('namawali','Nama Wali')}}
                  {{Form::text('namawali','',['placeholder'=>'Masukkan nama wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('namawali'))
                    <span class="help-block">
                      <strong>{{$errors->first('namawali')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('nomorteleponwali') ? 'has-error' : ''}}">
                  {{Form::label('nomorteleponwali','Nomor Telepon Wali')}}
                  {{Form::text('nomorteleponwali','',['placeholder'=>'Masukkan nomor telepon wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('nomorteleponwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomorteleponwali')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatwali') ? 'has-error' : ''}}">
                  {{Form::label('alamatwali','Alamat Wali')}}
                  {{Form::textarea('alamatwali','',['placeholder'=>'Masukkan alamat wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('alamatwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatwali')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanwali') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanwali','Pekerjaan Wali')}}
                  {{Form::text('pekerjaanwali','',['placeholder'=>'Masukkan pekerjaan wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanwali')}}</strong>
                    </span>
                  @endif                 
                </div>

              </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}   
                 <button type="button" class="btn btn-success btn-flat btn-warning" onclick="kembali();">Kembali</button>                  
              </div>
           @endif
          </div>
          </div>
          </div>


          @if(Session::has('status'))
          <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Siswa</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              {{Form::open(array('role'=>'form','url'=>'manajemensiswa/datasiswa/proseseditsiswa','enctype'=>'multipart/form-data'))}}
              {{Form::hidden('id',$revolution->id,['class'=>'form-control'])}}
              {{Form::hidden('idfoto',$revolution->foto,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namasiswa') ? 'has-error' : ''}}"> 
                {{Form::label('namasiswa','Nama Siswa',['class'=>'control-label'])}}                    
                {{Form::text('namasiswa',$revolution->namasiswa,['placeholder'=>'Masukkan nama siswa','class'=>'form-control'])}}

                  @if($errors->has('namasiswa'))
                    <span class="help-block">
                      <strong>{{$errors->first('namasiswa')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nis') ? 'has-error' : ''}}">                  
                    {{Form::label('nis','NIS',['class'=>'control-label'])}}                   
                     {{Form::text('nis',$revolution->nis,['placeholder'=>'Masukkan NIS siswa','class'=>'form-control','id'=>'nis'])}}
                    @if($errors->has('nis'))
                      <span class="help-block">
                        <strong>{{$errors->first('nis')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('nisn') ? 'has-error' : ''}}">
                  {{Form::label('nisn','NISN')}}
                  {{Form::text('nisn',$revolution->nisn,['placeholder'=>'Masukkan NISN siswa','class'=>'form-control','id'=>'nisn'])}}
                    @if($errors->has('nisn'))
                    <span class="help-block">
                      <strong>{{$errors->first('nisn')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pilihkelas') ? 'has-error' : ''}}">                  
                    {{Form::label('pilihkelas','Kelas',['class'=>'control-label'])}}                   
                     <select name="pilihkelas" id="pilihkelas" class="form-control select2">
                     @foreach($swanedit as $data2)
                       <option value="{{$data2->id}}" @if($data2->id == $revolution->datakelas->id) selected="selected" @endif>{{$data2 -> namakelas}}</option>
                     @endforeach     
                  </select>
                    @if($errors->has('pilihkelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('pilihkelas')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','E-Mail')}}
                  {{Form::email('email',$revolution->email,['placeholder'=>'Masukkan E-Mail siswa','class'=>'form-control','id'=>'email'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('ttl') ? 'has-error' : ''}}">
                  {{Form::label('ttl','Tempat, Tanggal Lahir')}}
                  {{Form::text('ttl',$revolution->ttl,['placeholder'=>'Contoh -> Bantul, 25 November 1994','class'=>'form-control'])}}
                    @if($errors->has('ttl'))
                    <span class="help-block">
                      <strong>{{$errors->first('ttl')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('jeniskelamin') ? 'has-error' : ''}}">                  
                    {{Form::label('jeniskelamin','Jenis Kelamin',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="jeniskelamin" class="flat-red" value="L" @if($revolution->jeniskelamin=='L') checked @endif> L
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jeniskelamin" class="flat-red" value="P" @if($revolution->jeniskelamin=='P') checked @endif> P
                    </label>
                    </div>  

                    @if($errors->has('jeniskelamin'))
                      <span class="help-block">
                        <strong>{{$errors->first('jeniskelamin')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">                  
                    {{Form::label('agama','Agama',['class'=>'control-label'])}}                   
                     <select name="agama" id="agama" class="form-control">
                    <option @if($revolution->agama == 'Islam') selected @endif>Islam</option>
                    <option @if($revolution->agama == 'Kristen') selected @endif>Kristen</option>
                    <option @if($revolution->agama == 'Katolik') selected @endif>Katolik</option>
                    <option @if($revolution->agama == 'Hindu') selected @endif>Hindu</option>
                    <option @if($revolution->agama == 'Budha') selected @endif>Budha</option>
                    <option @if($revolution->agama == 'Konghuchu') selected @endif>Konghuchu</option>
                  </select>
                    @if($errors->has('agama'))
                      <span class="help-block">
                        <strong>{{$errors->first('agama')}}</strong>
                      </span>
                    @endif           
                </div>

                 <div class="form-group {{$errors->has('statusdalamkeluarga') ? 'has-error' : ''}}">                  
                    {{Form::label('statusdalamkeluarga','Status Dalam Keluarga',['class'=>'control-label'])}}   
                    <div class="form-control" style="padding-left: 0px;">                
                    <label class="radio-inline">
                      <input type="radio" name="statusdalamkeluarga" class="flat-red" value="Anak Kandung" @if($revolution->statusdalamkeluarga=='Anak Kandung') checked @endif> Anak Kandung
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="statusdalamkeluarga" class="flat-red" value="Anak Angkat" @if($revolution->statusdalamkeluarga=='Anak Angkat') checked @endif> Anak Angkat
                    </label>
                    </div>

                    @if($errors->has('statusdalamkeluarga'))
                      <span class="help-block">
                        <strong>{{$errors->first('statusdalamkeluarga')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('anakke') ? 'has-error' : ''}}">
                  {{Form::label('anakke','Anak ke')}}
                  {{Form::text('anakke',$revolution->anakke,['placeholder'=>'Anak ke ?','class'=>'form-control'])}}
                    @if($errors->has('anakke'))
                    <span class="help-block">
                      <strong>{{$errors->first('anakke')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatsiswa') ? 'has-error' : ''}}">
                  {{Form::label('alamatsiswa','Alamat')}}
                  {{Form::textarea('alamatsiswa',$revolution->alamatsiswa,['placeholder'=>'Masukkan alamat siswa','class'=>'form-control'])}}
                    @if($errors->has('alamatsiswa'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatsiswa')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nomortelepon') ? 'has-error' : ''}}">
                  {{Form::label('nomortelepon','Nomor Telepon')}}
                  {{Form::text('nomortelepon',$revolution->nomortelepon,['placeholder'=>'Masukkan nomor telepon siswa','class'=>'form-control','id'=>'nomortelepon'])}}
                    @if($errors->has('nomortelepon'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomortelepon')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('sekolahasal') ? 'has-error' : ''}}">
                  {{Form::label('sekolahasal','Sekolah Asal (SMP/MTs)')}}
                  {{Form::text('sekolahasal',$revolution->sekolahasal,['placeholder'=>'Masukkan sekolah asal (SMP/MTs)','class'=>'form-control'])}}
                    @if($errors->has('sekolahasal'))
                    <span class="help-block">
                      <strong>{{$errors->first('sekolahasal')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('diterimakelas') ? 'has-error' : ''}}">                  
                    {{Form::label('diterimakelas','Diterima di kelas',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">                  
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="10" @if($revolution->diterimakelas=='10') checked @endif> 10
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="11" @if($revolution->diterimakelas=='11') checked @endif> 11
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="diterimakelas" class="flat-red" value="12" @if($revolution->diterimakelas=='12') checked @endif> 12
                    </label>
                    </div>
                    @if($errors->has('diterimakelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('diterimakelas')}}</strong>
                      </span>
                    @endif           
                </div>

                 <div class="form-group {{$errors->has('diterimatanggal') ? 'has-error' : ''}}">
                  {{Form::label('diterimatanggal','Diterima tanggal')}}
                  {{Form::text('diterimatanggal',$revolution->diterimatanggal,['placeholder'=>'Contoh -> 25 November 2016','class'=>'form-control'])}}
                    @if($errors->has('diterimatanggal'))
                    <span class="help-block">
                      <strong>{{$errors->first('diterimatanggal')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namaayah') ? 'has-error' : ''}}">
                  {{Form::label('namaayah','Nama Ayah')}}
                  {{Form::text('namaayah',$revolution->namaayah,['placeholder'=>'Masukkan nama ayah','class'=>'form-control'])}}
                    @if($errors->has('namaayah'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaayah')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namaibu') ? 'has-error' : ''}}">
                  {{Form::label('namaibu','Nama Ibu')}}
                  {{Form::text('namaibu',$revolution->namaibu,['placeholder'=>'Masukkan nama ibu','class'=>'form-control'])}}
                    @if($errors->has('namaibu'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaibu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatortu') ? 'has-error' : ''}}">
                  {{Form::label('alamatortu','Alamat Orang Tua')}}
                  {{Form::textarea('alamatortu',$revolution->alamatortu,['placeholder'=>'Masukkan alamat orang tua','class'=>'form-control'])}}
                    @if($errors->has('alamatortu'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatortu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nomorteleponortu') ? 'has-error' : ''}}">
                  {{Form::label('nomorteleponortu','Nomor Telepon Orang Tua')}}
                  {{Form::text('nomorteleponortu',$revolution->nomorteleponortu,['placeholder'=>'Masukkan nomor telepon orang tua','class'=>'form-control'])}}
                    @if($errors->has('nomorteleponortu'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomorteleponortu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanayah') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanayah','Pekerjaan Ayah')}}
                  {{Form::text('pekerjaanayah',$revolution->pekerjaanayah,['placeholder'=>'Masukkan pekerjaan ayah','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanayah'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanayah')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanibu') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanibu','Pekerjaan Ibu')}}
                  {{Form::text('pekerjaanibu',$revolution->pekerjaanibu,['placeholder'=>'Masukkan pekerjaan ibu','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanibu'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanibu')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namawali') ? 'has-error' : ''}}">
                  {{Form::label('namawali','Nama Wali')}}
                  {{Form::text('namawali',$revolution->namawali,['placeholder'=>'Masukkan nama wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('namawali'))
                    <span class="help-block">
                      <strong>{{$errors->first('namawali')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('nomorteleponwali') ? 'has-error' : ''}}">
                  {{Form::label('nomorteleponwali','Nomor Telepon Wali')}}
                  {{Form::text('nomorteleponwali',$revolution->nomorteleponwali,['placeholder'=>'Masukkan nomor telepon wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('nomorteleponwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('nomorteleponwali')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('alamatwali') ? 'has-error' : ''}}">
                  {{Form::label('alamatwali','Alamat Wali')}}
                  {{Form::textarea('alamatwali',$revolution->alamatwali,['placeholder'=>'Masukkan alamat wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('alamatwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamatwali')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('pekerjaanwali') ? 'has-error' : ''}}">
                  {{Form::label('pekerjaanwali','Pekerjaan Wali')}}
                  {{Form::text('pekerjaanwali',$revolution->pekerjaanwali,['placeholder'=>'Masukkan pekerjaan wali siswa (Boleh Dikosongi)','class'=>'form-control'])}}
                    @if($errors->has('pekerjaanwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('pekerjaanwali')}}</strong>
                    </span>
                  @endif                 
                </div> 
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemensiswa/datasiswa')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif


<!--========================================MODAL FOR IMPORT SISWA================================-->
@if(!Request::is('manajemensiswa/datasiswa/edit/*'))
<div class="example-modal">
        <div class="modal fade modal modal-default" id="import" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="closefailed" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Data Siswa</h4>
              </div>
              <div class="modal-body" style="align-content: center;">

              <div style="display: none" id="loading">
                <h3 style="text-align: center;">Sedang memuat. Silahkan tunggu</h3><h3 id="wait" style="text-align: center;"></h3>
              </div>
              
              {{Form::open(array('role'=>'form','url'=>'wali/manajemensiswa/datasiswa/import','enctype'=>'multipart/form-data'))}}
              @php
                $tahunDiterima = array('2013','2014','2015','2016','2017','2018','2019');
              @endphp
              <div class="form-group">  
                {{Form::label('id_kelas','Pilih Kelas',['id' => 'id_kelaslabel'])}}
                <select name="id_kelas" class="form-control" style="width: 100%;" id="choosekelas">
                  @foreach($kelas as $datakelas)
                    <option value="{{$datakelas->id}}">{{$datakelas->namakelas}}</option>
                  @endforeach
                </select>
              </div>

               <div class="form-group">  
                {{Form::label('tahunditerima','Tahun Diterima',['id' => 'tahunDiterimaLabel'])}}
                <select name="tahunDiterima" class="form-control" style="width: 100%;" id="chooseyear">
                  @foreach($tahunDiterima as $tahun)
                    <option value="{{$tahun}}" @if($tahun == date('Y')) selected="selected" @endif>{{$tahun}}</option>
                  @endforeach
                </select>
              </div>

                <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">  
                  {{Form::label('file','Unggah File Excel',['id' => 'filelabel'])}}
                                             
                  <input type="file" id="file" name="file" class="validate"/ >
                  <p class="help-block" id="keterangan">Ekstensi file yang diizinan : xlsm dan xls</p>

                  @if($errors->has('file'))
                  <span class="help-block">
                    <strong id="pesanerror">{{$errors->first('file')}}</strong>
                  </span>
                  @endif
                </div>  

                <div class="modal-footer">
                <button type="submit" id="imporeksekusi" onclick="yo();" class="btn btn-success btn-flat">Eksekusi</button>  
                {{Form::close()}}
                <button type="button" id="imporkeluar" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Keluar</button> 
                        
              </div>
              </div>             
            </div>
          </div>
        </div>
      </div>
  @endif
<!--========================================MODAL FOR NOTIFICATION=======================================-->

<!--============================MODAL FOR DELETING STUDENT IN BULK MODE=================================-->
<div class="example-modal">
        <div class="modal fade modal modal-warning" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
              </div>
              <div class="modal-body">
                <div style="text-align: center"><p><h3>Apakah anda yakin akan menghapus <b id="counter"></b> data siswa yang dipilih ?</h3></p></div>
               

                <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn btn-default btn-flat pull-left" id="eksekusi" >Tidak</button>
                <button type="button" class="btn btn-success btn-flat" onclick="exekusihapus();">Ya</button>            
              </div>
              </div>             
            </div>
          </div>
        </div>
      </div>
<!--============================MODAL FOR DELETING STUDENT IN BULK MODE=================================-->





	</section>
</div>

<script type="text/javascript">
function yo(){

    $('#loading').show();

    $('#id_kelaslabel').hide();
    $('#choosekelas').hide();
    $('#chooseyear').hide();
    $('#imporeksekusi').hide();
    $('#imporkeluar').hide();
    $('#filelabel').hide();
    $('#file').hide();
    $('#keterangan').hide();
    $('#pesanerror').hide();
    $('#tahunDiterimaLabel').hide();

    var dots = window.setInterval( function() {
    var wait = document.getElementById("wait");
    if ( wait.innerHTML.length > 5 ) 
        wait.innerHTML = ".";
    else 
        wait.innerHTML += ".";
    }, 300);

}
</script>

<script type="text/javascript">
  function exekusihapus(){
    document.getElementById('exehapus').click();
  }
</script>




@endsection