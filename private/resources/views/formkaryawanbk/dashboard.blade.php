@extends('template/headquarterskaryawanbk')
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
	
		

</section>
	
</div>
@endsection