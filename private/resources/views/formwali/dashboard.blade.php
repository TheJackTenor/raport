@extends('template/headquarterswali')
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
  <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-green" style="height: 120px">
            <div class="inner">
              Anda wali kelas <h3>{{Session::get('charkelas')}}</h3>           
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-yellow" style="height: 120px">
            <div class="inner">
              Jumlah Murid <h3>{{Session::get('totalsiswa')}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
           
          </div>
        </div>

        <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-red" style="height: 120px">
            <div class="inner">
              Status Migrasi Kelas <h3>{{Session::get('statusmigrasi')}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
           
          </div>
        </div>

      @if(Auth::user()->hak_akses == 1)

         <div class="col-lg-3 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-green" style="height: 120px">
            <div class="inner">
              <p>Mode</p>
              <h3>Wali Kelas</h3>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
           
          </div>
        </div>
        @endif

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <p>Terdapat</p>
              <h3 id="migrasikonfirmasi">{{Session::get('migrasikonfirmasi')}}</h3>
              <p>Migrasi kelas menunggu konfirmasi anda</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer" onclick="callsiswa();" data-toggle="modal" data-target="#waitconfirmation">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

</section>
	
</div>
@endsection