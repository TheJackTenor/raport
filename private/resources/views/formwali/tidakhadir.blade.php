@extends('template/headquarterswali')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Identitas
		<small><b>DAFTAR HADIR & EKSUL</b></small>
		</h1>
	</section>

	<section class="content">
		
  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><small>Kelas : </small>{{Session::get('charkelas')}} | <small>Semester : </small>{{Session::get('semester')}} | <small>Tahun ajaran : </small>{{Session::get('tahunajaran')}}</h3>
             
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#uploadExcelDataRapot" id="openModal">Upload Excel</button>            
              <a href="{{URL('layout/tidakhadir')}}"><button type="button" class="btn btn-success btn-flat btn-xs">Unduh Excel Layout Nilai</button></a>         
          </div>
   
            </div>

            <div class="box-body" >
            @if(Session::has('message'))
            <div @if(!Session::has('error')) class="alert alert-success alert-dismissible" @else class="alert alert-danger alert-dismissible" @endif>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4> @if(!Session::has('error')) <i class="icon fa fa-check"></i> Sukses! @else <i class="icon fa fa-warning"></i> Kesalahan! @endif</h4>
                {{Session::get('message')}}
              </div>
            @endif
            <div class="table-responsive" >
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="success" rowspan="2" style="text-align: center;">NO</th>
                  <th class="success" rowspan="2" style="text-align: center">NAMA</th>
                  <th class="success" rowspan="2" style="text-align: center;width: 200px">NOMOR INDUK/NISN</th>
                  <th class="info" colspan="3" style="text-align: center">KETIDAK HADIRAN</th>
                  <th class="info" colspan="9" style="text-align: center">EKSTRAKULIKULER</th>
                  <th class="info" colspan="7" style="text-align: center">PRESTASI</th>
                </tr>

                <tr>
                 <th class="success" style="text-align: center;">SAKIT</th>
                 <th class="success" style="text-align: center;">IJIN</th>
                 <th class="success" style="text-align: center;">ALPHA</th>

                 <th class="danger" style="text-align: center;">EKSUL 1</th>
                 <th class="danger" style="text-align: center;">NILAI</th>
                 <th class="danger" style="text-align: center;">KETERANGAN</th>

                 <th class="success" style="text-align: center;">EKSUL 2</th>
                 <th class="success" style="text-align: center;">NILAI</th>
                 <th class="success" style="text-align: center;">KETERANGAN</th>

                 <th class="danger" style="text-align: center;">EKSUL 3</th>
                 <th class="danger" style="text-align: center;">NILAI</th>
                 <th class="danger" style="text-align: center;">KETERANGAN</th>

                 <th class="success" style="text-align: center;">PRESTASI 1</th>
                 <th class="success" style="text-align: center;">KETERANGAN</th>

                 <th class="danger" style="text-align: center;">PRESTASI 2</th>
                 <th class="danger" style="text-align: center;">KETERANGAN</th>

                 <th class="success" style="text-align: center;">PRESTASI 3</th>
                 <th class="success" style="text-align: center;">KETERANGAN</th>
                 <th class="danger" style="text-align: center;">CATATAN WALI KELAS</th>

                </tr>

                {{Form::open(array('role'=>'form','url'=>'identitas/daftarhadir&eksul/simpan','enctype'=>'multipart/form-data'))}}
                @php
                $no = 0;
                @endphp

                  @foreach($datasiswa as $siswa)
                    @php
                      $no++;
                      $toggle = 0;
                    @endphp
                    {{Form::hidden('idsiswa'.$no,$siswa->id,['class'=>'form-control'])}}
                    {{Form::hidden('forloop',$no,['class'=>'form-control'])}}
                    <tr>
                      <td class="warning"><p style="margin-top: 18px">{{$no}}</p></td>
                      <td class="warning"><p style="width: 200px;margin-top: 18px">{{$siswa->namasiswa}}</p></td>
                      <td class="warning"><p style="width: 50px">{{$siswa->nis}} / {{$siswa->nisn}}</p></td>

                      @foreach($content as $konten)
                        @if($konten->id_siswa == $siswa->id)
                          @php
                            $toggle = 1;
                          @endphp
                          <td><input type="text" id="sakit{{$no}}" class="form-control" value="{{$konten->sakit}}" name="sakit{{$no}}" style="width: 45px;margin-top: 10px"></td>
                          <td><input type="text" id="ijin{{$no}}" class="form-control" value="{{$konten->ijin}}" name="ijin{{$no}}" style="width: 45px;margin-top: 10px"></td>
                          <td><input type="text" id="alpha{{$no}}" class="form-control" value="{{$konten->alpha}}" name="alpha{{$no}}" style="width: 45px;margin-top: 10px"></td>

                          <td><input type="text" class="form-control" value="{{$konten->eskul1}}" name="eskul1{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai1{{$no}}" class="form-control" value="{{$konten->nilaieskul1}}" name="nilai1{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan1{{$no}}" style="width: 200px">{{$konten->keteranganeskul1}}</textarea> </td>

                          <td><input type="text" class="form-control" value="{{$konten->eskul2}}" name="eskul2{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai2{{$no}}" class="form-control" value="{{$konten->nilaieskul2}}" name="nilai2{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan2{{$no}}" style="width: 200px">{{$konten->keteranganeskul2}}</textarea> </td>

                          <td><input type="text" class="form-control" value="{{$konten->eskul3}}" name="eskul3{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai3{{$no}}" class="form-control" value="{{$konten->nilaieskul3}}" name="nilai3{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan3{{$no}}" style="width: 200px">{{$konten->keteranganeskul3}}</textarea> </td>

                          <td><input type="text" class="form-control" value="{{$konten->prestasi1}}" name="prestasi1{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres1{{$no}}" style="width: 200px">{{$konten->keteranganprestasi1}}</textarea> </td>

                          <td><input type="text" class="form-control" value="{{$konten->prestasi2}}" name="prestasi2{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres2{{$no}}" style="width: 200px">{{$konten->keteranganprestasi2}}</textarea> </td>

                          <td><input type="text" class="form-control" value="{{$konten->prestasi3}}" name="prestasi3{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres3{{$no}}" style="width: 200px">{{$konten->keteranganprestasi3}}</textarea> </td>

                          <td><textarea class="form-control" name="catatan{{$no}}" style="width: 200px">{{$konten->catatan}}</textarea> </td>
                      </tr>
                      @endif
                      @endforeach

                      @if($toggle == 0)
                        <td><input type="text" id="sakit{{$no}}" class="form-control" name="sakit{{$no}}" style="width: 45px;margin-top: 10px"></td>
                        <td><input type="text" id="ijin{{$no}}" class="form-control" name="ijin{{$no}}" style="width: 45px;margin-top: 10px"></td>
                        <td><input type="text" id="alpha{{$no}}" class="form-control" name="alpha{{$no}}" style="width: 45px;margin-top: 10px"></td>

                        <td><input type="text" class="form-control" name="eskul1{{$no}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai1{{$no}}" class="form-control" name="nilai1{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan1{{$no}}" style="width: 200px"></textarea> </td>

                        <td><input type="text" class="form-control" name="eskul2{{$no}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai2{{$no}}" class="form-control" name="nilai2{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan2{{$no}}" style="width: 200px"></textarea> </td>

                        <td><input type="text" class="form-control" name="eskul3{{$no}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai3{{$no}}" class="form-control" name="nilai3{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan3{{$no}}" style="width: 200px"></textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi1{{$no}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres1{{$no}}" style="width: 200px"></textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi2{{$no}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres2{{$no}}" style="width: 200px"></textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi3{{$no}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres3{{$no}}" style="width: 200px"></textarea> </td>

                        <td><textarea class="form-control" name="catatan{{$no}}" style="width: 200px"></textarea> </td>
                      </tr>
                      @endif
                  @endforeach                
                </thead>              
              </table>       
              </div>
              <button type="submit" class="btn btn-success btn-flat" style="margin-top: 10px">Simpan</button>
                {{Form::close()}}
      
            </div>
     
           
          </div>
        </div>
      </div>
	</section>
</div>

<!--========================================= MODAL UNTUK UPLOAD EXCEL DATA RAPOT ==============================================-->
 <div class="example-modal" >
        <div class="modal fade modal modal-default" id="uploadExcelDataRapot" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Excel</h4>
              </div>
              <div class="modal-body">

              <div style="display: none" id="loading">
                <h3 style="text-align: center;">Sedang memuat. Silahkan tunggu</h3><h3 id="wait" style="text-align: center;"></h3>
              </div>
                 {{Form::open(array('role'=>'form','url'=>'identitas/daftarhadir&eksul/import','enctype'=>'multipart/form-data'))}}             
                  <div class="form-group {{$errors->has('file') ? 'has-error' : Session::has('error') ? 'has-error' : ''}}">  
                  {{Form::label('file','Unggah File Excel',['id' => 'filelabel'])}}
                                             
                  <input type="file" id="file" name="file" class="validate"/ >
                  <p class="help-block" id="keterangan">Ekstensi file yang diizinan : xlsm dan xls</p>

                  @if($errors->has('file'))
                  <span class="help-block">
                    <strong id="pesanerror">{{$errors->first('file')}}</strong>
                  </span>
                  @endif

                  @if(Session::has('error'))
                    <span class="help-block">
                      <strong id="pesanerror">{{Session::get('error')}}. Silahkan tekan tombol 'Unduh Excel Layout Nilai' atau klik <a href="{{URL('layout/tidakhadir')}}">DISINI</a> untuk mendownload layout excel yang benar.</strong>
                    </span>
                  @endif
                </div>  

                  <div class="modal-footer">
                <button type="submit" class="btn btn-flat btn-success" onclick="yo();">Upload</button>
                <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Tutup</button>
              {{Form::close()}}
              </div>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
<!--========================================= MODAL UNTUK UPLOAD EXCEL DATA RAPOT ==============================================-->

<script type="text/javascript">
function yo(){

    $('#loading').show();

    $('#filelabel').hide();
    $('#file').hide();
    $('#keterangan').hide();
    $('#pesanerror').hide();

    var dots = window.setInterval( function() {
    var wait = document.getElementById("wait");
    if ( wait.innerHTML.length > 5 ) 
        wait.innerHTML = ".";
    else 
        wait.innerHTML += ".";
    }, 300);

}
</script>

@if($errors->has('file') or Session::has('error'))
<script type="text/javascript">
  window.setTimeout(function(){
    document.getElementById("openModal").click();
  }, 0);
</script>

@endif

@endsection