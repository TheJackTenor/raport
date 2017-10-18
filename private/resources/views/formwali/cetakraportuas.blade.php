@extends('template/headquarterswali')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Cetak Raport UAS
    <small><b>{{Session::get('charkelas')}}</b></small>
    </h1>
  </section>

  @php
    $pilihSemester = array('1/Ganjil','2/Genap');
  @endphp

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
                <label>Semester</label>
          
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-hourglass-end"></i>
                  </div>
                  <select id="pilihSemester" class="form-control">
                  @if(Session::get('pilihSemester'))
                    @php
                      $smstr = Session::get('pilihSemester');
                    @endphp
                  @else
                    @php
                      $smstr = $semesterNow->semester;
                    @endphp
                  @endif
                    @foreach($pilihSemester as $semester)
                      <option value="{{$semester}}" @if($smstr == $semester) selected="selected" @endif>{{$semester}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- /.input group -->
              </div>
             
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
                  <input type="text" class="form-control" value="{{Session::get('tanggal')}}" id="datepicker" onchange="simpanSetelanControl();">
                </div>
                <!-- /.input group -->
              </div>
            @if(Session::get('golongankelas') == 'X')
              

               <div class="form-group">
                <label>Tanggal Raport Halaman Depan</label>
          
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" value="{{Session::get('tanggal2')}}" id="datepicker2" onchange="simpanSetelanControl();">
                </div>
                <!-- /.input group -->
              </div>

              @endif

           <button class="btn btn-success btn-flat" onclick="mesos();" type="button" id="simpanSetelan">Simpan</button>
           <img src="{{URL::asset('/private/storage/app/loading.gif')}}" id="loading" style="max-width:30px;max-height:30px;display: none" />
           <img src="{{URL::asset('/private/storage/app/success.png')}}" id="success" style="max-width:30px;max-height:30px;display: none" />
            
            

           <div class="form-group" style="margin-top: 30px">
              {{Form::label('modekelas','Analisis Kenaikan Kelas',['class'=>'control-label'])}}
              <div class="form-control" @if($statusanalisis != 0) style="height: 150px" @else style="height: 60px" @endif>
               @if($statusanalisis != 0)<p style="color: green;text-align: center">Anda sudah melakukan analisis kenaikan kelas</p> <a href="{{URL('hasil/cetakraportuas/hasilanalisis')}}"><p style="color: red;text-align: center"><b>->LIHAT HASIL<-</b></p></a> <p style="text-align: center"> atau </p><a href="{{URL('hasil/cetakraportuas/analisis')}}"><p style="color: red;text-align: center"><b>->ANALISA ULANG<-</b></p></a> @else <p style="color: red">Anda belum melakukan analisis kenaikan kelas</p> <a href="{{URL('hasil/cetakraportuas/analisis')}}"><p style="color: red;text-align: center"><b>->ANALISA SEKARANG<-</b></p></a>@endif
               
              </div>
            </div>
                   
            </div>
         
           
          </div>
        </div>




        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Siswa</h3>
              
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
                  <td width="15%"><center><a href="{{URL('/hasil/cetakraportuas/cetak')}}/{{$data->id}}"><button class="btn btn-success btn-flat" id="cetakButton">Cetak</button></a></td>                
                </tr>
                @endforeach
                </tbody>
              </table>

            </div>
         
           
          </div>
        </div>
      </div>


  </section>
</div>

@if(Session::get('golongankelas') == "X")
<script type="text/javascript">
  function simpanSetelanControl(){
    if (document.getElementById('tempat').value == "" || document.getElementById('datepicker').value == "" || document.getElementById('datepicker2').value == "") {
      document.getElementById('simpanSetelan').disabled = true;
    }else{
      document.getElementById('simpanSetelan').disabled = false;
    }
  }
</script>

<script type="text/javascript">
  function mesos(){
$('#loading').show();
     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
      
      var pilihSemester = document.getElementById('pilihSemester').value;
      var tanggal = document.getElementById('datepicker').value;
      var tanggal2 = document.getElementById('datepicker2').value;
      var tempat = document.getElementById('tempat').value;     

      var dataString = "tanggal="+tanggal+"&tempat="+tempat+"&tanggal2="+tanggal2+"&pilihSemester="+pilihSemester;
      var alamat = "{{URL('cetakraportuasajax')}}";

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
@else
<script type="text/javascript">
  function mesos(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
      var pilihSemester = document.getElementById('pilihSemester').value;
      var tanggal = document.getElementById('datepicker').value;
      var tempat = document.getElementById('tempat').value;     

      var dataString = "tanggal="+tanggal+"&tempat="+tempat+"&pilihSemester="+pilihSemester;
      var alamat = "{{URL('cetakraportuasajax')}}";

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
@endif




@endsection