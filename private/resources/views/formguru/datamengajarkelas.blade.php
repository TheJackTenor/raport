@extends('template/headquartersguru')
  @section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manajemen Guru
        <small>Data mengajar Kelas</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Mengajar Kelas</h3>
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
                  <th>Nama Guru</th>
                  <th>Mengajar di Kelas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                $memory="";
                $memoryid="";
                $counter="0"
                @endphp
                @foreach($datamengajarkelasjoin as $data3)
                  @foreach($data3->mengajarkelas as $ajar)
                  @if($counter=="1")
                    @if($data3->namaguru == $memory)
                    , {{$ajar->namakelas}}
                    @elseif($data3->namaguru !== $memory)
                      <td width="15%"><center><a href="{{URL('/manajemenguru/guru/datamengajarkelas/hapus')}}/{{$memoryid}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenguru/guru/datamengajarkelas/edit')}}/{{$memoryid}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                    @endif
                  @endif               
                  @if($data3->namaguru !== $memory)
                <tr>
                   <td>{{$data3->namaguru}}</td>
                  <td>{{$ajar->namakelas}}
                  @endif
                   @php
                    $memory=$data3->namaguru;
                    $memoryid=$data3->id;
                    $counter="1";
                  @endphp
                  @endforeach
                @endforeach
                @if($memoryid!=="")
                <td width="15%"><center><a href="{{URL('/manajemenguru/guru/datamengajarkelas/hapus')}}/{{$memoryid}}"><button class="btn btn-danger btn-flat btn-xs">Hapus</button></a> <a href="{{URL('/manajemenguru/guru/datamengajarkelas/edit')}}/{{$memoryid}}"><button class="btn btn-warning btn-flat btn-xs">Edit</button></a></center></td>
                @endif
                </tbody>
                <tfoot>
                <tr>
                   <th>Nama Guru</th>
                  <th>Mengajar di Kelas</th>
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
              <h3 class="box-title">Tambah Data Mengajar Kelas</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">
              
            <button id="coll" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
          @endif
            </div>

            @if($errors->has('id_guru'))
             <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                {{$errors->first('id_guru')}}
              </div>

              @endif
            <!-- /.box-header -->
            <!-- form start {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}} -->
            @if(Session::has('status'))
              @else
            {{Form::open(array('role'=>'form','url'=>'/manajemenguru/guru/datamengajarkelas/prosestambahdatamengajarkelas'))}}
              <div class="box-body">
              
               {{Form::hidden('id_guru',Auth::user('id_guru'))}}



                 <div class="form-group {{$errors->has('pilihkelas') ? 'has-error' : ''}}">
                <label>Pilih Kelas</label>
                <select name="pilihkelas[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Kelas" style="width: 100%;">
                @foreach($datakelas as $data2)
                  <option value="{{$data2 -> id}}">{{$data2 -> namakelas}}</option>
                @endforeach
                </select>
                 @if($errors->has('pilihkelas'))
                      <span class="help-block">
                        <strong>{{$errors->first('pilihkelas')}}</strong>
                      </span>
                    @endif   
              </div>

                

              <!-- /.box-body -->

              <div class="box-footer">
               
                 {{Form::close()}}   
              </div>
               <button type="submit" class="btn btn-success btn-flat">Simpan</button>
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
              <h3 class="box-title">Edit Data Mengajar Kelas</h3>
              
              <div class="box-tools pull-right">
              
            <button id="editbox" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              </button>
            
          </div>
          
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            {{Form::open(array('role'=>'form','url'=>'/manajemenguru/guru/datamengajarkelas/proseseditdatamengajarkelas'))}}
            {{Form::hidden('id',$revolution2->id,['class'=>'form-control'])}}
              <div class="box-body">
              
                <div class="form-group {{ $errors->has('pilihguru') ? 'has-error' : ''}}"> 
                {{Form::label('pilihguru','Pilih Guru',['class'=>'control-label'])}}                    
                <select id="pilihguru" name="pilihguru" class="form-control select2" style="width: 100%;" disabled="disabled">                 
                  <option>{{$revolution2 -> nip}} - {{$revolution2 -> namaguru}}</option>

                </select>
                  @if($errors->has('pilihguru'))
                    <span class="help-block">
                      <strong>{{$errors->first('pilihguru')}}</strong>
                    </span>
                  @endif                 
                </div> 

                @php
                $counter="0"
                @endphp            
                @foreach($revolution2->mengajarkelas as $data2)
                  @php
                    $counter++
                  @endphp
                @endforeach

                 <div class="form-group {{$errors->has('pilihpelajaran') ? 'has-error' : ''}}">
                <label>Pilih Kelas</label>
                <select name="pilihkelas[]" id="katjurusan" class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                @foreach($revolution3 as $data3)
                  @php
                    $memory="0";
                    $memory2="0";
                  @endphp
                  @foreach($revolution2->mengajarkelas as $data2)
                    @php
                      $memory++
                    @endphp
                    @if($data3->id == $data2->id)
                       <option value="{{$data3 -> id}}" selected="selected">{{$data3 -> namakelas}}</option>
                       @php
                        $memory2="1"
                       @endphp
                    @elseif($data3->id !== $data2->id)
                      @if($memory == $counter and $memory2=="0")
                        <option value="{{$data3 -> id}}">{{$data3 -> namakelas}}</option>
                      @endif
                    @endif
                  @endforeach  
                @endforeach
                </select>
                 @if($errors->has('pilihpelajaran'))
                      <span class="help-block">
                        <strong>{{$errors->first('pilihpelajaran')}}</strong>
                      </span>
                    @endif   
              </div>

              <!-- /.box-body -->

              <div class="box-footer">        
              </div>
           <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}
                 <a href="{{URL::asset('/manajemenguru/guru/datamengajarkelas')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>      
          </div>
          </div>
          </div>
@endif

    </section>


    <!-- /.content -->
  </div>

  @endsection