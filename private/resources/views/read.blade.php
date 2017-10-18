@extends('template/headquarter')
@section('content')

<div id="app">
<div class="container">
@if(Session::has('message'))
<div class="content">
	<div class="title m-b-md">
		<a href="./showof"><span class="label label-success">{{Session::get('message')}}</span></a>
	</div>
</div>
@else
<div class="page-header">
	<h1>Daftar Data Siswa</h1>
	<a href="./"><div class="lead">MAN MAGUWOHARJO SLEMAN</div></a>

</div>
<div class="col-md-10 col-md-offset-1">
<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>ID Siswa</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Kelas</th>
			<th>Controller</th>
		</tr>
		<?php $no=1; ?>
		@foreach($swan as $data)
		<tr>
			<td>{{$no++}}</td>
			<td>{{$data->id_siswa}}</td>
			<td>{{$data->nama}}</td>
			<td>{{$data->alamat}}</td>
			<td>{{$data->kelas}}</td>
			<td><a href="./changeform/{{$data->id_siswa}}">Edit</a>
			|| <a href="./delete/{{$data->id_siswa}}">Hapus</a></td>
		</tr>
		@endforeach



	</table>
</div>
</div>
@endif
</div>
</div>
@endsection