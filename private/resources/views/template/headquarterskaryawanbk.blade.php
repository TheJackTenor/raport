<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" /> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{URL::asset('/plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('/plugins/datatables/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{URL::asset('/plugins/iCheck/all.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('/dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{URL::asset('/plugins/datepicker/datepicker3.css')}}">

  <link rel="stylesheet" href="{{URL::asset('/dist/css/skins/skin-green.min.css')}}">

 
</head>

<body class="hold-transition skin-green @if(Request::is('kompentensi/*')) sidebar-collapse @endif sidebar-mini" @if(Request::is('identitaskd/*') or Request::is('identitaskd/*/*')) onload="trigger();" @elseif('kompetensi/*') onload="mantap();" @endif>



<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b id="mans">MAN</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{session()->get('nama')}}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
         
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{URL::asset('/private/storage/app')}}/{{Session::get('photo')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->username}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{URL::asset('/private/storage/app')}}/{{Session::get('photo')}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->username}} - BK
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                @if(Auth::user()->hak_akses == 6)
                  <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modalBk" onclick="kelasTrigger();">Ubah Pilihan</button>
                @endif
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{URL::asset('/private/storage/app')}}/{{Session::get('photo')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <!-- Status -->
          <i class="fa fa-envelope"> {{Auth::user()->email}}</i> 
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="@if(Request::is('home') or Request::is('admin/bk/home')) active @endif">
          <a href="{{URL::asset('/home')}}">
            <i class="fa fa-home"></i>
            <span>Home @if(Auth::user()->hak_akses == 1) - Admin @endif</span>
          </a>
        </li>

         <li class="@if(Request::is('identitaskd/*')) or Request::is('identitaskd/*/*')) or Request::is('identitaskd/*/*/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-sticky-note"></i>
            <span>Identitas KD</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('identitaskd/spiritual') or Request::is('identitaskd/spiritual/*')) active @endif">
              <a href="{{URL::asset('/identitaskd/spiritual')}}">
                <i class="fa fa-circle-o"></i>
                Sikap Spiritual
              </a>
            </li>

             <li class="@if(Request::is('identitaskd/sosial') or Request::is('identitaskd/sosial/*')) active @endif">
              <a href="{{URL::asset('/identitaskd/sosial')}}">
                <i class="fa fa-circle-o"></i>
                Sikap Sosial
              </a>
            </li>

          </ul>
        </li>


         <li class="@if(Request::is('kompentensi/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Kompetensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('kompentensi/spiritual') or Request::is('kompentensi/spiritual/*')) active @endif">
              <a href="{{URL::asset('/kompentensi/spiritual')}}">
                <i class="fa fa-circle-o"></i>
                Aspek Sikap Spritual
              </a>
            </li>

             <li class="@if(Request::is('kompentensi/sosial') or Request::is('kompentensi/sosial/*')) active @endif">
              <a href="{{URL::asset('/kompentensi/sosial')}}">
                <i class="fa fa-circle-o"></i>
               Aspek Sikap Sosial
              </a>
            </li>

          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
@yield('content')

  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
     Sistem Informasi Manajemen Nilai Siswa <strong>{{session()->get('nama')}}</strong>
  </footer>
@if(Auth::user()->hak_akses == 6)
    <div class="example-modal" >
        <div class="modal fade modal modal-success" id="modalBk" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Kelas dan Pelajaran</h4>
              </div>
              <div class="modal-body">
                  {{Form::open(array('role'=>'form','url'=>'homelandingbk/','enctype'=>'multipart/form-data'))}}
                  {{Form::hidden('urlnow',Request::getPathInfo(),['class'=>'form-control'])}}
                <div class="form-group">
                  {{Form::label('pilihkelas', 'Pilih Kelas',['class'=>'control-label'])}}
                  <select class="form-control select2" name="pilihKelas" id="pilihKelas" style="width: 100%" onchange="kelasTrigger();">
                  @foreach(Session::get('kelasBk') as $kelasBk)
                    <option value="{{$kelasBk->id}}">{{$kelasBk->namakelas}}</option>
                  @endforeach
                  </select>
                </div>

                <div class="form-group">
                  {{Form::label('pilihpelajaran','Pilih Pelajaran',['class'=>'control-label'])}}
                  <select id="pilihPelajaran" name="pilihPelajaran" class="form-control select2" style="width: 100%">
                    
                  </select>
                </div>
                

                <div class="modal-footer">
                  <button type="submit" class="btn btn-success pull-right btn-flat">Eksekusi</button>
                  {{Form::close()}}
                  <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                </div>
                

              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
@endif

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src={{URL::asset('/plugins/jQuery/jquery-2.2.3.min.js')}}></script>
<!-- Bootstrap 3.3.6 -->
<script src={{URL::asset('/plugins/select2/select2.full.min.js')}}></script>
<script src={{URL::asset('/js/bootstrap.min.js')}}></script>
<script src={{URL::asset('/plugins/datatables/jquery.dataTables.min.js')}}></script>
<script src={{URL::asset('/plugins/datatables/dataTables.bootstrap.min.js')}}></script>
<script src={{URL::asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}></script>
<script src={{URL::asset('/plugins/fastclick/fastclick.js')}}></script>
<script src={{URL::asset('/plugins/iCheck/icheck.min.js')}}></script>
<script src={{URL::asset('/plugins/input-mask/jquery.inputmask.js')}}></script>
<script src="{{URL::asset('/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- AdminLTE App -->
<script src={{URL::asset('/dist/js/app.min.js')}}></script>

<!--==================JQUERY UNTUK SELECT DATA ARRAY SKIN========================-->

@if(Request::is('identitaskd/spiritual') or Request::is('identitaskd/spiritual/filter'))
<script type="text/javascript">
  document.getElementById('difol').onclick = function(){
    document.getElementById('anchor').value ="Berdoa sebelum & sesudah kegiatan";
    document.getElementById('kd2').value ="Beribadah tepat waktu";
    document.getElementById('kd3').value = "Memberi salam saat bertemu dan akan berpisah";
    document.getElementById('kd4').value = "Bersyukur atas nikmat dan karunia Tuhan YME";
    document.getElementById('kd5').value ="Tawakal setelah berikhtiar";
    document.getElementById('kd6').value ="Menjaga lingkungan hidup sekitar sekolah";
    document.getElementById('kd7').value ="Memelihara hubungan baik dengan teman dan guru";
    document.getElementById('kd8').value ="Menghormati orang lain menjalankan ibadah sesuai agamanya";
    document.getElementById('kd9').value ="Rajin mengikuti tadarus pagi";
    document.getElementById('kd10').value ="Rajin melaksanakan salat sunnah";
    trigger();
}
 document.getElementById('clear').onclick = function(){
    document.getElementById('anchor').value ="";
    for (var i = 2; i <= 10; i++) {
      document.getElementById('kd'+i).value ="";
    }   
    trigger();
}
</script>
@elseif(Request::is('identitaskd/sosial') or Request::is('identitaskd/sosial/filter'))
<script type="text/javascript">
  document.getElementById('difol').onclick = function(){
    document.getElementById('anchor').value ="jujur";
    document.getElementById('kd2').value ="disiplin";
    document.getElementById('kd3').value = "bertanggungjawab";
    document.getElementById('kd4').value = "peduli";
    document.getElementById('kd5').value ="santun";
    document.getElementById('kd6').value ="responsif";
    document.getElementById('kd7').value ="proaktif";
    document.getElementById('kd8').value ="menjadi bagian dari solusi atas berbagai masalah";
    document.getElementById('kd9').value ="berinteraksi secara efektif dengan lingkungan sosial dan alam";
    document.getElementById('kd10').value ="menempatkan diri sebagai cerminan bangsa dalam pergaulan dunia";
    trigger();
}
 document.getElementById('clear').onclick = function(){
    document.getElementById('anchor').value ="";
    for (var i = 2; i <= 10; i++) {
      document.getElementById('kd'+i).value ="";
    }   
    trigger();
}
</script>
@endif

<script>


  $('#anchor').on('input', function() {
    if (document.getElementById('anchor').value == "") {
      document.getElementById('kd2').disabled = true;
    }
    else{
      document.getElementById('kd2').disabled = false;
    }


});

   $('#kd2').on('input', function() {
    if (document.getElementById('kd2').value == "") {
      document.getElementById('kd3').disabled = true;
    }
    else{
      document.getElementById('kd3').disabled = false;
    }

   
});


   $('#kd3').on('input', function() {
    if (document.getElementById('kd3').value == "") {
      document.getElementById('kd4').disabled = true;
    }
    else{
      document.getElementById('kd4').disabled = false;
    }

   
});


   $('#kd4').on('input', function() {
    if (document.getElementById('kd4').value == "") {
      document.getElementById('kd5').disabled = true;
    }
    else{
      document.getElementById('kd5').disabled = false;
    }

   
});


   $('#kd5').on('input', function() {
    if (document.getElementById('kd5').value == "") {
      document.getElementById('kd6').disabled = true;
    }
    else{
      document.getElementById('kd6').disabled = false;
    }

   
});


   $('#kd6').on('input', function() {
    if (document.getElementById('kd6').value == "") {
      document.getElementById('kd7').disabled = true;
    }
    else{
      document.getElementById('kd7').disabled = false;
    }

   
});


   $('#kd7').on('input', function() {
    if (document.getElementById('kd7').value == "") {
      document.getElementById('kd8').disabled = true;
    }
    else{
      document.getElementById('kd8').disabled = false;
    }

   
});


   $('#kd8').on('input', function() {
    if (document.getElementById('kd8').value == "") {
      document.getElementById('kd9').disabled = true;
    }
    else{
      document.getElementById('kd9').disabled = false;
    }

   
});


   $('#kd9').on('input', function() {
    if (document.getElementById('kd9').value == "") {
      document.getElementById('kd10').disabled = true;
    }
    else{
      document.getElementById('kd10').disabled = false;
    }

   
});


   $('#kd10').on('input', function() {
    if (document.getElementById('kd10').value == "") {
      document.getElementById('kd11').disabled = true;
    }
    else{
      document.getElementById('kd11').disabled = false;
    }

   
});


   $('#kd11').on('input', function() {
    if (document.getElementById('kd11').value == "") {
      document.getElementById('kd12').disabled = true;
    }
    else{
      document.getElementById('kd12').disabled = false;
    }

   
});


   $('#kd12').on('input', function() {
    if (document.getElementById('kd12').value == "") {
      document.getElementById('kd13').disabled = true;
    }
    else{
      document.getElementById('kd13').disabled = false;
    }

   
});


   $('#kd13').on('input', function() {
    if (document.getElementById('kd13').value == "") {
      document.getElementById('kd14').disabled = true;
    }
    else{
      document.getElementById('kd14').disabled = false;
    }

   
});
function trigger() {


    if (document.getElementById('anchor').value == "") {
      document.getElementById('kd2').disabled = true;
    }
    else{
      document.getElementById('kd2').disabled = false;
    }

     if (document.getElementById('kd2').value == "") {
      document.getElementById('kd3').disabled = true;
    }
    else{
      document.getElementById('kd3').disabled = false;
    }

    if (document.getElementById('kd3').value == "") {
      document.getElementById('kd4').disabled = true;
    }
    else{
      document.getElementById('kd4').disabled = false;
    }

    if (document.getElementById('kd4').value == "") {
      document.getElementById('kd5').disabled = true;
    }
    else{
      document.getElementById('kd5').disabled = false;
    }

    if (document.getElementById('kd5').value == "") {
      document.getElementById('kd6').disabled = true;
    }
    else{
      document.getElementById('kd6').disabled = false;
    }

    if (document.getElementById('kd6').value == "") {
      document.getElementById('kd7').disabled = true;
    }
    else{
      document.getElementById('kd7').disabled = false;
    }

    if (document.getElementById('kd7').value == "") {
      document.getElementById('kd8').disabled = true;
    }
    else{
      document.getElementById('kd8').disabled = false;
    }

    if (document.getElementById('kd8').value == "") {
      document.getElementById('kd9').disabled = true;
    }
    else{
      document.getElementById('kd9').disabled = false;
    }

    if (document.getElementById('kd9').value == "") {
      document.getElementById('kd10').disabled = true;
    }
    else{
      document.getElementById('kd10').disabled = false;
    }

    if (document.getElementById('kd10').value == "") {
      document.getElementById('kd11').disabled = true;
    }
    else{
      document.getElementById('kd11').disabled = false;
    }

    if (document.getElementById('kd11').value == "") {
      document.getElementById('kd12').disabled = true;
    }
    else{
      document.getElementById('kd12').disabled = false;
    }

    if (document.getElementById('kd12').value == "") {
      document.getElementById('kd13').disabled = true;
    }
    else{
      document.getElementById('kd13').disabled = false;
    }

    if (document.getElementById('kd13').value == "") {
      document.getElementById('kd14').disabled = true;
    }
    else{
      document.getElementById('kd14').disabled = false;
    }

   
};
    

</script>

@if(Request::is('kompentensi/*'))
<script>
var dataiterate, averageraw, average, averagerawfinal, dataiteratefinal, averagefinal, valueArrayTemp, valueArrayMem, valueArrayIte, valueArrayVarIte, maximusChar,maximusIte, compIncre, optimus, prime, nilaihurufGab, compTemp;
var catch_ckm = "{{Session::get('ckmsikap')}}";
var nilaihuruf, tortt, deskripsi, subdeskripsi, temp, temp_value_kd,max,min,pass_ckm;
var catch_kd = [], max_temp = [], valueArray = [], valueCount = [], valueChar = [];
var cache = 0;

<?php foreach ($kontenkd as $datakd): ?>
    cache++;
    catch_kd[cache] = "{{$datakd -> kd}}";
<?php endforeach ?>



for (var i = 1; i <= {{$a}}; i++) {
  for (var s = 1; s <= {{$c}}; s++) {
    $("#kd"+s+"-"+i).inputmask("9",{autoUnmask:true}); 
  }
}

function mantap(){
  averagerawfinal = 0;
  dataiteratefinal = 0;
  max_temp[0] = 0;
  passkkm = 0;
for (var i = 1; i <= {{$a}}; i++) {
  dataiterate=0;
  averageraw=0;
  deskripsi = "";
  subdeskripsi = "";
  valueArray = [];
  for (var s = 1; s <={{$c}}; s++) {
     
      if (document.getElementById('kd'+s+'-'+i).value >4) {
        alert("Nilai tidak boleh melebihi dari 4 !");
        document.getElementById('kd'+s+'-'+i).value = "";
        document.getElementById('kd'+s+'-'+i).focus();
      }else if(document.getElementById('kd'+s+'-'+i).value <1 && document.getElementById('kd'+s+'-'+i).value != ""){
        if ( s <= {{$c}}) {
          alert("Nilai tidak boleh kurang dari 1 !");
          document.getElementById('kd'+s+'-'+i).value = "";
        }
       
      }
    
      if (document.getElementById('kd'+s+'-'+i).value  != "" && document.getElementById('kd'+s+'-'+i).value  != "0") { 
          dataiterate++;
          temp_value_kd = parseInt(document.getElementById('kd'+s+'-'+i).value);
          valueArray[dataiterate] = temp_value_kd;

/* ------------------------ SIKAP DESCRIPTION ENGINE ------------------------- */

            if(temp_value_kd == 4){
              nilaihuruf = "SB";
            }else if(temp_value_kd == 3){
              nilaihuruf = "B";
            }else if(temp_value_kd == 2){
              nilaihuruf = "C";
            }else if(temp_value_kd == 1){
              nilaihuruf = "C";
            }

            if (s==1 || dataiterate==1 && s>1) {
              temp = nilaihuruf;
              if(nilaihuruf == "SB"){
                subdeskripsi = "Sudah sangat terbiasa dalam hal "+ catch_kd[s];
              }else if(nilaihuruf == "B"){
                subdeskripsi = "Sudah terbiasa dalam hal " + catch_kd[s]; 
              }else if(nilaihuruf == "C" || nilaihuruf == "K"){
                subdeskripsi = "Perlu dibiasakan untuk " + catch_kd[s];
              }
            }else if(temp != nilaihuruf){
              temp = nilaihuruf;
              if(nilaihuruf == "SB"){
                subdeskripsi = subdeskripsi + ". Sudah sangat terbiasa dalam hal "+ catch_kd[s];
              }else if(nilaihuruf == "B"){
                subdeskripsi = subdeskripsi + ". Sudah terbiasa dalam hal "+ catch_kd[s];
              }else if(nilaihuruf == "C" || nilaihuruf == "K"){
                subdeskripsi = subdeskripsi + ". Perlu dibiasakan untuk "+ catch_kd[s];
              }
            }else if(temp == nilaihuruf){
              subdeskripsi = subdeskripsi + ", " + catch_kd[s];
            }

         

           }

      }

if (i!=1) {
  compIncre++;
}
   
if (dataiterate > 0) {

//======================ALGORITMA UNTUK PREDIKAT MURNI====================================
  valueArray.sort(function(a,b){return b-a});
  valueArrayTemp = "";
  valueArrayValIte = 0;
  valueCount = [];
  valueChar = [];
  for (var g = 0; g <= dataiterate-1; g++) {

    if (valueArrayTemp != valueArray[g]) {
      valueArrayIte = 1;
      valueArrayValIte++;
      valueArrayTemp = valueArray[g];

      valueCount[valueArrayValIte] = valueArrayIte;
      valueChar[valueArrayValIte] = valueArrayTemp;
    }else if(valueArrayTemp == valueArray[g]){
      valueArrayIte++;
      valueCount[valueArrayValIte] = valueArrayIte;
    }
  }

  for (var d = 1; d <= valueArrayValIte; d++) {

    if (d==1) {
      maximusIte = valueCount[d];
      maximusChar = valueChar[d];
    }else{
      if (maximusIte<valueCount[d]) {
        maximusIte = valueCount[d];
        maximusChar = valueChar[d];
      }
    }

  }

//======================ALGORITMA UNTUK PREDIKAT MURNI====================================

//======================ALGORITMA UNTUK PREDIKAT GABUNGAN====================================

optimus = dataiterate-1;

<?php foreach ($detailComparison as $key => $comp): ?>
prime = "{{$key}}";
  if (i==1 && prime==0) {
    compIncre = "{{$comp->id_nilai}}";
  }

  if (compIncre == "{{$comp->id_nilai}}") {
    compTemp = "{{$comp->kd}}";
    if (compTemp != "_" && compTemp != "") {
      optimus++;
      valueArray[optimus] = compTemp;
    }    
  }
<?php endforeach ?>


 valueArray.sort(function(a,b){return b-a});
  valueArrayTemp = "";
  valueArrayValIte = 0;
  valueCount = [];
  valueChar = [];
  for (var g = 0; g <= optimus; g++) {

    if (valueArrayTemp != valueArray[g]) {
      valueArrayIte = 1;
      valueArrayValIte++;
      valueArrayTemp = valueArray[g];

      valueCount[valueArrayValIte] = valueArrayIte;
      valueChar[valueArrayValIte] = valueArrayTemp;
    }else if(valueArrayTemp == valueArray[g]){
      valueArrayIte++;
      valueCount[valueArrayValIte] = valueArrayIte;
    }
  }

  for (var d = 1; d <= valueArrayValIte; d++) {

    if (d==1) {
      maximusIteGab = valueCount[d];
      maximusCharGab = valueChar[d];
    }else{
      if (maximusIteGab<valueCount[d]) {
        maximusIteGab = valueCount[d];
        maximusCharGab = valueChar[d];
      }
    }

  }

//======================ALGORITMA UNTUK PREDIKAT GABUNGAN====================================

  if(maximusCharGab==4){
    deskripsi = "Sikapnya secara umum sangat baik. "+subdeskripsi;
  }else if(maximusCharGab == 3){
    deskripsi = "Sikapnya secara umum baik. "+subdeskripsi;
  }else if(maximusCharGab == 2){
    deskripsi = "Sikapnya seacara umum cukup. "+subdeskripsi;
  }else if(maximusCharGab == 1){
    deskripsi = "Sikapnya secara umum kurang. "+subdeskripsi;
  }

  if(maximusChar == 4){
    nilaihuruf = "SB";
  }else if(maximusChar == 3){
    nilaihuruf = "B";
  }else if(maximusChar == 2){
    nilaihuruf = "C";
  }else if(maximusChar == 1){
    nilaihuruf = "K";
  }

  if(maximusCharGab == 4){
    nilaihurufGab = "SB";
  }else if(maximusCharGab == 3){
    nilaihurufGab = "B";
  }else if(maximusCharGab == 2){
    nilaihurufGab = "C";
  }else if(maximusCharGab == 1){
    nilaihurufGab = "K";
  }


  if(maximusCharGab>=catch_ckm){
    tortt = "T";
  }else{
    tortt = "TT";
  }

}


  if(dataiterate != 0){
    document.getElementById('rerata'+i).value = maximusChar;
    document.getElementById('predikat'+i).value = nilaihuruf;
    document.getElementById('rerataGab'+i).value = maximusCharGab;
    document.getElementById('predikatGab'+i).value = nilaihurufGab;
    document.getElementById('tt'+i).value = tortt;
    document.getElementById('deskripsi'+i).value = deskripsi;
    
  }else{
    document.getElementById('rerata'+i).value = "";
    document.getElementById('predikat'+i).value = "";
    document.getElementById('rerataGab'+i).value = "";
    document.getElementById('predikatGab'+i).value = "";
    document.getElementById('tt'+i).value = "";
    document.getElementById('deskripsi'+i).value = "";
  }
}
}
</script>

@endif

@if(Session::has('reload'))
<script type="text/javascript">
  $(document).ready(function(){window.setTimeout(function() {
    document.getElementById('autoadd').click();}, 0);
  });
</script>
@endif

<script type="text/javascript">
  function kelasTrigger(){
    $('select[id="pilihPelajaran"]').attr("disabled", true);

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var kelasTerpilih = $('#pilihKelas option:selected').val(); 

      var dataString = "kelasTerpilih="+kelasTerpilih;
      var alamat = "{{URL('caripelajaran')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;
        $('select[id="pilihPelajaran"]').attr("disabled", false);
        // Get the raw DOM object for the select box
        select = document.getElementById('pilihPelajaran');

        
        // Clear the old options
        select.options.length = 0;
        
        // Load the new options
        options = data.options;
        for (index = 0; index < options.length; ++index) {
          option = options[index];
          select.options.add(new Option(option.text, option.value));
        }
            }
            
        }); 

}
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
