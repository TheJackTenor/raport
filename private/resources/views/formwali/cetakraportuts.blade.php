@extends('template/headquarterswali')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Cetak Raport UTS
    <small><b>{{Session::get('charkelas')}}</b></small>
    </h1>
  </section>


  <section class="content">
    

  <div class="row">
      <div class="col-md-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Setelan</h3>
 
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>
   
            </div>


     
            <div class="box-body">        
              <div class="form-group">
                <label>Lokasi</label>
          
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map"></i>
                  </div>
                  <input type="text" class="form-control" value="{{Session::get('tempat')}}" id="tempat" placeholder="Contoh : Yogyakarta, Sleman , dll" oninput="simpanSetelanControl();">
                </div>
                <!-- /.input group -->
              </div>

               <div class="form-group">
                <label>Tanggal Raport</label>
          
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="{{Session::get('tanggal')}}" class="form-control" id="datepicker" onchange="simpanSetelanControl();">
                </div>
                <!-- /.input group -->
              </div>

    
           <button class="btn btn-success btn-flat" onclick="mesos();" type="button" id="simpanSetelan">Simpan</button>
           <img src="{{URL::asset('/private/storage/app/loading.gif')}}" id="loading" style="max-width:30px;max-height:30px;display: none" />
           <img src="{{URL::asset('/private/storage/app/success.png')}}" id="success" style="max-width:30px;max-height:30px;display: none" />
        
            </div>
         
           
          </div>
        </div>


        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Siswa</h3>
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
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>NIS/NISN</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach($datasiswas as $data)             
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$data->namasiswa}}</td>
                  <td>{{$data->nis}} / {{$data->nisn}}</td>          
                  <td width="15%"><center><a href="{{URL('/hasil/cetakraportuts/show/stream')}}/{{$data->id}}"><button class="btn btn-success btn-flat btn-xs">Cetak</button></a>
                  <a href="{{URL('/hasil/cetakraportuts/show/download')}}/{{$data->id}}"><button class="btn btn-warning btn-flat btn-xs">Unduh</button></a></center></td>                
                </tr>
                @endforeach
                </tbody>
                
              </table>
            </div>
            @endif
           
          </div>
        </div>
      </div>


  </section>
</div>

<script type="text/javascript">
  function simpanSetelanControl(){
    if (document.getElementById('tempat').value == "" || document.getElementById('datepicker').value == "") {
      document.getElementById('simpanSetelan').disabled = true;
    }else{
      document.getElementById('simpanSetelan').disabled = false;
    }
  }
</script>

<script type="text/javascript">
  function mesos(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var tanggal = document.getElementById('datepicker').value; 
      var tempat = document.getElementById('tempat').value;     

      var dataString = "tanggal="+tanggal+"&tempat="+tempat;
      var alamat = "{{URL('cetakraportutsajax')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(html){
              $('#loading').append(html);
            },
            complete: function(){
              $('#loading').hide();
              $('#success').show();
              $(document).ready(function(){window.setTimeout(function() {
              $('#success').hide();}, 2000);
            });
              

            }
            
        }); 

}
</script>


@endsection