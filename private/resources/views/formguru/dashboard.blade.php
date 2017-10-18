@extends('template/headquartersguru')
@section('content')

<div class="content-wrapper">
<section class="content-header">
      <h1>
      Home
        <small>{{Session::get('nama')}}</small>
      </h1>
    </section>

<section class="content">

<div class="row">
  <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              Kelas yang anda pilih <h3>{{Session::get('charkelas')}}</h3>

              <p>Untuk menentukan siswa yang akan diolah nilainya</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              Pelajaran yang anda pilih <h3>{{Session::get('charpelajaran')}}</h3>

              <p>Untuk menentukan pelajaran yang akan dimasukkan nilainya</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
</div>

	<div class="row">
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              Anda mengajar <h3>{{$pelajaran}}</h3>

              <p>Pelajaran terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>

         

        <div class="col-lg-6 col-xs-9">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              Anda mengajar<h3>{{$siswa}}</h3>

              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              Anda mengajar di <h3>{{$kelas}}</h3>

              <p>Kelas terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
          </div>
        </div>

	</div>

  
 
	
		

</section>
	
</div>
@endsection