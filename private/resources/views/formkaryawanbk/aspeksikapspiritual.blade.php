@extends('template/headquarterskaryawanbk')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Kompetensi
		<small>ASPEK SPIRITUAL</small>
		</h1>
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->has('file')) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title"><small>Kelas : </small>{{Session::get('charkelas')}} || <small>Pelajaran : </small> {{Session::get('charpelajaran')}} || <small>KKM Mapel : </small>{{Session::get('ckmsikap')}} || <small>Semester : </small>{{Session::get('semester')}} || <small>Tahun Ajaran : </small>{{Session::get('tahunajaran')}}</h3></h3>
             
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-warning btn-flat btn-xs" data-widget="collapse" data-toggle="tooltip" title="Collapse" id="swipe">Unggah file Excel</button>
                <a href="{{URL('layout/nilaibk')}}"><button type="button" class="btn btn-success btn-flat btn-xs">Unduh Excel Layout Nilai</button></a>               
              </div>
   
            </div>

         
     
            <div class="box-body">
            @if(Session::has('message'))
            <div @if(!Session::has('failed')) class="alert alert-success alert-dismissible" @elseif(Session::has('failed')) class="alert alert-danger alert-dismissible" @endif>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>@if(!Session::has('failed'))<i class="icon fa fa-check"></i> Sukses ! @elseif(Session::has('failed')) <i class="icon fa fa-remove"></i> Gagal ! @endif</h4>
                {{Session::get('message')}}
              </div>
            @endif

             @php
              $c = 0;
            @endphp
            @foreach($kontenkd as $kd)
              @php
                $c++;
              @endphp
            @endforeach

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="danger" colspan="{{$c}}" style="text-align: center;">KOMPETENSI SIKAP SPIRITUAL</th>
                  <th class="success"></th>
                  <th rowspan="3" style="text-align: center;padding-bottom: 35px;" class="warning"><P>MODUS SIKAP</P></th> 
                  <th rowspan="3" style="padding-bottom: 40px" style="text-align: center;" class="warning"><p>PREDIKAT</p></th>
                  <th rowspan="3" style="text-align: center;padding-bottom: 35px;" class="warning"><P>MODUS SIKAP (GAB)</P></th> 
                  <th rowspan="3" style="padding-bottom: 40px" style="text-align: center;" class="warning"><p>PREDIKAT (GAB)</p></th>
                  <th rowspan="3" style="padding-bottom: 40px" class="warning"><p style="text-align: center;">T/TT</p></th>
                                    
                  <th rowspan="3" style="padding-bottom: 40px"  class="success"><p style="text-align: center;">DESKRIPSI</p></th>
                </tr>

                <tr>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="active"></th>
                  @for($k=1;$k<=$c;$k++)
                    <th class="success" style="text-align: center;">KD{{$k}}</th>
                  @endfor
                  @if($k==1)
                    <th class="success" style="text-align: center;">DATA KD KOSONG</th>
                  @endif    
                  <th class="success" rowspan="2"></th>
                </tr>

                <tr>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Urut</th>
                  <th class="success" style="text-align: center;padding-bottom: 40px">Nama Peserta Didik</th>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Induk</th>

                  @foreach($kontenkd as $datakd)
                    <th class="warning"><p>{{$datakd -> kd}}</p></th>
                  @endforeach

                  @if($k==1)
                   <th class="warning"><p style="color: red;text-align: center;">Silahkan isi data KD terlebih dahulu !</p></th>
                  @endif
                 
                </tr>

                {{Form::open(array('role'=>'form','url'=>'kompentensi/spiritual/simpan','enctype'=>'multipart/form-data'))}}
                @php
                  $a = 0;
                @endphp

                {{Form::hidden('savecol',$c,['class'=>'form-control'])}} 

               @foreach($datasiswa as $datasiswas) 
                  @php
                    $a++;
                    $toggle = 0;
                  @endphp

                <tr>
                  <td><p style="margin-top: 35px;text-align: center;">{{$a}}</p></td>
                  <td><p style="margin-top: 35px;text-align: center;width: 200px">{{$datasiswas->namasiswa}}</p></td>
                  {{Form::hidden('idsiswa'.$a,$datasiswas->id,['class'=>'form-control'])}}
                  {{Form::hidden('saverow',$a,['class'=>'form-control'])}}      
                  <td><p style="margin-top: 35px;text-align: center;">{{$datasiswas->nis}}</p></td>

                  @foreach($spiritual as $spirituals)
                    @if($spirituals->id_siswa == $datasiswas->id)
                      @php
                        $toggle = 1;
                        $idnow = $spirituals->id;
                        $i = 0;
                      @endphp

                       @foreach($detail as $details)
                        @if($idnow == $details->id_nilai)
                        @php
                          $i++;
                        @endphp
                          @if($i<=$c)
                            <td align="center"><input type="text" class="form-control" name="kd{{$i}}-{{$a}}" id="kd{{$i}}-{{$a}}" style="width: 49px;margin-top: 30px" onblur="mantap();" @if($details->kd == "0") value="" @else value="{{$details->kd}}" @endif></td>
                          @endif                    
                        @endif
                      @endforeach

                      @if($i < $c)
                        @for($m = $i+1;$m<=$c;$m++)
                           <td align="center"><input type="text" class="form-control" name="kd{{$m}}-{{$a}}" id="kd{{$m}}-{{$a}}" style="width: 49px;margin-top: 30px" onblur="mantap();"></td>
                        @endfor
                      @endif

                      @if($k==1)
                        <td align="center"><input type="text" class="form-control" style="width: 49px;margin-top: 30px" disabled="disabled" value="N/A"></td>
                      @endif

                      <td class="success"></td>
                      <td align="center"><input type="number" class="form-control" tabindex="-1" name="rerata{{$a}}" id="rerata{{$a}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                      <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikat{{$a}}" id="predikat{{$a}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>

                      <td align="center"><input type="number" class="form-control" tabindex="-1" name="rerataGab{{$a}}" id="rerataGab{{$a}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                      <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikatGab{{$a}}" id="predikatGab{{$a}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>

                      <td align="center"><input type="text" class="form-control" tabindex="-1" name="tt{{$a}}" id="tt{{$a}}" readonly="readonly" style="width: 45px;margin-top: 30px" ></td>
                      <td align="center"><textarea class="form-control" name="deskripsi{{$a}}" tabindex="-1" id="deskripsi{{$a}}" readonly="readonly" rows="4" style="width: 600px" ></textarea></td>
                  </tr>
                    @endif
                  @endforeach

                  @if($toggle == 0)
                    @for($i=1;$i<=$c;$i++)
                      <td align="center"><input type="text" class="form-control" name="kd{{$i}}-{{$a}}" id="kd{{$i}}-{{$a}}" style="width: 49px;margin-top: 30px" onblur="mantap();" @if($i > $c) value = "0" readonly="readonly" tabindex="-1" @endif ></td>
                    @endfor

                    @if($k==1)
                      <td align="center"><input type="text" class="form-control" style="width: 49px;margin-top: 30px" disabled="disabled" value="N/A"></td>
                    @endif

                    <td class="success"></td>
                    <td align="center"><input type="number" class="form-control" tabindex="-1" name="rerata{{$a}}" id="rerata{{$a}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                    <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikat{{$a}}" id="predikat{{$a}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>

                    <td align="center"><input type="number" class="form-control" tabindex="-1" name="rerataGab{{$a}}" id="rerataGab{{$a}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                    <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikatGab{{$a}}" id="predikatGab{{$a}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>

                    <td align="center"><input type="text" class="form-control" tabindex="-1" name="tt{{$a}}" id="tt{{$a}}" readonly="readonly" style="width: 45px;margin-top: 30px" ></td>
                    <td align="center"><textarea class="form-control" name="deskripsi{{$a}}" tabindex="-1" id="deskripsi{{$a}}" readonly="readonly" rows="4" style="width: 600px" ></textarea></td>
                </tr>
                  @endif
                @endforeach


                <tr>
                  <th colspan="3">NILAI KKM KD</th>
                  @for($i=1;$i<=$c;$i++)
                    <th style="text-align: center;" ><p style="color: red">{{$infonilai->ckmsikap}}</p></th>
                  @endfor
                  <th class="success" ></th>
                </tr>                
                </tr>
               
                </thead>
         
               
              </table>
              </div>
              <button type="submit" class="btn btn-success btn-flat" id="autoadd" style="margin-top: 5px" @if($k==1) disabled="disabled" @endif>Simpan</button>
              {{Form::close()}}
            </div>
     
           
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Upload File</h3>
             
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>
   
            </div>

         
     {{Form::open(array('role'=>'form','url'=>'kompentensi/aspeksikap/spiritual/uploadbk','enctype'=>'multipart/form-data'))}}
            <div class="box-body">
               <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
                  
                  {{Form::label('file','Unggah File Excel')}}
                                             
                  <input type="file" id="fotoguru" name="file" class="validate"/ >
                  <p class="help-block">Ekstensi file yang diizinan : xlsm dan xls</p>

                  @if($errors->has('file'))
                  <span class="help-block">
                    <strong>{{$errors->first('file')}}</strong>
                  </span>
                  @endif
                </div>  
                  <button type="submit" onclick="yo();" class="btn btn-success btn-flat pull-left">Upload !</button>
                  <button type="button" class="btn btn-warning btn-flat pull-left" onclick="nilaiSwipe();" style="margin-left: 5px">Kembali</button>
                  <h5 id="loading" class="pull-left" style="display: none;margin-left: 10px">Sedang memuat..Silahkan Tunggu</h5><h5 id="wait" class="pull-left">.</h5>              
            </div>

     {{Form::close()}}
           
          </div>
        </div>
      </div>

	</section>
</div>


<script type="text/javascript">
function yo(){

    $('#loading').show();

     var dots = window.setInterval( function() {
    var wait = document.getElementById("wait");
    if ( wait.innerHTML.length > 5 ) 
        wait.innerHTML = "";
    else 
        wait.innerHTML += ".";
    }, 300);
}
</script>

<script type="text/javascript">
  function nilaiSwipe(){
    document.getElementById('swipe').click();
  }
</script>




@endsection