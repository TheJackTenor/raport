@extends('template/headquarterswali')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Cetak Leger
    <small><b>{{Session::get('charkelas')}}</b></small>
		</h1>
	</section>

	<section class="content">
		
  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><B>PREVIEW</B> Data Leger | <small>Semester : </small>{{Session::get('semester')}} | <small>Tahunajaran : </small>{{Session::get('tahunajaran')}}</h3>
             
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>
   
            </div>

         
     
            <div class="box-body" >
            @if(Session::has('emptysakit') or Session::has('emptypengetahuan') or Session::has('emptyketerampilan') or Session::has('emptysosial') or Session::has('emptyspiritual'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Kesalahan!</h4>
                @if(Session::has('emptynilai')) Data nilai @endif @if(Session::has('emptypengetahuan')){{Session::get('emptypengetahuan')}}, @endif @if(Session::has('emptyketerampilan')){{Session::get('emptyketerampilan')}}, @endif @if(Session::has('emptysosial')){{Session::get('emptysosial')}}, @endif @if(Session::has('emptyspiritual')){{Session::get('emptyspiritual')}} @endif @if(Session::has('emptysakit')) @if(Session::has('emptynilai')) dan  @endif {{Session::get('emptysakit')}} @endif masih ada yang kosong. Silahkan lengkapi terlebih dahulu sebelum menyetak leger. @if(Session::has('emptynilai')) Untuk nilai yang kosong silahkan hubungi masing-masing guru pengampu pelajaran.  @endif @if(Session::has('emptysakit')) Untuk data SIA yang kosong, bisa klik <a href="{{URL('/identitas/daftarhadir&eksul')}}"><b style="color: cyan">DI SINI</b></a> untuk melengkapi data SIA @endif
                
            </div>
            @endif
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
       {{Form::close()}}
            </div>
     
           
          </div>
        </div>
      </div>
	</section>
</div>
@endsection