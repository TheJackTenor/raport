@extends('headquarters')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Admin
		<small>Data Admin</small>
		</h1>

	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Admin</h3>
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
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Admin</th>
                  <th>E-Mail</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @php
                  $no = 1;
                @endphp
                @foreach($swan as $data)             
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$data->username}}</td>
                  <td>{{$data->email}}</td>
                  <td width="15%"><center> @if($data->id != Auth::user()->id) <a href="{{URL('/manajemenadmin/dataadmin/hapus')}}/{{$data->id}}"><button class="btn btn-danger btn-flat">Hapus</button></a> @endif <a href="{{URL('/manajemenadmin/dataadmin/edit')}}/{{$data->id}}"><button class="btn btn-warning btn-flat">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>No.</th>
                  <th>Nama Admin</th>
                  <th>E-Mail</th>
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
              <h3 class="box-title">Tambah Data Admin</h3>
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
            {{Form::open(array('role'=>'form','url'=>'manajemenadmin/admin/prosestambahadmin','enctype'=>'multipart/form-data'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namaadmin') ? 'has-error' : ''}}"> 
                {{Form::label('namaadmin','Nama Admin',['class'=>'control-label'])}}                    
                {{Form::text('namaadmin','',['placeholder'=>'Masukkan Nama Admin','class'=>'form-control'])}}

                  @if($errors->has('namaadmin'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaadmin')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">                  
                    {{Form::label('email','E-Mail',['class'=>'control-label'])}}                   
                     {{Form::email('email','',['placeholder'=>'Masukkan E-Mail','class'=>'form-control'])}}
                    @if($errors->has('email'))
                      <span class="help-block">
                        <strong>{{$errors->first('email')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                  {{Form::label('password','Password')}}
                  {{Form::text('password','',['placeholder'=>'Masukkan Password','class'=>'form-control'])}}
                    @if($errors->has('password'))
                    <span class="help-block">
                      <strong>{{$errors->first('password')}}</strong>
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
              <h3 class="box-title">Edit Data Admin</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'manajemenadmin/dataadmin/proseseditadmin','enctype'=>'multipart/form-data'))}}
            {{Form::hidden('id',$swan->id,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namaguru') ? 'has-error' : ''}}"> 
                {{Form::label('namaadmin','Nama Admin',['class'=>'control-label'])}}                    
                {{Form::text('namaadmin',$swan->username,['placeholder'=>'Masukkan Nama Admin','class'=>'form-control'])}}

                  @if($errors->has('namaadmin'))
                    <span class="help-block">
                      <strong>{{$errors->first('namaadmin')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">                  
                    {{Form::label('email','E-Mail',['class'=>'control-label'])}}                   
                     {{Form::email('email',$swan->email,['placeholder'=>'Masukkan E-Mail','class'=>'form-control'])}}
                    @if($errors->has('email'))
                      <span class="help-block">
                        <strong>{{$errors->first('email')}}</strong>
                      </span>
                    @endif           
                </div>
              

              </div>  

               <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenadmin/admin')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>

              </div>
              <!-- /.box-body -->

             
           
          </div>
          </div>
          </div>
@endif




	</section>
</div>


@endsection