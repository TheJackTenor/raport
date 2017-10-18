  @extends('headquarters')
  @section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manajemen Kelas
        <small>Data kelas</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelas</h3>
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
            <!-- /.box-header -->
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
                  <th width="2%">No</th>
                  <th>Nama Pelajaran</th>
                  <th width="50px">Jenis Pelajaran</th>
                  <th>Pendidikan Agama & Budi Pekerti</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @php
                  $p=0;
                @endphp
                @foreach($swan as $data)  
                 @php
                  $p++;
                @endphp           
                <tr>
                  <td>{{$p}}</td>
                  <td>{{$data->namapelajaran}}</td>
                  <td>{{$data->pknoragama}}</td>
                  <td width="15%">@if($data->agamaandbudi == 1) YA @else BUKAN @endif</td>
                  <td width="15%"><center><a href="{{URL('/manajemenpelajaran/datapelajaran/hapus')}}/{{$data->id}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/datapelajaran/edit')}}/{{$data->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>No</th>
                  <th>Nama Pelajaran</th>
                 <th width="119px">Jenis Pelajaran</th>
                 <th>Pendidikan Agama & Budi Pekerti</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <button id="adding" type="button" class="btn btn-success btn-flat">Tambah Data</button>
            </div>
            @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      
<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary @if(!$errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Kelas</h3>
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
            {{Form::open(array('role'=>'form','url'=>'/manajemenpelajaran/datapelajaran/prosestambahpelajaran'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namapelajaran') ? 'has-error' : ''}}"> 
                {{Form::label('namapelajaran','Nama Pelajaran',['class'=>'control-label'])}}                    
                {{Form::text('namapelajaran','',['placeholder'=>'Masukkan Nama Pelajaran','class'=>'form-control'])}}
                  @if($errors->has('namapelajaran'))
                    <span class="help-block">
                      <strong>{{$errors->first('namapelajaran')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('pknoragama') ? 'has-error' : ''}}">                  
                    {{Form::label('pknoragama','Jenis Pelajaran',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="PKN"> PKN
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="Agama"> Agama
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="Lainnya"> Lainnya
                    </label>
                    </div>  

                    @if($errors->has('pknoragama'))
                      <span class="help-block">
                        <strong>{{$errors->first('pknoragama')}}</strong>
                      </span>
                    @endif           
                </div>

                 <div class="form-group {{$errors->has('agamaandbudi') ? 'has-error' : ''}}">                  
                    {{Form::label('agamaandbudi','Pendidikan Agama & Budi Pekerti',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="agamaandbudi" class="flat-red" value="1"> Ya
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="agamaandbudi" class="flat-red" value="0"> Bukan
                    </label>
                  
                    </div>  

                    @if($errors->has('agamaandbudi'))
                      <span class="help-block">
                        <strong>{{$errors->first('agamaandbudi')}}</strong>
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
              <h3 class="box-title">Edit Data Kelas</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'/manajemenpelajaran/datapelajaran/proseseditpelajaran'))}}
            {{Form::hidden('id',$revolution->id,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namapelajaran') ? 'has-error' : ''}}"> 
                {{Form::label('namapelajaran','Nama Pelajaran',['class'=>'control-label'])}}                    
                {{Form::text('namapelajaran',$revolution->namapelajaran,['placeholder'=>'Masukkan Nama Pelajaran','class'=>'form-control','readonly'=>'readonly'])}}

                  @if($errors->has('namapelajaran'))
                    <span class="help-block">
                      <strong>{{$errors->first('namapelajaran')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{session()->has('error') ? 'has-error' : ''}}">                  
                    {{Form::label('pknoragama','Jenis Pelajaran',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="PKN" @if($revolution->pknoragama == "PKN") checked="checked" @endif> PKN
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="Agama" @if($revolution->pknoragama == "Agama") checked="checked" @endif> Agama
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="pknoragama" class="flat-red" value="Lainnya" @if($revolution->pknoragama == "Lainnya") checked="checked" @endif> Lainnya
                    </label>
                    </div>  

                    @if(Session::has('error'))
                      <span class="help-block">
                        <strong>{{Session::get('error')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('agamaandbudi') ? 'has-error' : ''}}">                  
                    {{Form::label('agamaandbudi','Pendidikan Agama & Budi Pekerti',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="agamaandbudi" class="flat-red" value="1" @if($revolution->agamaandbudi == "1") checked="checked" @endif> Ya
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="agamaandbudi" class="flat-red" value="0" @if($revolution->agamaandbudi == "0") checked="checked" @endif> Bukan
                    </label>
                  
                    </div>  

                    @if($errors->has('agamaandbudi'))
                      <span class="help-block">
                        <strong>{{$errors->first('agamaandbudi')}}</strong>
                      </span>
                    @endif           
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenpelajaran/datapelajaran')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif

    </section>


    <!-- /.content -->
  </div>

  @endsection