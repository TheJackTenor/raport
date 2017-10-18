@extends('headquarters')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Karyawan
		</h1>

		<ol class="breadcrumb">
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Karyawan</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none">
              <i class="fa fa-minus"></i></button>          
          </div>
          @endif
            </div>

            @if(!Session::has('status'))
     
            <div class="box-body">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('message')}}
              </div>
            @endif
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Karyawan</th>
                  <th>E-Mail</th> 
                  <th>Posisi</th>         
                  <th>Alamat</th> 
                  <th>Foto</th>           
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @foreach($data as $datas)             
                <tr>
                  <td>{{$datas->id}}</td>
                  <td>{{$datas->namakaryawan}}</td>
                  <td>{{$datas->email}}</td>
                  <td>{{$datas->posisiKaryawan}}</td>
                  <td>{{$datas->alamat}}</td>
                   <td width="10%"><img src="./private/storage/app/{{$datas->foto}}" style="max-width:100px;max-height:160px;float:center;border: 0px;border-radius: 5px;" />
                  </td>
                  <td width="15%"><center><a href="{{URL('/manajemenkaryawan/hapus')}}/{{$datas->id}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenkaryawan/edit/')}}/{{$datas->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>ID</th>
                  <th>Nama Karyawan</th>
                  <th>E-Mail</th> 
                  <th>Posisi</th>         
                  <th>Alamat</th> 
                  <th>Foto</th>           
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <button id="adding" type="button" class="btn btn-success btn-flat">Tambah Data</button>
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
              <h3 class="box-title">Tambah Data Karyawan</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">
              
            <button id="coll" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none;">
              <i class="fa fa-minus"></i></button>
            
          </div>
          @endif
            </div>
            <!-- /.box-header -->
            <!-- form start {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}} -->
            @if(Session::has('status'))
              @else
            {{Form::open(array('role'=>'form','url'=>'manajemenkaryawan/tambahkaryawan','enctype'=>'multipart/form-data'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namakaryawan') ? 'has-error' : ''}}"> 
                {{Form::label('namakaryawan','Nama Karyawan',['class'=>'control-label'])}}                    
                {{Form::text('namakaryawan','',['placeholder'=>'Masukkan Nama Karyawan','class'=>'form-control'])}}

                  @if($errors->has('namakaryawan'))
                    <span class="help-block">
                      <strong>{{$errors->first('namakaryawan')}}</strong>
                    </span>
                  @endif                 
                </div>


                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','E-Mail')}}
                  {{Form::email('email','',['placeholder'=>'Masukkan E-Mail','class'=>'form-control'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('posisiKaryawan') ? 'has-error' : ''}}">                  
                    {{Form::label('posisiKaryawan','Posisi Karyawan',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="posisiKaryawan" class="flat-red" value="TU"> TU
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="posisiKaryawan" class="flat-red" value="BK"> BK
                    </label>
                    </div>  

                    @if($errors->has('posisiKaryawan'))
                      <span class="help-block">
                        <strong>{{$errors->first('posisiKaryawan')}}</strong>
                      </span>
                    @endif           
                </div> 

                <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                  {{Form::label('alamat','Alamat')}}
                  {{Form::textarea('alamat','',['placeholder'=>'Masukkan Alamat','class'=>'form-control'])}}
                    @if($errors->has('alamat'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamat')}}</strong>
                    </span>
                  @endif                 
                </div>  

                 <div class="form-group {{$errors->has('foto') ? 'has-error' : ''}}">
                  
                  {{Form::label('foto','Unggah Foto')}}
                
                  <div class="row">
                    <div class="col-md-2">
                      <img src="http://placehold.it/140x200" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;background:grey;border: 0px;border-radius: 5px;" />
                    </div>
                  </div>                                  
                  <input type="file" id="fotoguru" name="foto" class="validate"/ >
                  <p class="help-block">Ekstensi foto yang diizinan : jpeg, png, bmp, gif, atau svg</p>

                  @if($errors->has('foto'))
                  <span class="help-block">
                    <strong>{{$errors->first('foto')}}</strong>
                  </span>
                  @endif
                </div>                   
              </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                <button onclick="kembali();" type="button" class="btn btn-warning btn-flat">Kembali</button>
                 {{Form::close()}}               
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
              <h3 class="box-title">Edit Data Karyawan</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'manajemenkaryawan/edit/simpan','enctype'=>'multipart/form-data'))}}
            {{Form::hidden('id',$data->id,['class'=>'form-control'])}}
            {{Form::hidden('idfoto',$data->foto,['class'=>'form-control'])}}
              <div class="box-body">
              
              <div class="form-group {{ $errors->has('namakaryawan') ? 'has-error' : ''}}"> 
                {{Form::label('namakaryawan','Nama Karyawan',['class'=>'control-label'])}}                    
                {{Form::text('namakaryawan',$data->namakaryawan,['placeholder'=>'Masukkan Nama Karyawan','class'=>'form-control'])}}

                  @if($errors->has('namakaryawan'))
                    <span class="help-block">
                      <strong>{{$errors->first('namakaryawan')}}</strong>
                    </span>
                  @endif                 
                </div>


                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','E-Mail')}}
                  {{Form::email('email',$data->email,['placeholder'=>'Masukkan E-Mail','class'=>'form-control'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div> 

                 <div class="form-group {{$errors->has('posisiKaryawan') ? 'has-error' : ''}}">                  
                    {{Form::label('posisiKaryawan','Posisi Karyawan',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="posisiKaryawan" class="flat-red" value="TU" @if($data->posisiKaryawan == 'TU') checked @endif disabled="disabled"> TU
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="posisiKaryawan" class="flat-red" value="BK" @if($data->posisiKaryawan == 'BK') checked @endif disabled="disabled"> BK
                    </label>
                    </div>  

                    @if($errors->has('posisiKaryawan'))
                      <span class="help-block">
                        <strong>{{$errors->first('posisiKaryawan')}}</strong>
                      </span>
                    @endif           
                </div> 

                <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                  {{Form::label('alamat','Alamat')}}
                  {{Form::textarea('alamat',$data->alamat,['placeholder'=>'Masukkan Alamat','class'=>'form-control'])}}
                    @if($errors->has('alamat'))
                    <span class="help-block">
                      <strong>{{$errors->first('alamat')}}</strong>
                    </span>
                  @endif                 
                </div> 

                 <div class="form-group {{$errors->has('foto') ? 'has-error' : ''}}">
                  
                  {{Form::label('foto','Unggah Foto')}}
                
                  <div class="row">
                    <div class="col-md-2">
                      <img src="{{URL::asset('/private/storage/app')}}/{{$data->foto}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;background:grey;border: 0px;border-radius: 5px;" />
                    </div>
                  </div>                                  
                  <input type="file" id="fotoguru" name="foto" class="validate"/ >
                  <p class="help-block">Ekstensi foto yang diizinan : jpeg, png, bmp, gif, atau svg</p>

                  @if($errors->has('foto'))
                  <span class="help-block">
                    <strong>{{$errors->first('foto')}}</strong>
                  </span>
                  @endif
                </div>                           

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenkaryawan')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif




	</section>
</div>


@endsection