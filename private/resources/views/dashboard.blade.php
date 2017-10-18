@extends('headquarters')
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
		 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$pelajaran}}</h3>

              <p>Pelajaran terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="{{URL::asset('/manajemenpelajaran/datapelajaran')}}" class="small-box-footer">
             Lihat <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$guru}}</h3>

              <p>Guru terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-magic"></i>
            </div>
            <a href="{{URL::asset('/manajemenguru/dataguru')}}" class="small-box-footer">
              Lihat <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$siswa}}</h3>

              <p>Siswa terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{URL::asset('/manajemensiswa/datasiswa')}}" class="small-box-footer">
              Lihat <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$kelas}}</h3>

              <p>Kelas terdaftar</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="{{URL::asset('/manajemenkelas/datakelas')}}" class="small-box-footer">
              Lihat <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

	</div>

	
		

</section>
	
</div>
@endsection