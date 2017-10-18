@extends('template/headquarterswali')
@section('content')




<div class="content-wrapper">
  <section class="content-header">
    <h1>Analisis Kenaikan Kelas 
    </h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
  </section>


  <section class="content">
    

  <div class="row">
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Hasil Analisis Kenaikan Kelas : <b>{{Session::get('charkelas')}}</b></h3>

              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>

            </div>

     
            <div class="box-body">
           
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>NIS/NISN</th>
                  <th>Naik / Tinggal Kelas</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($data as $datas)             
                <tr>
                  <td><p @if($datas->kd_analisis == 1) style="color: red" @else style="color: green" @endif>{{$no++}}</p></td>
                  <td><p @if($datas->kd_analisis == 1) style="color: red" @else style="color: green" @endif>{{$datas->datasiswa->namasiswa}}</p></td>
                  <td><p @if($datas->kd_analisis == 1) style="color: red" @else style="color: green" @endif>{{$datas->datasiswa->nis}} / {{$datas->datasiswa->nisn}}</p></td>
                  <td>@if($datas->kd_analisis == 1)<p style="color: red">Tinggal Kelas</p> @else <p style="color:green">Naik Kelas</p> @endif</td>
                  <td><p @if($datas->kd_analisis == 1) style="color: red" @else style="color: green" @endif>{{$datas->keterangan}}</p></td>                       
                </tr>
                @endforeach
                </tbody>
                
              </table>
                <a href="{{URL('hasil/cetakraportuas/analisis')}}"><button type="button" class="btn btn-danger btn-flat">Analisa Ulang</button></a>
                <a href="{{URL('hasil/cetakraportuas')}}"><button type="button" class="btn btn-warning btn-flat">Kembali</button></a>
            </div>
          
          </div>
        </div>
      </div>


  </section>
</div>

@endsection