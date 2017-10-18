@extends('headquarters')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Manajemen Karyawan <small>Data BK</small></h1>

		<ol class="breadcrumb">
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelas BK</h3>
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
                  <th width="5%">No</th>
                  <th>Nama BK</th>
                  <th>Kelas</th>             
                  <th width="10%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $temp = "";
                  $no = 0;
                  $buttonToggle = false;
                @endphp

                @foreach($data as $datas => $value)

                @if($value->id_karyawan != $temp)
                  @if($buttonToggle == true)
                    <td><a href="{{URL('manajemenkaryawan/datakelasbk/hapus')}}/{{$temp}}"><button type="button" class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('manajemenkaryawan/datakelasbk/edit/')}}/{{$temp}}"><button type="button" class="btn btn-warning btn-flat btn-xs">Edit</button></a></td>
                  @endif

                  @php
                    $temp = $value->id_karyawan;
                    $no++;
                    $buttonToggle = true;
                  @endphp
                  <tr>
                  <td>{{$no}}</td>
                  <td>{{$value->namakaryawan}}</td>
                  <td>{{$value->namakelas}}

                @elseif($value->id_karyawan == $temp)
                  , {{$value->namakelas}}
                @endif
                @endforeach

                @if($data != "[]")
                <td><a href="{{URL('manajemenkaryawan/datakelasbk/hapus/')}}/{{$temp}}"><button type="button" class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('manajemenkaryawan/datakelasbk/edit/')}}/{{$temp}}"><button type="button" class="btn btn-warning btn-flat btn-xs">Edit</button></a></td>
                @endif
                <tfoot>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama BK</th>
                  <th>Kelas</th>             
                  <th width="10%">Aksi</th>
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
            {{Form::open(array('role'=>'form','url'=>'manajemenkaryawan/datakelasbk/simpan','enctype'=>'multipart/form-data'))}}
              <div class="box-body">

              <div class="form-group {{$errors->has('pilihbk') ? 'has-error' : ''}}">
                {{Form::label('pilihbk','Pilih BK',['class'=>'control-label'])}}
                <select class="form-control select2" name="pilihbk" style="width: 100%" aria-hidden="true">
                @foreach($databk as $dataBK)
                  <option value="{{$dataBK->id}}" @if($dataBK->status == "1") disabled="disabled" @endif>{{$dataBK->namakaryawan}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group {{$errors->has('pilihkelas') ? 'has-error' : ''}}">
                {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label'])}}
                <select class="form-control select2" multiple="multiple" name="pilihkelas[]" style="width: 100%">
                @foreach($dataKelas as $datakelas)
                  @php
                    $i = false;
                  @endphp
                  @foreach($dataKelasExist as $exist)
                    @if($i == false)
                      @if($datakelas->id == $exist->id_kelas)
                       @php
                          $i = true;
                       @endphp
                      @endif
                    @endif
                  @endforeach
                  <option value="{{$datakelas->id}}" @if($i == true) disabled="disabled" @endif>{{$datakelas->namakelas}}</option>
                @endforeach
                </select>
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

            {{Form::open(array('role'=>'form','url'=>'manajemenkaryawan/datakelasbk/edit/simpan','enctype'=>'multipart/form-data'))}}
            {{Form::hidden('id',$dataBk->id,['class'=>'form-control'])}}
              <div class="box-body">
              
              <div class="form-group"> 
                {{Form::label('namabk','Nama BK',['class'=>'control-label'])}}                    
                <select class="form-control select2" name="pilihbk" style="width: 100%" aria-hidden="true" disabled="disabled">
                  <option value="{{$dataBk->id}}">{{$dataBk->namakaryawan}}</option>
                </select>          
              </div>

              <div class="form-group {{$errors->has('pilihkelas') ? 'has-error' : ''}}">
                {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label'])}}
                <select class="form-control select2" multiple="multiple" name="pilihkelas[]" style="width: 100%">
                @foreach($dataKelas as $datakelas)

                  @php
                    $toggleUsed = false;
                  @endphp

                  @foreach($dataKelasUsed as $datakelasused)
                    @if($datakelasused->id == $datakelas->id)
                      @php
                        $toggleUsed = true;
                      @endphp
                    @endif                
                  @endforeach

                  @if($toggleUsed == false)
                    @php
                      $toggleChoosen = false;
                    @endphp

                    @foreach($dataKelasChoosen as $datakelaschoosen)
                      @if($datakelaschoosen->id == $datakelas->id)
                        @php
                          $toggleChoosen = true;
                        @endphp
                      @endif
                    @endforeach

                    @if($toggleChoosen == false)
                      <option value="{{$datakelas->id}}">{{$datakelas->namakelas}}</option>
                    @elseif($toggleChoosen == true)
                      <option value="{{$datakelas->id}}" selected="selected">{{$datakelas->namakelas}}</option>
                    @endif

                  @endif

                @endforeach

                </select>
              </div>
        
                

                     

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}  
                 <a href="{{URL::asset('/manajemenkaryawan/datakelasbk')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>           
              </div>
           
          </div>
          </div>
          </div>
@endif




	</section>
</div>


@endsection