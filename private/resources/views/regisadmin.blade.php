@extends('template/headquarter')
@section('content')
<div class="totalblackout">
	<div class="container">
	<div class="flex-center position-ref full-height">
		<div class="col-md-8">
		
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon glyphicon-user"></span><b> Halaman khusus registrasi admin</b></div>
				<div class="panel-body">
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissable fade in">
    					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    					<strong>Sukses!</strong> {{Session::get('message')}}
  					</div>

  					<script>
						$(document).ready(function(){window.setTimeout(function() {
							window.location.href = '/sisfo/login';}, 2500);
						});
					</script>

					@endif
				<div class="col-md-offset-1">
					{{Form::open(array('url'=>'/vonbrauninprogress','class'=>'form-horizontal','role'=>'form'))}}
				
					<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
						{{Form::label('email','Alamat E-mail',['class'=>'col-md-4 control-label'])}}
						<div class="col-md-6">
							{{Form::text('email','',['placeholder'=>'Alamat E-Mail','class'=>'form-control','autofocus'])}}

							@if($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email')}}</strong>
								</span>
							@endif

						</div>
					</div>
					<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
						{{Form::label('username','Username',['class'=>'col-md-4 control-label'])}}
						<div class="col-md-6">
							{{Form::text('username','',['placeholder'=>'Username','class'=>'form-control'])}}

							@if($errors->has('username'))
								<span class="help-block">
									<strong>{{ $errors->first('username')}}</strong>
								</span>
							@endif

						</div>
					</div>
					<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
						{{Form::label('password','Password',['class'=>'col-md-4 control-label'])}}
						<div class="col-md-6">
							<input id="password" type="password" name="password" class="form-control" placeholder="Password">

							@if($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password')}}</strong>
								</span>
							@endif

						</div>
					</div>
					<div class="form-group {{ $errors->has('confirmpassword') ? 'has-error' : ''}}">
						{{Form::label('konfirmasipassword','Konfirmasi Password',['class'=>'col-md-4 control-label'])}}
						<div class="col-md-6">
							<input id="confirmpassword" type="password" name="confirmpassword" class="form-control" placeholder="Konfirmasi Password">

							@if($errors->has('confirmpassword'))
								<span class="help-block">
									<strong>{{ $errors->first('confirmpassword')}}</strong>
								</span>
							@endif



						</div>
					</div>
					{{Form::submit('Daftar',['class'=>'btn btn-danger col-md-offset-4'])}}
					{{Form::close()}}
</div>

				</div>
			</div>
			</div>
		</div>
	</div>
</div>




@endsection