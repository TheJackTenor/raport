@extends('template/headquarterswali')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Identitas
		<small><B>CEK DESKRIPSI SIKAP</B></small>
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
                <h4>@if(!Session::has('error'))<i class="icon fa fa-check"></i> Sukses! @else <i class="icon fa fa-warning"></i> Kesalahan! @endif</h4>
                {{Session::get('message')}}
              </div>
            @endif
            <div class="table-responsive" >
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="text-align: center;width: 10px" class="warning" rowspan="3">NO URUT</th>
                    <th style="text-align: center;width: 20px" class="warning" rowspan="3">NO INDUK</th>
                    <th style="text-align: center;width: 250px" class="warning" rowspan="3">NAMA PESERTA DIDIK</th>
                  </tr>
                  <tr>
                    <th style="text-align: center" class="info" colspan="2">SIKAP SPIRITUAL</th>
                    <th style="text-align: center" class="info" colspan="2">SIKAP SOSIAL</th>
                  </tr>
                  <tr>
                    <th style="text-align: center" class="warning">Predikat</th>
                    <th style="text-align: center" class="warning">Deskripsi</th>
                    <th style="text-align: center" class="warning">Predikat</th>
                    <th style="text-align: center" class="warning">Deskripsi</th>
                  </tr>
                 @php
                    $s = 0;
                  @endphp
                  {{Form::open(array('role'=>'form','url'=>'identitas/cekdeskripsisikap/simpan','enctype'=>'multipart/form-data'))}}
                  

                @if(!Session::has('error'))
                    @foreach($datasiswas as $datasiswa)
                      @php
                        $s++;
                        $toggle = 0;
                      @endphp
                    
                    {{Form::hidden('saverow',$s,['class'=>'form-control'])}}
                    

                  
                    <tr>
                      <td>{{$s}}</td>
                      <td>{{$datasiswa->nis}}</td>
                      <td>{{$datasiswa->namasiswa}}</td>
                      @foreach($spiritual as $spirit)              
                        @if($datasiswa->id == $spirit->id_siswa)
                          @php
                            $toggle = 1;
                          @endphp
                           <td align="center" style="width: 20px"><input type="text" name="spiritpre{{$s}}" readonly="readonly" class="form-control" value="{{$spirit->predikat}}" style="width: 43px"></td>
                          <td><textarea name="spiritdes{{$s}}" class="form-control">{{$spirit->deskripsi}}</textarea></td>
                          {{Form::hidden('id_nilai_spiritual'.$s,$spirit->id,['class'=>'form-control'])}}
                        @endif
                      @endforeach

                      @if($toggle == 0)
                          <td align="center" style="width: 20px"><input type="text" name="spiritpre{{$s}}" readonly="readonly" class="form-control" style="width: 43px"></td>
                          <td><textarea name="spiritdes{{$s}}" class="form-control" placeholder="Tidak ada data"></textarea></td>
                      @endif

                      @php
                        $toggle = 0;
                      @endphp

                      @foreach($sosial as $sosials)    
                        @if($datasiswa->id == $sosials->id_siswa)
                          @php
                            $toggle = 1;
                          @endphp
                          <td align="center" style="width: 20px"><input type="text" name="sosialpre{{$s}}" readonly="readonly" class="form-control" value="{{$sosials->predikat}}" style="width: 43px"></td>
                          <td><textarea name="sosialdes{{$s}}" class="form-control">{{$sosials->deskripsi}}</textarea></td>
                          {{Form::hidden('id_nilai_sosial'.$s,$sosials->id,['class'=>'form-control'])}}
                        @endif
                      @endforeach

                      @if($toggle == 0)
                      <td align="center" style="width: 20px"><input type="text" name="sosialpre{{$s}}" readonly="readonly" class="form-control" style="width: 43px"></td>
                          <td><textarea name="sosialdes{{$s}}" class="form-control" placeholder="Tidak ada data"></textarea></td>
                      @endif
                    </tr>
                    @endforeach

                  @else

                  @foreach($datasiswas as $datasiswa)
                      @php
                        $s++;
                      @endphp
                      {{Form::hidden('saverow',$s,['class'=>'form-control'])}}
                      <tr>
                        <td>{{$s}}</td>
                        <td>{{$datasiswa->nis}}</td>
                        <td>{{$datasiswa->namasiswa}}</td>                      
                          {{Form::hidden('id_nilai_spiritual'.$s,Input::old('id_nilai_spiritual'.$s),['class'=>'form-control'])}}
                          {{Form::hidden('id_nilai_sosial'.$s,Input::old('id_nilai_sosial'.$s),['class'=>'form-control'])}}          
                          <td align="center" style="width: 20px"><input type="text" name="spiritpre{{$s}}" readonly="readonly" class="form-control" value="{{Input::old('spiritpre'.$s)}}" style="width: 43px"></td>
                          <td align="center"><textarea name="spiritdes{{$s}}" placeholder="Tidak ada data" class="form-control">{{Input::old('spiritdes'.$s)}}</textarea></td>
                          <td align="center" style="width: 20px"><input type="text" name="sosialpre{{$s}}" readonly="readonly" class="form-control" value="{{Input::old('sosialpre'.$s)}}" style="width: 43px"></td>
                          <td align="center"><textarea name="sosialdes{{$s}}" placeholder="Tidak ada data" class="form-control">{{Input::old('sosialdes'.$s)}}</textarea></td>
                        </tr>         

                    @endforeach


                  @endif
                 
                </thead>
         
               
              </table>

                

              </div>
                   <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                  {{Form::close()}}
      
            </div>
     
           
          </div>
        </div>
      </div>

  <p id="joss"></p>


     





	</section>
</div>







@endsection