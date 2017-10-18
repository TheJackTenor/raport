@extends('template/headquarterskaryawan')
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
          <div class="small-box bg-green" style="height: 120px">
            <div class="inner">
              Selamat Datang, <h3>{{Auth::user()->username}}</h3>           
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" style="height: 120px">
            <div class="inner">
              Anda Telah Berhasil Masuk Sebagai, <h3>TU</h3>
            </div>
            <div class="icon">
              <i class="fa fa-info"></i>
            </div>
          </div>
        </div>
</div>

</section>
	
</div>
@endsection