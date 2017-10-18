@extends('template/headquarterskaryawan')
@section('content')




<div class="content-wrapper">
	<section class="content-header">
		<h1>Dokumentasi Leger
		</h1>

	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Leger</h3>
       
              <div class="box-tools pull-right">             
            <button type="button" id="menu" onclick="execute();" class="btn btn-success btn-flat" data-toggle="modal" data-target="#exampleModal">Pencarian</button>          
          </div>
       
            </div>

     
            <div class="box-body" >
            @if(Session::has('showleger'))
            <div class="table-responsive" >
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="warning" style="text-align: center;">NO URUT</th>
                    <th class="warning" style="text-align: center;">NAMA PESERTA DIDIK</th>
                    <th class="warning" style="text-align: center;">NIS/NISN</th>
                  
                    <th class="warning" style="text-align: center;">ASPEK</th>
                    @foreach($daftarpelajarans as $daftarpelajaran)
                      
                      <th class="info" style="text-align: center;">{{$daftarpelajaran -> datapelajaran -> namapelajaran}}</th>
                     
                    @endforeach
                    <th class="warning" style="text-align: center;">JUMLAH</th>
                    <th class="warning" style="text-align: center;">RERATA</th>
                    <th class="warning" style="text-align: center;">S</th>
                    <th class="warning" style="text-align: center;">I</th>
                    <th class="warning" style="text-align: center;">A</th>
                  </tr>
                  <tr>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    @php
                      $s=0;
                    @endphp
                    @foreach($daftarpelajarans as $daftarpelajaran)                    
                    @php
                      $s++;
                      $filler[$s] = $daftarpelajaran->id_pelajaran;
                    @endphp
                      <th class="active" style="text-align: center;"><p style="height: 2px">{{$s}}</p></th>
                 
                    @endforeach
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    <th class="active"><p style="height: 2px"></p></th>
                    
                  </tr>
                  
                 {{Form::open(array('role'=>'form','url'=>'hasil/cetakleger/cetak','enctype'=>'multipart/form-data'))}}
                 {{Form::hidden('emptypengetahuan',0,['class'=>'form-control'])}}
                 {{Form::hidden('emptyketerampilan',0,['class'=>'form-control'])}}
                 {{Form::hidden('emptysosial',0,['class'=>'form-control'])}}
                 {{Form::hidden('emptyspiritual',0,['class'=>'form-control'])}}
                 {{Form::hidden('emptysakit',0,['class'=>'form-control'])}}
                  @php
                    $countplus = 0;
                  @endphp

                @foreach($daftarsiswas as $daftarsiswa)

                  @php
                    $countplus++;
                    $plus = 0;
                  @endphp

                  @foreach($nilai as $nilais)
                    @if($nilais->kd_aspek == 1)
                      @if($daftarsiswa->id == $nilais->id_siswa)
                        @php
                          $plus++; 
                          $savecount[$countplus] = $plus;
                        @endphp
                      @endif
                    @endif
                  @endforeach


                  @php
                    $plus = 0;
                  @endphp
                 
                  @foreach($nilai as $nilais)
                    @if($nilais->kd_aspek == 2)
                      @if($daftarsiswa->id == $nilais->id_siswa)
                        @php
                          $plus++; 
                          $savecountket[$countplus] = $plus;
                        @endphp  
                      @endif
                    @endif            
                  @endforeach


                  @php
                    $plus = 0;
                  @endphp
                 
                   @foreach($nilai as $nilais)
                    @if($nilais->kd_aspek == 3)
                      @if($daftarsiswa->id == $nilais->id_siswa)
                        @php
                          $plus++; 
                          $savecountspit[$countplus] = $plus;
                        @endphp
                      @endif
                    @endif
                  @endforeach

                  @php
                    $plus = 0;
                  @endphp
                 
                  @foreach($nilai as $nilais)
                    @if($nilais->kd_aspek == 4)
                      @if($daftarsiswa->id == $nilais->id_siswa)
                        @php
                          $plus++; 
                          $savecountsos[$countplus] = $plus;
                        @endphp
                      @endif
                    @endif
                 @endforeach
                @endforeach

                 @php
                  $no=0;
                  $toggle = 0;
                  $temp = "";
                  $count = 0;
                  $counts = 0;
                  $row = 0;
                  $cell = 0;
                 @endphp

                @foreach($daftarsiswas as $daftarsiswa)
                   @if($toggle == 1)
                      </tr>
                    @endif
                  @php
                    $no++;
                    $row++;
                    $count = 0;
                    $counts = 0;
                    $cell = 0;
                  @endphp
                    <tr>
                    <td rowspan="4"><p style="width: 10px; margin-top: 80px">{{$no}}</p></td>
                    <td rowspan="4"><input type="text" style="width: 200px; margin-top: 80px" class="form-control" value="{{$daftarsiswa->namasiswa}}" readonly="readonly" name="atr{{$row}}1"></td>
                     {{Form::hidden('ids'.$row,$daftarsiswa->id,['class'=>'form-control'])}}
                    <td rowspan="4"><input type="text" style="width: 137px; margin-top: 80px" class="form-control" value="{{$daftarsiswa->nis}} / {{$daftarsiswa->nisn}}" readonly="readonly" name="atr{{$row}}2"></td>
                    <td class="info"><input type="text" class="form-control" value="Pengetahuan" readonly="readonly" style="width: 108px" name="atr{{$row}}3"></td>

                 @foreach($nilai as $nilais)
                  @if($nilais->kd_aspek == 1)
                  @if($daftarsiswa->id == $nilais->id_siswa)
                  @php
                    $count++;
                    $counts++;
                  @endphp

                   @if($filler[$counts] == $nilais->id_pelajaran)
                    @php
                      $cell++;
                    @endphp
                      <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                   @elseif($filler[$counts] != $nilais->id_pelajaran)
                    @for($m=$counts+1 ; $m<=$s ; $m++)
                      @php
                        $cell++;
                      @endphp
                      <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                      @if($filler[$m] == $nilais->id_pelajaran)
                        @php
                          $cell++;
                        @endphp
                        <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                        @php
                          $counts = $m;
                          $m = $s+1;
                        @endphp
                      @endif
                    @endfor
                   @endif



                    @if($savecount[$no] == $count)
                      @php
                        $sakitcount = 0;
                      @endphp
                    
                      @for($d=$counts+1 ; $d<=$s ; $d++)
                        @php
                          $cell++;
                        @endphp
                        <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                      @endfor
                      <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                      <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>

                      @foreach($sia as $sakit)
                        @if($sakit->id_siswa == $daftarsiswa->id)
                          @php
                            $sakitcount++;
                          @endphp
                          <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->sakit}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="sakit{{$row}}"></td>
                          <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->ijin}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="ijin{{$row}}"></td>
                          <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->alpha}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="alpha{{$row}}"></td>
                        @endif
                      @endforeach
                      @if($sakitcount == 0)
                        {{Form::hidden('emptysakit',1,['class'=>'form-control'])}}
                         <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="sakit{{$row}}"></td>
                          <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="ijin{{$row}}"></td>
                          <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="alpha{{$row}}"></td>
                      @endif
                      @endif
                      @endif
                      @endif
                      @endforeach



                      @if($count == 0)
                      {{Form::hidden('emptypengetahuan',1,['class'=>'form-control'])}}
                        @php
                          $count_s = 0;
                        @endphp
                        @for($replace=1 ; $replace<=$s ; $replace++)
                          @php
                            $cell++;
                            $count_s++;
                          @endphp
                          <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @if($count_s == $s)
                            @php
                              $sakitcount = 0;
                            @endphp
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                            @foreach($sia as $sakit)
                              @if($sakit->id_siswa == $daftarsiswa->id)
                                @php
                                  $sakitcount++;
                                @endphp
                                <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->sakit}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="sakit{{$row}}"></td>
                                <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->ijin}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="ijin{{$row}}"></td>
                                <td rowspan="4" align="center"><input type="text" class="form-control" value="{{$sakit->alpha}}" readonly="readonly" style="width: 43px; margin-top: 80px" name="alpha{{$row}}"></td>
                              @endif
                            @endforeach
                            @if($sakitcount == 0)
                              {{Form::hidden('emptysakit',1,['class'=>'form-control'])}}
                              <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="sakit{{$row}}"></td>
                              <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="ijin{{$row}}"></td>
                              <td rowspan="4" align="center"><input type="text" class="form-control" value="-" readonly="readonly" style="width: 43px; margin-top: 80px" name="alpha{{$row}}"></td>
                            @endif
                          @endif
                        @endfor
                      @endif
                          
                        
                      


                      @php
                        $row++;
                        $cell = 0;
                        $count = 0;
                        $counts = 0;
                      @endphp
                      <tr>
                      <td class="info"><input type="text" class="form-control" value="Keterampilan" readonly="readonly" style="width: 108px" name="atr{{$row}}3"></td>
                      {{Form::hidden('ids'.$row,$daftarsiswa->id,['class'=>'form-control'])}}
                      @foreach($nilai as $nilais)
                        @if($nilais->kd_aspek == 2)
                        @if($daftarsiswa->id == $nilais->id_siswa)
                          @php
                            $count++;
                            $counts++;
                          @endphp

                          @if($filler[$counts] == $nilais->id_pelajaran)
                            @php
                              $cell++;
                            @endphp
                            <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @elseif($filler[$counts] != $nilais->id_pelajaran)
                            @for($m=$counts+1 ; $m<=$s ; $m++)
                              @php
                                $cell++;
                              @endphp
                               <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                              @if($filler[$m] == $nilais->id_pelajaran)
                                @php
                                  $cell++;
                                @endphp
                                 <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                                @php
                                  $counts = $m;
                                  $m = $s+1;
                                @endphp
                              @endif
                            @endfor
                          @endif
                          @if($savecountket[$no] == $count)
                             @for($d=$counts+1 ; $d<=$s ; $d++)
                              @php
                                $cell++;
                              @endphp
                              <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                            @endfor
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                             
                          @endif
                        @endif
                      @endif
                      @endforeach


                      @if($count == 0)
                      {{Form::hidden('emptyketerampilan',1,['class'=>'form-control'])}}
                        @php
                          $count_s = 0;
                        @endphp
                        @for($replace=1 ; $replace<=$s ; $replace++)
                          @php
                            $cell++;
                            $count_s++;
                          @endphp
                          <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @if($count_s == $s)
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                          @endif
                        @endfor
                      @endif



                      @php
                        $row++;
                        $cell = 0;
                        $count = 0;
                        $counts = 0;
                      @endphp
                      <tr>
                      <td class="warning"><input type="text" class="form-control" value="Spiritual" readonly="readonly" style="width: 108px" name="atr{{$row}}3"></td>
                      {{Form::hidden('ids'.$row,$daftarsiswa->id,['class'=>'form-control'])}}
                      @foreach($nilai as $nilais)
                      @if($nilais->kd_aspek == 3)
                        @if($daftarsiswa->id == $nilais->id_siswa)
                          @php
                            $count++;
                            $counts++;
                          @endphp

                          @if($filler[$counts] == $nilais->id_pelajaran)
                            @php
                              $cell++;
                            @endphp
                            <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @elseif($filler[$counts] != $nilais->id_pelajaran)
                            @for($m=$counts+1 ; $m<=$s ; $m++)
                              @php
                                $cell++;
                              @endphp
                               <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                              @if($filler[$m] == $nilais->id_pelajaran)
                                @php
                                  $cell++;
                                @endphp
                                 <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                                @php
                                  $counts = $m;
                                  $m = $s+1;
                                @endphp
                              @endif
                            @endfor
                          @endif
                          @if($savecountspit[$no] == $count)
                             @for($d=$counts+1 ; $d<=$s ; $d++)
                              @php
                                $cell++;
                              @endphp
                              <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                            @endfor
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                             
                          @endif
                        @endif
                      @endif
                      @endforeach


                      @if($count == 0)
                      {{Form::hidden('emptyspiritual',1,['class'=>'form-control'])}}
                        @php
                          $count_s = 0;
                        @endphp
                        @for($replace=1 ; $replace<=$s ; $replace++)
                          @php
                            $cell++;
                            $count_s++;
                          @endphp
                          <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @if($count_s == $s)
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                          @endif
                        @endfor
                      @endif


                       @php
                        $row++;
                        $cell = 0;
                        $count = 0;
                        $counts = 0;
                      @endphp
                      <tr>
                      <td class="warning"><input type="text" class="form-control" value="Sosial" readonly="readonly" style="width: 108px" name="atr{{$row}}3"></td>
                      {{Form::hidden('ids'.$row,$daftarsiswa->id,['class'=>'form-control'])}}
                      @foreach($nilai as $nilais)
                      @if($nilais->kd_aspek == 4)
                        @if($daftarsiswa->id == $nilais->id_siswa)
                          @php
                            $count++;
                            $counts++;
                          @endphp

                          @if($filler[$counts] == $nilais->id_pelajaran)
                            @php
                              $cell++;
                            @endphp
                            <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @elseif($filler[$counts] != $nilais->id_pelajaran)
                            @for($m=$counts+1 ; $m<=$s ; $m++)
                              @php
                                $cell++;
                              @endphp
                               <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                              @if($filler[$m] == $nilais->id_pelajaran)
                                @php
                                  $cell++;
                                @endphp
                                 <td align="center" class="success"><input type="text" class="form-control" value="{{$nilais->nilai}}" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                                @php
                                  $counts = $m;
                                  $m = $s+1;
                                @endphp
                              @endif
                            @endfor
                          @endif
                          @if($savecountsos[$no] == $count)
                             @for($d=$counts+1 ; $d<=$s ; $d++)
                              @php
                                $cell++;
                              @endphp
                              <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                            @endfor
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                              <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                             
                          @endif
                        @endif
                      @endif
                      @endforeach



                      @if($count == 0)
                      {{Form::hidden('emptysosial',1,['class'=>'form-control'])}}
                        @php
                          $count_s = 0;
                        @endphp
                        @for($replace=1 ; $replace<=$s ; $replace++)
                          @php
                            $cell++;
                            $count_s++;
                          @endphp
                          <td align="center" class="danger"><input type="text" class="form-control" value="0" readonly="readonly" style="width: 55px" name="cell{{$row}}{{$cell}}" id="cell{{$row}}{{$cell}}"></td>
                          @if($count_s == $s)
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="jumlah{{$row}}" id="jumlah{{$row}}"></td>
                            <td align="center"><input type="text" class="form-control" readonly="readonly" style="width: 55px" name="rerata{{$row}}" id="rerata{{$row}}"></td>
                          @endif
                        @endfor
                      @endif                   
                    
                  @php
                    $toggle = 1;
                  @endphp
                  {{Form::hidden('saverow',$row,['class'=>'form-control'])}}
                  {{Form::hidden('savecell',$cell,['class'=>'form-control'])}}
                 @endforeach
                 
                 
                </thead>
         
              </table>

                

              </div>
              <button type="submit" class="btn btn-success btn-flat" style="margin-top: 10px">Cetak</button>
                </form>
            @endif
            </div>
          
           
          </div>
        </div>
      </div>

   

