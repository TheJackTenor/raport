@extends('template.headquarter')

@section('content')


<div id="app">
<div class="container">
<div class="page-header">
	<h1>MAN MAGUWOHARJO SLEMAN</h1>
	<div class="lead"><h4>Page Login</h4></div>
</div>

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
	<div class="panel-heading"><b>Gunakan Hak Akses Anda Sebijak Mungkin</b></div>
	<div class="panel-body">
	<div class="col-md-offset-1">
		{{Form::open(array('url'=>'/login','class'=>'form-horizontal','role'=>'form'))}}
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
			{{Form::label('username','Username',['class'=>'col-md-3 control-label'])}}
			<div class="col-md-6">
				{{Form::text('username','',['placeholder'=>'Username','class'=>'form-control','autofocus'])}}

				@if($errors->has('username'))
				<span class="help-block">
					<strong>{{$errors->first('username')}}</strong>
				</span>
				@endif

			</div>
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
		{{Form::label('password','Password',['class'=>'col-md-3 control-label'])}}
		<div class="col-md-6">
			<input id="password" type="password" name="password" class="form-control" placeholder="Password">
			@if($errors->has('password'))
				<span class="help-block">
					<strong>{{$errors->first('password')}}</strong>
				</span>
			@endif
		</div>
		</div>
		{{Form::submit('Login',['class'=>'btn btn-danger col-md-offset-3'])}}
		{{Form::close()}}
	</div>
</div>
</div>
</div>
</div>
</div>
@endsection