@extends('template/headquarter')

@section('content')
<div id="app">
	<div class="container">
	<div class="page-header">
		<h1>MAN Maguwoharjo Sleman</h1>
		<div class="lead"><h4>Mari majukan bangsa bersama kami !</h4></div>
	</div>
	<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading"><b>@if(Session::has('status')) {{Session::get('status')}} @else Daftarkan diri anda di sini ! @endif</b></div>
		<div class="panel-body">
			@if(Session::has('status'))
			{{Form::open(array('url'=>'/prosesedit','class'=>'form-horizontal','role'=>'form'))}}
			{{Form::hidden('id_siswa',$revolution->id_siswa,['class'=>'form-control'])}}
			<div class="form-group">
			{{Form::label('nama','Nama',['class'=>'col-md-3 control-label','autofocus'])}}
			<div class="col-md-6">
			{{Form::text('name',$revolution->nama,['class'=>'form-control'])}}
			</div>
			</div>

			<div class="form-group">
			{{Form::label('alamat','Alamat',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
				{{Form::textarea('address',$revolution->alamat,['class'=>'form-control'])}}
			</div>
			</div>

			<div class="form-group">
			{{Form::label('kelas','Kelas :',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
				{{Form::text('class',$revolution->kelas,['class'=>'form-control'])}}
			</div>
			</div>
			{{Form::submit('Edit',['class'=>'btn btn-danger col-md-offset-3'])}}
			<a href="/sisfo/showof"><div class="btn btn-warning" type="button">Kembali</div></a>
			{{Form::close()}}


			@else
			{{Form::open(array('url'=>'/prosestambah','class'=>'form-horizontal','role'=>'form'))}}
			<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
			{{Form::label('nama','Nama',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
			{{Form::text('name','',['placeholder'=>'Isikan nama anda di sini','class'=>'form-control','autofocus'])}}

			@if($errors->has('name'))
			<span class="help-block">
				<strong>{{$errors->first('name')}}</strong>
			</span>
			@endif

			</div>
			</div>

			<div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
			{{Form::label('alamat','Alamat',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
				{{Form::textarea('address','',['placeholder'=>'Isikan alamat anda di sini','class'=>'form-control'])}}

				@if($errors->has('address'))
				<span class="help-block" autofocus>
					<strong>{{$errors->first('address')}}</strong>
				</span>
				@endif

			</div>
			</div>

			<div class="form-group {{$errors->has('class') ? 'has-error' : ''}}">
			{{Form::label('kelas','Kelas :',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
				{{Form::text('class','',['placeholder'=>'Isikan kelas anda di sini','class'=>'form-control'])}}

				@if($errors->has('class'))
				<span class="help-block">
					<strong>{{$errors->first('class')}}</strong>
				</span>
				@endif



			</div>
			</div>
			{{Form::submit('Eksekusi',['class'=>'btn btn-danger col-md-offset-3'])}}
			<a href="/sisfo/showof"><button type="button" class="btn btn-primary">Lihat Data</button></a>
			{{Form::close()}}
			@endif
		</div>
	</div>
	</div>
	</div>
</div>



@endsection