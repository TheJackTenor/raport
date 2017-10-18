@extends('template/headquarterskaryawanbk')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>Identitas KD
		<small>SIKAP SPIRITUAL</small>
		</h1>

	</section>

	<section class="content">
		
  <div class="row">

           <div class="col-md-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Buat KD untuk :</h3>
 
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>
   
            </div>
@php
    $semesters = array('1/Ganjil', '2/Genap');
    $ajaran = array('2013/2014','2014/2015','2015/2016','2016/2017','2017/2018','2018/2019','2019/2020');
  @endphp
  {{Form::open(array('role'=>'form','url'=>'identitaskd/proseskdspiritual','enctype'=>'multipart/form-data','id'=>'super'))}}
            <div class="box-body">
               <div class="form-group">                  
                    {{Form::label('semester','Semester',['class'=>'control-label'])}}                   
                     <select name="semester" id="semester" class="form-control">
                      @foreach($semesters as $semester)
                        <option value="{{$semester}}" @if(Request::is('identitaskd/spiritual')) @if($semester == Session()->get('semester')) selected='selected' @endif @elseif(Request::is('identitaskd/spiritual/filter')) @if($semester == Session()->get('semestertemp')) selected='selected' @endif @endif>{{$semester}}</option>
                      @endforeach
                  </select>
                       
                </div>

                <div class="form-group">                  
                    {{Form::label('tahunajaran','Tahun Ajaran',['class'=>'control-label'])}}                   
                     <select name="tahunajaran" id="tahunajaran" class="form-control">
                    @foreach($ajaran as $ajarans)
                      <option value="{{$ajarans}}" @if(Request::is('identitaskd/spiritual')) @if($ajarans == Session()->get('tahunajaran')) selected='selected' @endif @elseif(Request::is('identitaskd/spiritual/filter')) @if($ajarans == Session()->get('tahunajarantemp')) selected='selected' @endif @endif>{{$ajarans}}</option>
                    @endforeach
                    
                  </select>
                         
                </div>
      <button class="btn btn-success btn-flat" onclick="mesos();" type="button">Tampilkan</button>
      <img src="{{URL::asset('/private/storage/app/loading.gif')}}" id="loading" style="max-width:30px;max-height:30px;display: none" /> 
      @if(Request::is('identitaskd/spiritual/filter'))
      <a href="{{URL('identitaskd/spiritual')}}"><button class="btn btn-warning btn-flat pull-right" type="button">Kembali</button></a>
      @endif
            </div>
         
           
          </div>
        </div>




        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><small>Kelas : </small>{{Session::get('charkelas')}} || <small>Pelajaran : </small>{{Session::get('charpelajaran')}}</h3>

              <div class="pull-right">
              <button class="btn btn-success btn-flat" type="button" id="difol"></button>  <b style="color: green">KD Spiritual Default</b> || <button class="btn btn-warning btn-flat" type="button" id="clear"></button>  <b style="color: orange">Kosongkan</b>
              </div>
            </div>
         
            <div class="box-body">
            @if(Session::has('pesan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('pesan')}}
              </div>
            @endif

            {{Form::open(array('role'=>'form','url'=>'identitaskd/proseskdspiritual','enctype'=>'multipart/form-data','id'=>'super'))}}

            @if(Session::has('camshaft'))
            @php
              $count=0;
            @endphp

            @foreach($data1 as $kd)
              @php
                $count++;
              @endphp

            <div class="form-group @if($count=='1') {{ $errors->has('kd1') ? 'has-error' : ''}} @endif"> 

          

                <label class="control-label">KD {{$count}}</label>
                <input type="text" value="{{$kd->kd}}" class="form-control" @if($count == '1') id="anchor" @else id="kd{{$count}}" @endif placeholder="Masukkan KD {{$count}}" name="kd{{$count}}">

                @if($count == '1')
                  @if($errors->has('kd1'))
                    <span class="help-block">
                      <strong>{{$errors->first('kd1')}}</strong>
                    </span>
                  @endif   
                @endif              
                </div>
                @endforeach

                @for($i=$count+1;$i<=10;$i++)               
                <div class="form-group"> 
                <label class="control-label">KD {{$i}}</label>
                <input type="text" class="form-control" id="kd{{$i}}" placeholder="Masukkan KD {{$i}}" name="kd{{$i}}">
                </div>
                @endfor       
              @else           
            <div class="form-group {{ $errors->has('kd1') ? 'has-error' : ''}}"> 
                {{Form::label('kd1','KD 1',['class'=>'control-label'])}}                    
                {{Form::text('kd1','',['placeholder'=>'Masukkan KD 1','class'=>'form-control','id'=>'anchor'])}}
                  @if($errors->has('kd1'))
                    <span class="help-block">
                      <strong>{{$errors->first('kd1')}}</strong>
                    </span>
                  @endif                 
                </div>
                @for($i=2;$i<=10;$i++)                
                <div class="form-group"> 
                <label class="control-label">KD {{$i}}</label>
                <input type="text" class="form-control" id="kd{{$i}}" placeholder="Masukkan KD {{$i}}" name="kd{{$i}}">         
                </div>
                @endfor           
             @endif
              <button type="submit" class="btn btn-success btn-flat">Simpan KD</button>
              {{Form::close()}} 
             
            </div>
          </div>
        </div>
      </div>
	</section>
</div>

<script type="text/javascript">
  function mesos(){
    $('#loading').show();

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var semester = document.getElementById('semester').value;
      var tahunajaran = document.getElementById('tahunajaran').value;     

      var dataString = "semester="+semester+"&tahunajaran="+tahunajaran;
      var alamat = "{{URL('kdspiritualtrigger')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            
        });
         $('#loading').show();

            $(document).ready(function(){window.setTimeout(function() {
              window.location.href = '{{URL('/identitaskd/spiritual/filter')}}';}, 500);
            });
     
}
</script>
@endsection