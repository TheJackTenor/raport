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
              <h3 class="box-title">Data Dasar Nilai</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="display: none>
              <i class="fa fa-minus"></i></button>          
          </div>
          @endif
            </div>

            @if(Session::has('status'))

            @else


            <!--====================================ROWSPAN FINDER=================================-->
            @php
              $stack_pelajaran = 0;
              $temp_pelajaran ="";
              $temp_jurusan ="";
            @endphp

            @foreach($value as $find)
              @if($temp_pelajaran != $find->pelajaran->namapelajaran)

                @php
                  $temp_pelajaran = $find->pelajaran->namapelajaran;
                  $count_pelajaran = 1;
                  $stack_pelajaran++;
                  $countpelajaran[$stack_pelajaran] = $count_pelajaran;

                  $count_jurusan = 1;
                  $stack_jurusan = 1;
                  $countjurusan[$stack_pelajaran][$stack_jurusan] = $count_jurusan;
                  $temp_jurusan = $find->jurusan;
                @endphp

              @elseif($temp_pelajaran == $find->pelajaran->namapelajaran)

                @php
                  $count_pelajaran++;
                  $countpelajaran[$stack_pelajaran] = $count_pelajaran;
                @endphp

                @if($temp_jurusan != $find->jurusan)
                  @php
                    $temp_jurusan = $find->jurusan;
                    $stack_jurusan++;
                    $count_jurusan = 1;
                    $countjurusan[$stack_pelajaran][$stack_jurusan] = $count_jurusan;
                  @endphp
                @elseif($temp_jurusan == $find->jurusan)
                  @php
                    $count_jurusan++;
                    $countjurusan[$stack_pelajaran][$stack_jurusan] = $count_jurusan;
                  @endphp
                @endif

              @endif
            @endforeach

            <!--====================================ROWSPAN FINDER=================================-->



            <!-- /.box-header -->
            <div class="box-body">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('message')}}
              </div>
            @endif
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pelajaran</th>
                  <th>Jurusan Pelajaran</th>
                  <th>Golongan Kelas</th>
                  <th>KKM</th>
                  <th>CKM Pengetahuan</th>
                  <th>CKM Keterampilan</th>
                  <th>CKM Sikap</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>  
            @php
              $stack_pelajaran = 0;
              $temp_pelajaran ="";
              $temp_jurusan ="";
              $no = 1;

              $first = true;
            @endphp

            @foreach($value as $find)
              @if($temp_pelajaran != $find->pelajaran->namapelajaran)

                @php
                  $temp_pelajaran = $find->pelajaran->namapelajaran;
                  $count_pelajaran = 1;
                  $stack_pelajaran++;

                  $count_jurusan = 1;
                  $stack_jurusan = 1;
                  $temp_jurusan = $find->jurusan;
                @endphp

                <tr>
                  <td rowspan="{{$countpelajaran[$stack_pelajaran]}}">{{$no++}}</td>
                  <td rowspan="{{$countpelajaran[$stack_pelajaran]}}">{{$find->pelajaran->namapelajaran}}</td>


                    <td rowspan="{{$countjurusan[$stack_pelajaran][$stack_jurusan]}}">{{$find->jurusan}}</td>
                    <td>{{$find->gol_kelas}}</td>
                    <td>{{$find->kkm}}</td>
                    <td>{{$find->ckmpengetahuan}}</td>
                    <td>{{$find->ckmketerampilan}}</td>
                    <td>{{$find->ckmsikap}}</td>
                    <td width="15%"><center><a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/hapus')}}/{{$find->id}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/edit')}}/{{$find->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>


              @elseif($temp_pelajaran == $find->pelajaran->namapelajaran)

                @if($temp_jurusan != $find->jurusan)
                  @php
                    $temp_jurusan = $find->jurusan;
                    $stack_jurusan++;
                  @endphp
                  <tr>
                    <td rowspan="{{$countjurusan[$stack_pelajaran][$stack_jurusan]}}">{{$find->jurusan}}</td>
                    <td>{{$find->gol_kelas}}</td>
                    <td>{{$find->kkm}}</td>
                    <td>{{$find->ckmpengetahuan}}</td>
                    <td>{{$find->ckmketerampilan}}</td>
                    <td>{{$find->ckmsikap}}</td>
                    <td width="15%"><center><a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/hapus')}}/{{$find->id}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/edit')}}/{{$find->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                @elseif($temp_jurusan == $find->jurusan)
                  <tr>
                    <td>{{$find->gol_kelas}}</td>
                    <td>{{$find->kkm}}</td>
                    <td>{{$find->ckmpengetahuan}}</td>
                    <td>{{$find->ckmketerampilan}}</td>
                    <td>{{$find->ckmsikap}}</td>
                    <td width="15%"><center><a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/hapus')}}/{{$find->id}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/manajemendatadasarnilai/edit')}}/{{$find->id}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                @endif

              @endif
            @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>No.</th>
                  <th>Nama Pelajaran</th>
                  <th>Jurusan Pelajaran</th>
                  <th>Golongan Kelas</th>
                  <th>KKM</th>
                  <th>CKM Pengetahuan</th>
                  <th>CKM Keterampilan</th>
                  <th>CKM Sikap</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <button id="adding" type="button" class="btn btn-success btn-flat" style="margin-top: 10px">Tambah Data</button>
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
              <h3 class="box-title">Tambah Data Dasar Nilai</h3>
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
            {{Form::open(array('role'=>'form','url'=>'/manajemenpelajaran/manajemendatadasarnilai/simpan'))}}
              <div class="box-body">
              
                <div class="form-group {{$errors->has('datapelajaran') ? 'has-error' : ''}}">                  
                    {{Form::label('datapelajaran','Nama Pelajaran',['class'=>'control-label'])}}                   
                     <select name="datapelajaran" id="katjurusan" class="form-control select2" style="width: 100%">
                      @foreach($valuepelajaran as $datapelajaran)
                        <option value="{{$datapelajaran -> id}}">{{$datapelajaran -> namapelajaran}}</option>
                      @endforeach
                  </select>
                    @if($errors->has('datapelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('datapelajaran')}}</strong>
                      </span>
                    @endif           
                </div>



                <div class="form-group{{$errors->has('jurusanpelajaran') ? 'has-error' : ''}}">
                {{Form::label('jurusanpelajaran','Jurusan Pelajaran',['class'=>'control-label'])}} 
                <div class="form-control">
                <label>
                  <input type="checkbox" class="minimal" name="jurusanpelajaran[]" value="IPA"> IPA
                </label>
                <label>
                  <input type="checkbox" class="minimal"  name="jurusanpelajaran[]" value="IPS"> IPS
                </label>
                <label>
                  <input type="checkbox" class="minimal"  name="jurusanpelajaran[]" value="Agama"> Agama
                  
                </label>
                </div>
                   @if($errors->has('jurusanpelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('jurusanpelajaran')}}</strong>
                      </span>
                    @endif   

              </div>



              <div class="form-group{{$errors->has('golongankelas') ? 'has-error' : ''}}">
                {{Form::label('golongankelas','Golongan Kelas',['class'=>'control-label'])}} 
                <div class="form-control">
                <label>
                  <input type="checkbox" class="minimal" name="golongankelas[]" value="X"> X
                </label>
                <label>
                  <input type="checkbox" class="minimal"  name="golongankelas[]" value="XI"> XI
                </label>
                <label>
                  <input type="checkbox" class="minimal"  name="golongankelas[]" value="XII"> XII
                  
                </label>
                </div>
                   @if($errors->has('golongankelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('golongankelas')}}</strong>
                      </span>
                    @endif   

              </div>
               

                <div class="form-group {{$errors->has('kkm') ? 'has-error' : ''}}">
                  {{Form::label('kkm','KKM')}}
                  {{Form::text('kkm','',['placeholder'=>'Masukkan KKM','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('kkm'))
                    <span class="help-block">
                      <strong>{{$errors->first('kkm')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmpengetahuan') ? 'has-error' : ''}}">
                  {{Form::label('ckmpengetahuan','CKM Pengetahuan')}}
                  {{Form::text('ckmpengetahuan','',['placeholder'=>'Masukkan CKM Pengetahuan','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('ckmpengetahuan'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmpengetahuan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmketerampilan') ? 'has-error' : ''}}">
                  {{Form::label('ckmketerampilan','CKM Keterampilan')}}
                  {{Form::text('ckmketerampilan','',['placeholder'=>'CKM Keterampilan','class'=>'form-control','id'=>'ckmketerampilan'])}}
                    @if($errors->has('ckmketerampilan'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmketerampilan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmsikap') ? 'has-error' : ''}}">
                  {{Form::label('ckmsikap','CKM Sikap')}}
                  {{Form::text('ckmsikap','',['placeholder'=>'Masukkan CKM Sikap','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('ckmsikap'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmsikap')}}</strong>
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
              <h3 class="box-title">Edit Data Dasar Nilai</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'/manajemenpelajaran/manajemendatadasarnilai/prosesedit'))}}
            {{Form::hidden('id',$revolution->id,['class'=>'form-control'])}}
              <div class="box-body">
              
     <div class="form-group {{$errors->has('datapelajaran') ? 'has-error' : ''}}">                  
                    {{Form::label('datapelajaran','Nama Pelajaran',['class'=>'control-label'])}}                   
                     <select name="datapelajaran" id="katjurusan" class="form-control select2">
                     
                        <option value="{{$revolution -> pelajaran -> id}}">{{$revolution -> pelajaran -> namapelajaran}}</option>
                   
                  </select>
                    @if($errors->has('datapelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('datapelajaran')}}</strong>
                      </span>
                    @endif           
                </div>


                 <div class="form-group {{$errors->has('jurusanpelajaran') ? 'has-error' : ''}}">                  
                    {{Form::label('jurusanpelajaran','Jurusan Pelajaran',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="jurusanpelajaran" class="flat-red" value="IPA" @if($revolution->jurusan == "IPA") checked @endif> IPA
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jurusanpelajaran" class="flat-red" value="IPS" @if($revolution->jurusan == "IPS") checked @endif> IPS
                    </label>
                     <label class="radio-inline">
                      <input type="radio" name="jurusanpelajaran" class="flat-red" value="Agama" @if($revolution->jurusan == "Agama") checked @endif> Agama
                    </label>
                    </div>  

                    @if($errors->has('jurusanpelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('jurusanpelajaran')}}</strong>
                      </span>
                    @endif           
                </div>

    
                <div class="form-group {{$errors->has('golongankelas') ? 'has-error' : ''}}">                  
                    {{Form::label('golongankelas','Golongan Kelas',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="X" @if($revolution->gol_kelas == "X") checked @endif> X
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XI" @if($revolution->gol_kelas == "XI") checked @endif> XI
                    </label>
                     <label class="radio-inline">
                      <input type="radio" name="golongankelas" class="flat-red" value="XII" @if($revolution->gol_kelas == "XII") checked @endif> XII
                    </label>
                    </div>  

                    @if($errors->has('golongankelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('golongankelas')}}</strong>
                      </span>
                    @endif           
                </div>
                     

                <div class="form-group {{$errors->has('kkm') ? 'has-error' : ''}}">
                  {{Form::label('kkm','KKM')}}
                  {{Form::text('kkm',$revolution->kkm,['placeholder'=>'Masukkan KKM','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('kkm'))
                    <span class="help-block">
                      <strong>{{$errors->first('kkm')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmpengetahuan') ? 'has-error' : ''}}">
                  {{Form::label('ckmpengetahuan','CKM Pengetahuan')}}
                  {{Form::text('ckmpengetahuan',$revolution->ckmpengetahuan,['placeholder'=>'Masukkan CKM Pengetahuan','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('ckmpengetahuan'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmpengetahuan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmketerampilan') ? 'has-error' : ''}}">
                  {{Form::label('ckmketerampilan','CKM Keterampilan')}}
                  {{Form::text('ckmketerampilan',$revolution->ckmketerampilan,['placeholder'=>'CKM Keterampilan','class'=>'form-control','id'=>'ckmketerampilan'])}}
                    @if($errors->has('ckmketerampilan'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmketerampilan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('ckmsikap') ? 'has-error' : ''}}">
                  {{Form::label('ckmsikap','CKM Sikap')}}
                  {{Form::text('ckmsikap',$revolution->ckmsikap,['placeholder'=>'Masukkan CKM Sikap','class'=>'form-control','id'=>'kkmkelasxii'])}}
                    @if($errors->has('ckmsikap'))
                    <span class="help-block">
                      <strong>{{$errors->first('ckmsikap')}}</strong>
                    </span>
                  @endif                 
                </div>               
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenpelajaran/manajemendatadasarnilai')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif

    </section>


    <!-- /.content -->
  </div>

  @endsection