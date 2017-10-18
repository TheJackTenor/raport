@extends('template/headquarterswali')
@section('content')




<div class="content-wrapper">
  <section class="content-header">
    <h1>Manajemen Guru
    <small>Data Guru</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
  </section>


  <section class="content">
    

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Guru</h3>
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
                  <th>NoS</th>
                  <th>Nama Siswa</th>
                  <th>NIS/NISN</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody> 
                @php
                  $no = 0;
                @endphp
                @foreach($datasiswas as $data)  
                @php
                  $no++;
                @endphp           
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$data->nip}} / {{$data->nisn}}</td>
                  <td>{{$data->namasiswa}}</td>
                  <td width="15%"><center><a href="/sisfo/manajemenguru/dataguru/hapus/{{$data->id}}/{{$data->foto}}"><button class="btn btn-danger btn-flat">Hapus</button></a> <a href="/sisfo/manajemenguru/dataguru/edit/{{$data->id}}/{{$data->foto}}"><button class="btn btn-warning btn-flat">Edit</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>No</th>
                  <th>Nama Siswa</th>
                  <th>NIS/NISN</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <button id="adding" type="button" class="btn btn-success">Tambah Data</button>
            </div>
            @endif
           
          </div>
        </div>
      </div>


  </section>
</div>


@endsection