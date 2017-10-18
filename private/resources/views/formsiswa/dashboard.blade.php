@extends('template/headquarterssiswa')
@section('content')

<div class="content-wrapper">
<section class="content-header">
      <h1>
      Home
        <small>{{Session::get('namamadrasah')}}</small>
      </h1>
    </section>

<section class="content">

<div class="row">
  <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" style="height: 110px">
            <div class="inner">
              Selamat Datang, <h3>{{Session::get('namasiswa')}}</h3>           
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6" >
          <!-- small box -->
          <div class="small-box bg-yellow" style="height: 110px">
            <div class="inner">
              Kelas anda sekarang, <h3>{{Session::get('namakelas')}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
          </div>
        </div>
</div>

</section>
	
</div>
@endsection