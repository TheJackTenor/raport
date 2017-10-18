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

<body class="hold-transition skin-green sidebar-mini" @if(Request::is('hasil/cetakraportuts') or Request::is('hasil/cetakraportuas')) onload="loader();" @elseif(Request::is('hasil/cetakleger')) onload="execute();" @endif>



<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MAN</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{session()->get('nama')}}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" id="sidebartoggle">
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
                  {{Auth::user()->username}} - Siswa
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
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

      <!-- search form (Optional) -->
    
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="@if(Request::is('home')) active @endif">
          <a href="{{URL::asset('/home')}}">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="@if(Request::is('nilai/pengetahuan') or Request::is('nilai/pengetahuan/*')) active @endif">
          <a href="{{URL::asset('/nilai/pengetahuan')}}">
            <i class="fa fa-book"></i>
            <span>Nilai Pengetahuan</span>
          </a>
        </li>
        <li class="@if(Request::is('nilai/keterampilan') or Request::is('nilai/keterampilan/*')) active @endif">
          <a href="{{URL::asset('/nilai/keterampilan')}}">
            <i class="fa fa-book"></i>
            <span>Nilai Keterampilan</span>
          </a>
        </li>
        <li class="@if(Request::is('nilai/spiritual') or Request::is('nilai/spiritual/*')) active @endif">
          <a href="{{URL::asset('/nilai/spiritual')}}">
            <i class="fa fa-book"></i>
            <span>Nilai Spiritual</span>
          </a>
        </li>
        <li class="@if(Request::is('nilai/sosial') or Request::is('nilai/sosial/*')) active @endif">
          <a href="{{URL::asset('/nilai/sosial')}}">
            <i class="fa fa-book"></i>
            <span>Nilai Sosial</span>
          </a>
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
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     
    </div>
    <!-- Default to the left -->
     Sistem Informasi Manajemen Nilai Siswa <strong>{{session()->get('namamadrasah')}}</strong>
  </footer>

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

<script type="text/javascript">

function ganteng(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
     if (document.getElementById('modekelasya').checked) {
      var modekelas = 1;
     }else if(document.getElementById('modekelastidak').checked){
      var modekelas = 0;
     }

      var tanggal2 = document.getElementById('datepicker2').value;
      var tanggal = document.getElementById('datepicker').value;      

      var dataString = "tanggal="+tanggal+"&modekelas="+modekelas+"&tanggal2="+tanggal2;
      var alamat = "{{URL('jajal')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            
        }); 

}


</script>
 
@if(Request::is('nilai/*') and !Session::has('status_pengetahuan'))
<script type="text/javascript">
  $(document).ready(function(){window.setTimeout(function() {
               document.getElementById('menu').click();}, 0);
            });
</script>
@endif

<script>
  $(function () {
    //Initialize Select2 Elements
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    $(".select2").select2();  
   
  });
  </script>



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
