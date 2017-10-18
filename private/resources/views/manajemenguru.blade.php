@extends('headquarters')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Guru
		<small>Data Guru</small>
		</h1>
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Guru</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none">
              <i class="fa fa-minus"></i></button>          
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
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Guru</th>
                  <th>NIP</th>
                  <th>E-Mail</th>
                  <th>Alamat</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @foreach($swan as $data)             
                <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->namaguru}}</td>
                  <td>{{$data->nip}}</td>
                  <td>{{$data->email}}</td>
                  <td>{{$data->alamat}}</td>
                  <td width="10%"><img src="{{URL::asset('/private/storage/app')}}/{{$data->foto}}" style="max-width:100px;max-height:160px;float:center;border: 0px;border-radius: 5px;" />
                  </td>
                  <td width="15%"><center><a href="{{URL('/manajemenguru/dataguru/hapus')}}/{{$data->id}}/{{$data->foto}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenguru/dataguru/edit')}}/{{$data->id}}/{{$data->foto}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>ID</th>
                  <th>Nama Guru</th>
                  <th>NIP</th>
                  <th>E-Mail</th>
                  <th>Alamat</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              </div>
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
              <h3 class="box-title">Tambah Data Guru</h3>
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
            {{Form::open(array('role'=>'form','url'=>'manajemenguru/dataguru/prosestambahguru','enctype'=>'multipart/form-data'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namaguru') ? 'has-error' : ''}}"> 
                {{Form::label('namaguru','Nama Guru',['class'=>'control-label'])}}                    
                {{Form::text('namaguru','',['placeholder'=>'Masukkan Nama Guru','class'=>'form-control'])}}

                  @if($errors->has('namaguru'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaguru')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('nip') ? 'has-error' : ''}}">                  
                    {{Form::label('nip','NIP',['class'=>'control-label'])}}                   
                     {{Form::text('nip','',['placeholder'=>'Masukkan NIP','class'=>'form-control','id'=>'nip'])}}
                    @if($errors->has('nip'))
                      <span class="help-block">
                        <strong>{{$errors->first('nip')}}</strong>
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
              <h3 class="box-title">Edit Data Guru</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'manajemenguru/dataguru/proseseditguru','enctype'=>'multipart/form-data'))}}
            {{Form::hidden('id',$revolution->id,['class'=>'form-control'])}}
            {{Form::hidden('idfoto',$revolution->foto,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namaguru') ? 'has-error' : ''}}"> 
                {{Form::label('namaguru','Nama Guru',['class'=>'control-label'])}}                    
                {{Form::text('namaguru',$revolution->namaguru,['placeholder'=>'Masukkan Nama Guru','class'=>'form-control'])}}

                  @if($errors->has('namaguru'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaguru')}}</strong>
                    </span>
                  @endif                 
                </div>

                  <div class="form-group {{$errors->has('nip') ? 'has-error' : ''}}">                  
                    {{Form::label('nip','NIP',['class'=>'control-label'])}}                   
                     {{Form::text('nip',$revolution->nip,['placeholder'=>'Masukkan NIP','class'=>'form-control'])}}
                    @if($errors->has('nip'))
                      <span class="help-block">
                        <strong>{{$errors->first('nip')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','E-Mail')}}
                  {{Form::email('email',$revolution->email,['placeholder'=>'Masukkan E-Mail','class'=>'form-control'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div> 

                <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                  {{Form::label('alamat','Alamat')}}
                  {{Form::textarea('alamat',$revolution->alamat,['placeholder'=>'Masukkan Alamat','class'=>'form-control'])}}
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
                      <img src="{{URL::asset('/private/storage/app')}}/{{$revolution->foto}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;background:grey;border: 0px;border-radius: 5px;" />
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
                 <a href="{{URL::asset('/manajemenguru/dataguru')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif




	</section>
</div>


@endsection