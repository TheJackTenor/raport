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
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
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

                      @if(!Session::has('error'))

                      @foreach($content as $konten)
                        @if($konten->id_siswa == $siswa->id)
                          @php
                            $toggle = 1;
                          @endphp
                          <td><input type="text" id="sakit{{$no}}" class="form-control" @if($konten->sakit != " ") value="{{$konten->sakit}}" @endif name="sakit{{$no}}" style="width: 45px;margin-top: 10px"></td>
                          <td><input type="text" id="ijin{{$no}}" class="form-control" @if($konten->ijin != " ") value="{{$konten->ijin}}" @endif name="ijin{{$no}}" style="width: 45px;margin-top: 10px"></td>
                          <td><input type="text" id="alpha{{$no}}" class="form-control" @if($konten->alpha != " ") value="{{$konten->alpha}}" @endif name="alpha{{$no}}" style="width: 45px;margin-top: 10px"></td>

                          <td><input type="text" class="form-control" @if($konten->eskul1 != " ") value="{{$konten->eskul1}}" @endif name="eskul1{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai1{{$no}}" class="form-control" @if($konten->nilaieskul1 != " ") value="{{$konten->nilaieskul1}}" @endif name="nilai1{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan1{{$no}}" style="width: 200px">@if($konten->keteranganeskul1 != " "){{$konten->keteranganeskul1}}@endif</textarea> </td>

                          <td><input type="text" class="form-control" @if($konten->eskul2 != " ") value="{{$konten->eskul2}}" @endif name="eskul2{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai2{{$no}}" class="form-control" @if($konten->nilaieskul2 != " ") value="{{$konten->nilaieskul2}}" @endif name="nilai2{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan2{{$no}}" style="width: 200px">@if($konten->keteranganeskul2 != " "){{$konten->keteranganeskul2}}@endif</textarea> </td>

                          <td><input type="text" class="form-control" @if($konten->eskul3 != " ") value="{{$konten->eskul3}}" @endif name="eskul3{{$no}}" style="width: 100px;margin-top: 10px"></td>
                          <td><input type="text" id="nilai3{{$no}}" class="form-control" @if($konten->nilaieskul3 != " ") value="{{$konten->nilaieskul3}}" @endif name="nilai3{{$no}}" style="width: 37px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keterangan3{{$no}}" style="width: 200px">@if($konten->keteranganeskul3 != " "){{$konten->keteranganeskul3}}@endif</textarea> </td>

                          <td><input type="text" class="form-control" @if($konten->prestasi1 != " ") value="{{$konten->prestasi1}}" @endif name="prestasi1{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres1{{$no}}" style="width: 200px">@if($konten->keteranganprestasi1 != " "){{$konten->keteranganprestasi1}}@endif</textarea> </td>

                          <td><input type="text" class="form-control" @if($konten->prestasi2 != " ") value="{{$konten->prestasi2}}" @endif  name="prestasi2{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres2{{$no}}" style="width: 200px">@if($konten->keteranganprestasi2 != " "){{$konten->keteranganprestasi2}}@endif</textarea> </td>

                          <td><input type="text" class="form-control"  @if($konten->prestasi3 != " ") value="{{$konten->prestasi3}}" @endif name="prestasi3{{$no}}" style="width: 200px;margin-top: 10px"></td>
                          <td><textarea class="form-control" name="keteranganpres3{{$no}}" style="width: 200px"> @if($konten->keteranganprestasi3 != " "){{$konten->keteranganprestasi3}}@endif</textarea> </td>

                          <td><textarea class="form-control" name="catatan{{$no}}" style="width: 200px">@if($konten->catatan != " "){{$konten->catatan}}@endif</textarea> </td>
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

                      @else

                       <td><input type="text" id="sakit{{$no}}" class="form-control" name="sakit{{$no}}" value="{{Input::old('sakit'.$no)}}" style="width: 45px;margin-top: 10px"></td>
                        <td><input type="text" id="ijin{{$no}}" class="form-control" name="ijin{{$no}}" value="{{Input::old('ijin'.$no)}}" style="width: 45px;margin-top: 10px"></td>
                        <td><input type="text" id="alpha{{$no}}" class="form-control" name="alpha{{$no}}" value="{{Input::old('alpha'.$no)}}" style="width: 45px;margin-top: 10px"></td>

                        <td><input type="text" class="form-control" name="eskul1{{$no}}" value="{{Input::old('eskul1'.$no)}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai1{{$no}}" class="form-control" value="{{Input::old('nilai1'.$no)}}" name="nilai1{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan1{{$no}}" style="width: 200px">{{Input::old('keterangan1'.$no)}}</textarea> </td>

                        <td><input type="text" class="form-control" name="eskul2{{$no}}" value="{{Input::old('eskul2'.$no)}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai2{{$no}}" class="form-control" value="{{Input::old('nilai2'.$no)}}" name="nilai2{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan2{{$no}}" style="width: 200px">{{Input::old('keterangan2'.$no)}}</textarea> </td>

                        <td><input type="text" class="form-control" name="eskul3{{$no}}" value="{{Input::old('eskul3'.$no)}}" style="width: 100px;margin-top: 10px"></td>
                        <td><input type="text" id="nilai3{{$no}}" class="form-control" value="{{Input::old('nilai3'.$no)}}" name="nilai3{{$no}}" style="width: 37px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keterangan3{{$no}}" style="width: 200px">{{Input::old('keterangan3'.$no)}}</textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi1{{$no}}" value="{{Input::old('prestasi1'.$no)}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres1{{$no}}" style="width: 200px">{{Input::old('keteranganpres1'.$no)}}</textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi2{{$no}}" value="{{Input::old('prestasi2'.$no)}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres2{{$no}}" style="width: 200px">{{Input::old('keteranganpres2'.$no)}}</textarea> </td>

                        <td><input type="text" class="form-control" name="prestasi3{{$no}}" value="{{Input::old('prestasi3'.$no)}}" style="width: 200px;margin-top: 10px"></td>
                        <td><textarea class="form-control" name="keteranganpres3{{$no}}" style="width: 200px">{{Input::old('keteranganpres3'.$no)}}</textarea> </td>

                        <td><textarea class="form-control" name="catatan{{$no}}" style="width: 200px">{{Input::old('catatan'.$no)}}</textarea> </td>
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

  <p id="joss"></p>

	</section>
</div>

@endsection