@extends('headquarters')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Rerata Nilai
		</h1>

	</section>

  <!--===========================================CODE FOR PELAJARAN GROUPING HEADER========================================-->
  @php
    $temp = '';
    $higest = 0;
    $noJenjang = 0;

  @endphp

  @foreach($daftarPelajaran as $daftar)
    @if($daftar->jenjang != $temp)

      @php
        $noJenjang++;
        $noPelajaran = 1;
        $temp = $daftar->jenjang;
        $pelajaranTemp[$noPelajaran][$noJenjang] = $daftar->id_pelajaran;
        $qlf = false;
      @endphp

      <?php
        if (empty($pelajaranChar[$noPelajaran])) {
          $pelajaranChar[$noPelajaran] = $daftar->namapelajaran;
        }

      ?>

      @if($noJenjang != 1)
        @php
          $tempNoJenjangReal = $noJenjang-1;
        @endphp
      @else
        @php
          $tempNoJenjangReal = $noJenjang;
        @endphp
      @endif

      @for($i=1 ; $i <= $tempNoJenjangReal ; $i++)
      @if(isset($pelajaranTemp[$noPelajaran][$i]))
        @if($pelajaranTemp[$noPelajaran][$i] == $daftar->id_pelajaran)
          @php
            $qlf = true;
            $tempNoJenjangReal = $i;
          @endphp     
        @endif
      @endif    
      @endfor

      @if($qlf == false)
        @php
          $pelajaranChar[$noPelajaran] = $pelajaranChar[$noPelajaran].'/'.$daftar->namapelajaran;
        @endphp
      @endif 

     @elseif($daftar->jenjang == $temp)
      @php
        $noPelajaran++;
        $pelajaranTemp[$noPelajaran][$noJenjang] = $daftar->id_pelajaran;
        $qlf = false;
      @endphp

    <?php
        if (empty($pelajaranChar[$noPelajaran])) {
          $pelajaranChar[$noPelajaran] = $daftar->namapelajaran;
        }
      ?>

      @if($noJenjang != 1)
        @php
          $tempNoJenjangReal = $noJenjang-1;
        @endphp
      @else
        @php
          $tempNoJenjangReal = $noJenjang;
        @endphp
      @endif

      @for($i=1 ; $i <= $tempNoJenjangReal ; $i++)
      @if(isset($pelajaranTemp[$noPelajaran][$i]))
        @if($pelajaranTemp[$noPelajaran][$i] == $daftar->id_pelajaran)
          @php
            $qlf = true;
            $tempNoJenjangReal = $i;
          @endphp     
        @endif
      @endif    
      @endfor

      @if($qlf == false)
        @php
          $pelajaranChar[$noPelajaran] = $pelajaranChar[$noPelajaran].'/'.$daftar->namapelajaran;
        @endphp
      @endif 

    @endif


    @if($noPelajaran > $higest)
      @php
        $higest = $noPelajaran;
      @endphp
      
    @endif
  @endforeach

  <!--===========================================CODE FOR PELAJARAN GROUPING HEADER========================================-->


	<section class="content">
  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success @if($errors->all()) collapsed-box @endif">
            <div class="box-header with-border">
              <h3 class="box-title">Rerata Nilai</h3>
              <button type="button" class="btn btn-success btn-flat pull-right btn-xs" data-target="#menuangkatan" data-toggle="modal" onclick="trigger();" id="menuButton">Menu</button>
            </div>


            <div class="box-body">
            @if(Session::has('menuToggle'))
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">NISN</th>
                  <th rowspan="2">NIS</th>
                  <th rowspan="2">Jurusan</th>
                  @for($i=1 ; $i <= $higest ; $i++)
                    <th colspan="{{$divider}}">{{$pelajaranChar[$i]}}</th>
                  @endfor
                </tr>

                <tr>
                @for($i=1 ; $i <= $higest ; $i++)
                  @foreach($semesterChoosen as $daftarSemester)
                    <th>{{$daftarSemester}}</th>
                  @endforeach
                @endfor
                </tr>
           
                </thead>
                <tbody>  
               
                </tbody>
              </table>
              
            </div>
            @endif
              <button id="adding" type="button" class="btn btn-success btn-flat" style="margin-top: 10px">Expor Excel</button>
           </div>
          </div>
        </div>
      </div>
	</section>
</div>

<!-- ==============================================MODAL UNTUK MENAMPILKAN MENU RATA-RATA==================================================== -->
<div class="example-modal">
        <div class="modal fade modal modal-success" id="menuangkatan" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Angkatan dan Semester<p id="jajal"></p></h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'imama','enctype'=>'multipart/form-data'))}}
                <div class="form-group">                  
                    {{Form::label('tahun','Pilih Angkatan',['class'=>'control-label'])}}                   
                     <select name="angkatan" id="angkatan" class="form-control select2" style="width: 100%">
                      @foreach($dataTahun as $tahun)
                        <option>{{$tahun}}</option>
                      @endforeach
                    </select>  
                </div>

                <div class="form-group">
                {{Form::label('semester','Pilih Semester',['class'=>'control-label'])}}   
                  <div class="form-control">
                  @for($i=1 ; $i<=6 ; $i++)
                    <label>
                      <input type="checkbox" class="flat-red form-control" id="semester" name="semester[]" value="{{$i}}">{{$i}}
                    </label>
                  @endfor
                  </div>
                
                   
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success btn-flat" id="eksekusi" disabled="disabled">Eksekusi</button> 
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

<!-- ==============================================MODAL UNTUK MENAMPILKAN MENU RATA-RATA==================================================== -->
<script type="text/javascript">
function trigger(){
   var scanAngkatan = $('#angkatan option:selected').text();
   if (scanAngkatan == "Belum Bisa") {
    document.getElementById('eksekusi').disabled = true;
    $('input[id="semester"]').attr("disabled", true);
   }
}
</script>

@if(!Session::has('menuToggle'))
<script type="text/javascript">
 window.setTimeout(function(){
  document.getElementById('menuButton').click();
 }, 500);
</script>
@endif


@endsection