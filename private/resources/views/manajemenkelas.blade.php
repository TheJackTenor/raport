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
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelas</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
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
                  <th>ID</th>
                  <th>Nama Kelas</th>
                  <th>Golongan Kelas</th>
                  <th>Jurusan Kelas</th>
                  <th>Jumlah Kursi</th>
                  <th>Wali Kelas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
                @foreach($swan as $data)             
                <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->namakelas}}</td>
                  <td>{{$data->golongankelas}}</td>
                  <td>{{$data->jurusankelas}}</td>
                  <td>{{$data->jumlahkursi}}</td>
                  <td>{{$data->guruwali->namaguru}}</td>
                  <td width="15%"><center><a href="{{URL('/manajemenkelas/datakelas/hapus')}}/{{$data->id}}/{{$data->id_guru}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{url('/manajemenkelas/datakelas/edit')}}/{{$data->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>ID</th>
                  <th>Nama Kelas</th>
                  <th>Golongan Kelas</th>
                  <th>Jurusan Kelas</th>
                  <th>Jumlah Kursi</th>
                  <th>Wali Kelas</th>
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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Kelas</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">
              
            <button id="coll" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
          @endif
            </div>
            <!-- /.box-header -->
            <!-- form start {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}} -->
            @if(Session::has('status'))
              @else
            {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namakelas') ? 'has-error' : ''}}"> 
                {{Form::label('namakelas','Nama Kelas',['class'=>'control-label'])}}                    
                {{Form::text('namakelas','',['placeholder'=>'Masukkan Nama Kelas','class'=>'form-control'])}}

                  @if($errors->has('namakelas'))
                    <span class="help-block">
                      <strong>{{$errors->first('namakelas')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('golongankelas') ? 'has-error' : ''}}">                  
                    {{Form::label('golongankelas','Golongan Kelas',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="X"> X
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XI"> XI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XII"> XII
                    </label>
                    </div>  

                    @if($errors->has('golongankelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('golongankelas')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('katjurusan') ? 'has-error' : ''}}">                  
                    {{Form::label('katjurusan','Kategori Jurusan',['class'=>'control-label'])}}                   
                     <select name="katjurusan" id="katjurusan" class="form-control">
                    <option>IPA</option>
                    <option>IPS</option>
                    <option>Agama</option>
                  </select>
                    @if($errors->has('katjurusan'))
                      <span class="help-block">
                        <strong>{{$errors->first('katjurusan')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('kursi') ? 'has-error' : ''}}">
                  {{Form::label('kursi','Jumlah Kursi')}}
                  {{Form::text('kursi','',['placeholder'=>'Masukkan Jumlah Kursi','class'=>'form-control'])}}
                    @if($errors->has('kursi'))
                    <span class="help-block">
                      <strong>{{$errors->first('kursi')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{ $errors->has('pilihwali') ? 'has-error' : ''}}"> 
                {{Form::label('pilihwali','Pilih Wali Kelas',['class'=>'control-label'])}}                    
                <select name="pilihwali" class="form-control select2" style="width: 100%;">
                 @foreach($swan2 as $data2)
                  <option @if($data2->statuswalikelas == '1') disabled="disabled" @endif value="{{$data2 -> id}}">{{$data2 -> nip}} - {{$data2 -> namaguru}} @if($data2->statuswalikelas == '1') (Sudah menjadi wali kelas {{$data2->kelaswali->namakelas}}) @endif</option>
                  @endforeach
                </select>
                  @if($errors->has('pilihwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('pilihwali')}}</strong>
                    </span>
                  @endif                 
                </div>             
              
              </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
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
              <h3 class="box-title">Edit Data Kelas</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/proseseditkelas'))}}
            {{Form::hidden('id',$revolution->id,['class'=>'form-control'])}}
            {{Form::hidden('idwali',$revolution->id_guru,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('namakelas') ? 'has-error' : ''}}"> 
                {{Form::label('namakelas','Nama Kelas',['class'=>'control-label'])}}                    
                {{Form::text('namakelas',$revolution->namakelas,['placeholder'=>'Masukkan Nama Kelas','class'=>'form-control'])}}

                 

                @if($errors->has('namakelas'))
                    <span class="help-block">
                      <strong>{{$errors->first('namakelas')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('golongankelas') ? 'has-error' : ''}}">                  
                    {{Form::label('golongankelas','Golongan Kelas',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="X" @if($revolution -> golongankelas == 'X') checked @endif> X
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XI" @if($revolution -> golongankelas == 'XI') checked @endif> XI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XII" @if($revolution -> golongankelas == 'XII') checked @endif> XII
                    </label>
                    </div>  

                    @if($errors->has('golongankelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('golongankelas')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('katjurusan') ? 'has-error' : ''}}">                  
                    {{Form::label('katjurusan','Kategori Jurusan',['class'=>'control-label'])}}                   
                     <select name="katjurusan" id="katjurusan" class="form-control">
                    <option @if($revolution->jurusankelas == 'IPA') selected @endif>IPA</option>
                    <option @if($revolution->jurusankelas == 'IPS') selected @endif>IPS</option>
                    <option @if($revolution->jurusankelas == 'Agama') selected @endif>Agama</option>
                  </select>
                    @if($errors->has('katjurusan'))
                      <span class="help-block">
                        <strong>{{$errors->first('katjurusan')}}</strong>
                      </span>
                    @endif           
                </div>

                <div class="form-group {{$errors->has('kursi') ? 'has-error' : ''}}">
                  {{Form::label('kursi','Jumlah Kursi')}}
                  {{Form::text('kursi',$revolution->jumlahkursi,['placeholder'=>'Masukkan Jumlah Kursi','class'=>'form-control'])}}

                  @if($errors->has('kursi'))
                    <span class="help-block">
                      <strong>{{$errors->first('kursi')}}</strong>
                    </span>
                  @endif
                </div>
               
                <div class="form-group {{ $errors->has('pilihwali') ? 'has-error' : ''}}"> 
                {{Form::label('pilihwali','Pilih Wali Kelas',['class'=>'control-label'])}}                    
                <select name="pilihwali" class="form-control select2" style="width: 100%;">
                 @foreach($swan2 as $data2)
                  <option @if($revolution->id_guru == $data2->id) @elseif($data2->statuswalikelas == '1') disabled="disabled" @endif value="{{$data2 -> id}}" @if($revolution->id_guru == $data2->id) selected @endif>{{$data2 -> nip}} - {{$data2 -> namaguru}} @if($data2->statuswalikelas == '1') (Sudah menjadi wali kelas {{$data2->kelaswali->namakelas}}) @endif</option>
                  @endforeach
                </select>
                  @if($errors->has('pilihwali'))
                    <span class="help-block">
                      <strong>{{$errors->first('pilihwali')}}</strong>
                    </span>
                  @endif                 
                </div>     
                
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenkelas/datakelas')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif

    </section>


    <!-- /.content -->
  </div>

  @endsection