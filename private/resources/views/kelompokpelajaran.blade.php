@extends('headquarters')
@section('content')




<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Pelajaran
		<small>KELOMPOK PELAJARAN</small>
		</h1>
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelompok Pelajaran</h3>
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
              <table class="table table-bordered differentTable">
                <thead>
                <tr>
                  <th rowspan="2" class="active">No</th>
                  <th rowspan="2" class="active">Jenjang</th>
                  <th rowspan="2" class="active">Jurusan</th>
                  <th rowspan="2" class="info">Kelompok A</th>
                  <th rowspan="2" class="active">Kelompok B</th>
                  <th colspan="2" style="text-align: center;" class="info">Kelompok C</th>
                  <th rowspan="2" class="active"> Aksi</th>             
                </tr>

                <tr>
                  <th class="info">Peminatan</th>
                  <th class="info">Pendalaman Minat</th>
                  
                </tr>
                </thead>
                <tbody>
                @php
                  $cjenjang = "";
                  $cjurusan = "";
                  $cntjenjang = 0;
                  $cntjurusan = 0;
                  $catchrow = 0;
                  $pluk = 0;
                  $looper = 0;
                @endphp

                @foreach($datatabel as $count)          
                  @if($cjenjang == $count -> jenjang)
                    @if($cjurusan != $count -> jurusan)
                      @php
                        $catchrow++;
                        $catchrowarray[$cntjenjang] = $catchrow;
                        $cjurusan = $count -> jurusan;
                      @endphp
                    @endif
                  @else
                    @php
                      $catchrow = 1;
                      $cntjenjang++;
                      $catchrowarray[$cntjenjang] = $catchrow;
                      $cjenjang = $count -> jenjang;
                      $cjurusan = $count -> jurusan;
                    @endphp
                  @endif
                  @php
                    $looper++;
                  @endphp                
                @endforeach



                @php
                  $no = 0;
                  $countjenjang = 0;
                  $toggle = 0;
                  $tempjurusan = "";
                  $tempjenjang = "";
                  $tempkelompok="";
                  $brenk = 0;
                  $looper2 = 0;
                @endphp
                @foreach($datatabel as $tabel)
                  @php
                    $looper2++;
                  @endphp
                  @if($tempjenjang != $tabel->jenjang)
                   @if($brenk == 1)
                        @for($s=$tempkelompok+1;$s<=4;$s++)
                        <td class="danger"></td>
                        @endfor
                        <td class="warning"><center><a href="{{URL('/manajemenpelajaran/kelompokpelajaran/hapus')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/kelompokpelajaran/edit')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                      @endif
                  <tr>
                    @php
                     $no++;
                      $countjenjang++;
                      $catchrowarray[$countjenjang]++;
                      $brenk = 0;
                    @endphp

                    
                    <td rowspan="{{$catchrowarray[$countjenjang]}}" class="warning">{{$no}}</td>
                    <td rowspan="{{$catchrowarray[$countjenjang]}}" class="warning">{{$tabel->jenjang}}</td>

                     @php
                      $tempjenjang = $tabel->jenjang;
                    @endphp
                  </tr>
                  @endif

                  @if($tempjurusan != $tabel->jurusan)
                    @if($toggle == 1)
                      @if($brenk == 1)
                        @for($s=$tempkelompok+1;$s<=4;$s++)
                        <td class="danger"></td>
                        @endfor
                        <td class="warning"><center><a href="{{URL('/manajemenpelajaran/kelompokpelajaran/hapus')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/kelompokpelajaran/edit')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                      @endif 

                      </tr>
                    @endif
                   <tr>              
                    <td class="warning">{{$tabel->jurusan}}</td>
                   @php
                      $tempjurusan = $tabel->jurusan;
                      $tempkelompok ="";
                    @endphp
                  @endif

                  @php
                    $toggle =1;
                    $brenk = 1;
                  
                  @endphp


                  @if($tabel -> kelompok != $tempkelompok && $tabel -> kelompok !=5)
                    <td class="success">
                    @php
                      $tempkelompok = $tabel -> kelompok;
                    @endphp
                  @elseif($tabel -> kelompok == $tempkelompok && $tabel -> kelompok !=5)
                  , 
                  @endif

                  @if($tabel -> kelompok !=5)
                    {{$tabel -> datapelajaran -> namapelajaran}}
                  @endif
                  @if($looper == $looper2)
                     @for($s=$tempkelompok+1;$s<=4;$s++)
                        <td class="danger"></td>
                        @endfor
                         <td class="warning"><center><a href="{{URL('/manajemenpelajaran/kelompokpelajaran/hapus')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenpelajaran/kelompokpelajaran/edit')}}/{{$tempjenjang}}/{{$tempjurusan}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                  @endif
                
                @endforeach
                  
               
                </tbody>
               
              </table>
              <button id="adding" type="button" class="btn btn-success btn-flat" style="margin-top: 10px">Tambah Data</button>
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
              <h3 class="box-title">Tambah Data Kelompok Pelajaran</h3>
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
            {{Form::open(array('role'=>'form','url'=>'manajemenpelajaran/kelompokpelajaran/simpan','enctype'=>'multipart/form-data'))}}
              <div class="box-body">

               <div class="form-group {{$errors->has('kelompok') ? 'has-error' : ''}}">                  
                    {{Form::label('kelompok','Pilih Kelompok',['class'=>'control-label'])}}                   
                     <select name="kelompok" id="katjurusan" class="form-control">
                    <option value="1">Kelompok A (UMUM)</option>
                    <option value="2">Kelompok B (UMUM)</option>
                    <option value="3">Kelompok C (PEMINATAN)</option>
                    <option value="4">Kelompok C (LINTAS MINAT)</option>
                  </select>
                    @if($errors->has('kelompok'))
                      <span class="help-block">
                        <strong>{{$errors->first('kelompok')}}</strong>
                      </span>
                    @endif           
                </div>

               <div class="form-group {{$errors->has('jenjang') ? 'has-error' : ''}}">                  
                    {{Form::label('jenjang','Pilih Jenjang',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="jenjang" class="flat-red" value="X"> X
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jenjang" class="flat-red" value="XI"> XI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jenjang" class="flat-red" value="XII"> XII
                    </label>
                    </div>  

                    @if($errors->has('jenjang'))
                      <span class="help-block">
                        <strong>{{$errors->first('jenjang')}}</strong>
                      </span>
                    @endif           
                </div>

                 <div class="form-group {{$errors->has('jurusan') ? 'has-error' : ''}}">                  
                    {{Form::label('jurusan','Pilih Jurusan',['class'=>'control-label'])}} 
                    <div class="form-control" style="padding-left: 0px;">               
                    <label class="radio-inline">
                      <input type="radio" name="jurusan" class="flat-red" value="IPA"> IPA
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jurusan" class="flat-red" value="IPS"> IPS
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jurusan" class="flat-red" value="Agama"> Agama
                    </label>
                    </div>  

                    @if($errors->has('jurusan'))
                      <span class="help-block">
                        <strong>{{$errors->first('jurusan')}}</strong>
                      </span>
                    @endif           
                </div>
              
               <div class="form-group {{$errors->has('pilihpelajaran') ? 'has-error' : ''}}">
                <label>Pilih Pelajaran</label>
                <select name="pilihpelajaran[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih pelajaran" style="width: 100%;">
                @foreach($datapelajaran as $data2)
                  <option value="{{$data2 -> id}}">{{$data2 -> namapelajaran}}</option>
                @endforeach
                </select>
                 @if($errors->has('pilihpelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('pilihpelajaran')}}</strong>
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
              <h3 class="box-title">Edit Data Kelompok Pelajaran</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'manajemenpelajaran/kelompokpelajaran/prosesedit','enctype'=>'multipart/form-data'))}}
          
              <div class="box-body">
              
                <div class="form-group"> 
                {{Form::label('jenjang','Jenjang',['class'=>'control-label'])}}                    
                {{Form::text('jenjang',$primary2->jenjang,['class'=>'form-control','readonly'=>'readonly'])}}         
                </div>

                <div class="form-group">                  
                  {{Form::label('jurusan','Jurusan',['class'=>'control-label'])}}                   
                  {{Form::text('jurusan',$primary2->jurusan,['class'=>'form-control','readonly'=>'readonly'])}}          
                </div>

                 @php
                    $final=0;
                  @endphp
                @foreach($primary as $utama)
                  @php
                    $final++;
                  @endphp
                @endforeach


                <div class="form-group {{$errors->has('kelompoka') ? 'has-error' : ''}}">
                <label>Kelompok A</label>
                <select name="kelompoka[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih pelajaran" style="width: 100%;">            

                @foreach($secondary as $kedua)
                  @php
                    $toggle=0;
                    $final2=0;
                  @endphp
                  @foreach($primary as $utama)
                    
                    @php
                      $final2++;
                    @endphp

                    @if($kedua -> id == $utama->id_pelajaran && $utama->kelompok == 1)
                      <option value="{{$kedua -> id}}" selected="selected">{{$kedua -> namapelajaran}}</option>
                      @php
                        $toggle = 1;
                      @endphp

                    @elseif($toggle == 0 && $final == $final2)
                      <option value="{{$kedua -> id}}">{{$kedua -> namapelajaran}}</option>
                    @endif

                  @endforeach
                @endforeach
                </select>
                 @if($errors->has('kelompoka'))
                      <span class="help-block">
                        <strong>{{$errors->first('kelompoka')}}</strong>
                      </span>
                    @endif   
              </div>

              <div class="form-group {{$errors->has('kelompokb') ? 'has-error' : ''}}">
                <label>Kelompok B</label>
                <select name="kelompokb[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih pelajaran" style="width: 100%;">            

                @foreach($secondary as $kedua)
                  @php
                    $toggle=0;
                    $final2=0;
                  @endphp
                  @foreach($primary as $utama)
                    
                    @php
                      $final2++;
                    @endphp

                    @if($kedua -> id == $utama->id_pelajaran && $utama->kelompok == 2)
                      <option value="{{$kedua -> id}}" selected="selected">{{$kedua -> namapelajaran}}</option>
                      @php
                        $toggle = 1;
                      @endphp

                    @elseif($toggle == 0 && $final == $final2)
                      <option value="{{$kedua -> id}}">{{$kedua -> namapelajaran}}</option>
                    @endif

                  @endforeach
                @endforeach
                </select>
                 @if($errors->has('kelompokb'))
                      <span class="help-block">
                        <strong>{{$errors->first('kelompokb')}}</strong>
                      </span>
                    @endif   
              </div>


              <div class="form-group {{$errors->has('kelompokcp') ? 'has-error' : ''}}">
                <label>Kelompok C (Permintaan)</label>
                <select name="kelompokcp[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih pelajaran" style="width: 100%;">            

                @foreach($secondary as $kedua)
                  @php
                    $toggle=0;
                    $final2=0;
                  @endphp
                  @foreach($primary as $utama)
                    
                    @php
                      $final2++;
                    @endphp

                    @if($kedua -> id == $utama->id_pelajaran && $utama->kelompok == 3)
                      <option value="{{$kedua -> id}}" selected="selected">{{$kedua -> namapelajaran}}</option>
                      @php
                        $toggle = 1;
                      @endphp

                    @elseif($toggle == 0 && $final == $final2)
                      <option value="{{$kedua -> id}}">{{$kedua -> namapelajaran}}</option>
                    @endif

                  @endforeach
                @endforeach
                </select>
                 @if($errors->has('kelompokcp'))
                      <span class="help-block">
                        <strong>{{$errors->first('kelompokcp')}}</strong>
                      </span>
                    @endif   
              </div>


              <div class="form-group {{$errors->has('kelompokcl') ? 'has-error' : ''}}">
                <label>Kelompok C (Lintas Minat)</label>
                <select name="kelompokcl[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih pelajaran" style="width: 100%;">            

                @foreach($secondary as $kedua)
                  @php
                    $toggle=0;
                    $final2=0;
                  @endphp
                  @foreach($primary as $utama)
                    
                    @php
                      $final2++;
                    @endphp

                    @if($kedua -> id == $utama->id_pelajaran && $utama->kelompok == 4)
                      <option value="{{$kedua -> id}}" selected="selected">{{$kedua -> namapelajaran}}</option>
                      @php
                        $toggle = 1;
                      @endphp

                    @elseif($toggle == 0 && $final == $final2)
                      <option value="{{$kedua -> id}}">{{$kedua -> namapelajaran}}</option>
                    @endif

                  @endforeach
                @endforeach
                </select>
                 @if($errors->has('kelompokcl'))
                      <span class="help-block">
                        <strong>{{$errors->first('kelompokcl')}}</strong>
                      </span>
                    @endif   
              </div>
                     
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenpelajaran/kelompokpelajaran')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif




	</section>
</div>


@endsection