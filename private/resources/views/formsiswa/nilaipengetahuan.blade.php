@extends('template/headquarterssiswa')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>{{$message}}</h1>
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><small>Pelajaran : </small>| <small>Semester : </small>{{Session::get('semester')}} | <small>Tahunajaran : </small>{{Session::get('tahunajaran')}}</h3>
             
              <div class="box-tools pull-right">             
            <button type="button" id="menu" onclick="execute();" class="btn btn-success btn-flat" data-toggle="modal" data-target="#exampleModal">Pilih Pelajaran</button>              
          </div>
   
            </div>
 
            <div class="box-body">
           @if(Session::has('status_pengetahuan'))

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
                  <th class="danger" colspan="{{$c}}" style="text-align: center;">KOMPETENSI PENGETAHUAN</th>
                  <th class="success"></th>
                  <th class="success" colspan="2"></th>
                  <th class="success" rowspan="3" style="text-align: center;padding-bottom: 70px"><p>DESKRIPSI</p></th>
                  <th class="success" rowspan="3" style="text-align: center;padding-bottom: 80px">T/TT</th>
                
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
                  <th rowspan="2" style="text-align: center;padding-bottom: 35px;" class="warning"><P>NILAI PENGETAHUAN</P></th> 
                  <th rowspan="2" style="padding-bottom: 40px" style="text-align: center;" class="warning"><p>PREDIKAT</p></th>
                </tr>

                <tr>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Urut</th>
                  <th class="success" style="text-align: center;padding-bottom: 40px">Nama Peserta Didik</th>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Induk</th>
        
                  @foreach($kontenkd as $datakd)
                    <th class="warning"><p>{{$datakd -> kd}}</p></th>
                  @endforeach

                  @if($k==1)
                    <th class="warning"><p style="color: red;text-align: center;">Guru anda belum memasukkan nilai</p></th>
                  @endif

                 
                </tr>

                {{Form::open(array('role'=>'form','url'=>'kompentensi/aspekpengetahuan/simpan','enctype'=>'multipart/form-data'))}}
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


                    @if($pengetahuan->id_siswa == $datasiswas->id)
                      @php
                        $toggle = 1;
                        $idnow = $pengetahuan->id;
                        $i = 0;
                      @endphp

                      @foreach($detail as $details)

                        @if($idnow == $details->id_nilai)
                        @php
                          $i++;
                        @endphp
                        <td align="center"><input type="text" class="form-control" name="kd{{$i}}{{$a}}" readonly="readonly" id="kd{{$i}}{{$a}}" style="width: 49px;margin-top: 30px" onblur="mantap();" @if($details->kd == "0") value="" @else value="{{$details->kd}}" @endif></td>
                        @endif
                      @endforeach

                      @if($i < $c)
                        @for($m = $i+1;$m<=$c;$m++)
                           <td align="center"><input type="text" class="form-control" name="kd{{$m}}{{$a}}" id="kd{{$m}}{{$a}}" readonly="readonly" style="width: 49px;margin-top: 30px" onblur="mantap();"></td>
                        @endfor
                      @endif

                      @if($k==1)
                        <td align="center"><input type="text" class="form-control" style="width: 49px;margin-top: 30px" disabled="disabled" value="N/A"></td>
                      @endif


                      <td class="success"></td>
                      <td align="center"><input type="number" class="form-control" tabindex="-1" name="rerata{{$a}}" id="rerata{{$a}}" value="{{$pengetahuan->nilai}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                      <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikat{{$a}}" id="predikat{{$a}}" value="{{$pengetahuan->predikat}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>
                      <td align="center"><textarea class="form-control" name="deskripsi{{$a}}" tabindex="-1" id="deskripsi{{$a}}"  readonly="readonly" rows="4" style="width: 600px" >{{$pengetahuan->deskripsi}}</textarea></td>
                      <td align="center"><input type="text" class="form-control" tabindex="-1" name="tt{{$a}}" id="tt{{$a}}" readonly="readonly" value="{{$pengetahuan->ttt}}" style="width: 45px;margin-top: 30px" ></td>
                  </tr>
                    @endif

                  @if($toggle == 0)

                    @for($i=1;$i<=$c;$i++)
                      <td align="center"><input type="text" class="form-control" name="kd{{$i}}{{$a}}" id="kd{{$i}}{{$a}}" style="width: 49px;margin-top: 30px" onblur="mantap();"></td>
                    @endfor

                    @if($k==1)
                      <td align="center"><input type="text" class="form-control" style="width: 49px;margin-top: 30px" disabled="disabled" value="N/A"></td>
                    @endif

                    <td class="success"></td>
                    <td align="center"><input type="text" class="form-control" tabindex="-1" name="rerata{{$a}}" id="rerata{{$a}}" readonly="readonly" style="width: 55px;margin-top: 30px" ></td>
                    <td align="center"><input type="text" class="form-control" tabindex="-1" name="predikat{{$a}}" id="predikat{{$a}}" readonly="readonly" style="width: 38px;margin-top: 30px" ></td>
                    <td align="center"><textarea class="form-control" name="deskripsi{{$a}}" tabindex="-1" id="deskripsi{{$a}}" readonly="readonly" rows="4" style="width: 600px" ></textarea></td>
                    <td align="center"><input type="text" class="form-control" name="tt{{$a}}" tabindex="-1" id="tt{{$a}}" readonly="readonly" style="width: 45px;margin-top: 30px" ></td>
                </tr>
                  @endif
                @endforeach

                <tr>
                  <th colspan="3">NILAI KKM KD</th>
                  @for($i=1;$i<=$c;$i++)
                    <th style="text-align: center;" ><p style="color: red">{{$infonilai->ckmpengetahuan}}</p></th>
                  @endfor
                  <th class="success" ></th>
                </tr>
                                               
                </thead>
         
               
              </table>
              </div>
              {{Form::close()}}
            </div>
     @endif
           
          </div>
        </div>
      </div>

	</section>
</div>


<div class="example-modal">
        <div class="modal fade modal modal-success" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Pelajaran</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>$url,'enctype'=>'multipart/form-data','id'=>'super'))}}
                           
                 <div class="form-group"> 
                {{Form::label('pelajaran','Pilih Pelajaran',['class'=>'control-label'])}}                    
                <select id="pelajaran" name="pelajaran" class="form-control select2" aria-hidden="true"  style="width: 100%;">
                @foreach(Session::get('daftarpelajaran') as $pelajarans)
                  <option value="{{$pelajarans->id_pelajaran}}">{{$pelajarans->namapelajaran}}</option>
                @endforeach
                </select>
                              
                </div>              
               

                <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-flat" id="eksekusi">Eksekusi</button>            
              </div>
              {{Form::close()}}
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>




@endsection