<div class="example-modal">
        <div class="modal fade modal modal-success" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian Data Leger</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'dokumentasileger/preview','enctype'=>'multipart/form-data','id'=>'super'))}}
                 
                <div class="form-group"> 
                {{Form::label('siswa','Pilih Siswa',['class'=>'control-label'])}}                    
                <select id="daftarsiswa" name="daftarsiswa" class="form-control select2" aria-hidden="true" onchange="execute();"  style="width: 100%;">
                 @foreach($daftarsiswamodal as $data)
                  <option value="{{$data->id}}" @if($data->id == Session::get('idsiswa')) selected="selected" @endif>{{$data -> nisn}} - {{$data -> namasiswa}}</option>
                  @endforeach
                </select>             
                </div>  

                <div class="form-group"> 
                {{Form::label('kelas','Pilih Kelas',['class'=>'control-label'])}}                    
                <select id="kelas" name="kelas" class="form-control select2" aria-hidden="true"  style="width: 100%;">
              
                </select>
                              
                </div>  

                  @php

      $datasemester = array('1/Ganjil','2/Genap');

     @endphp

                 <div class="form-group"> 
                {{Form::label('semester','Pilih Semester',['class'=>'control-label'])}}                    
                <select id="semester" name="semester" class="form-control select2" aria-hidden="true"  style="width: 100%;">
                @foreach($datasemester as $semester)
                  <option @if($semester == $semesterchoose) selected="selected" @endif>{{$semester}}</option>
                @endforeach
                </select>
                              
                </div>              
               

                <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-flat" disabled="disabled" id="eksekusi" >Eksekusi</button>            
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
      

  



         



	</section>
</div>

<script type="text/javascript">
  function execute(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var daftarsiswa = document.getElementById('daftarsiswa').value; 

      var dataString = "daftarsiswa="+daftarsiswa;
      var alamat = "{{URL('carikelas')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;

        // Get the raw DOM object for the select box
        select = document.getElementById('kelas');

        document.getElementById('eksekusi').disabled = false;
        
        // Clear the old options
        select.options.length = 0;
        
        // Load the new options
        options = data.options;
        for (index = 0; index < options.length; ++index) {
          option = options[index];
          select.options.add(new Option(option.text, option.value));
        }
            }
            
        }); 

}
</script>


@endsection