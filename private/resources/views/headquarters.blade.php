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
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{URL::asset('/dist/css/skins/skin-green.min.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">



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
              <img src="{{URL::asset('/private/storage/app/boss-512.png')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->username}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{URL::asset('/private/storage/app/boss-512.png')}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->username}} - Admin
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
              <div class="pull-left">
               

                <div class="btn-group">

                  <a href="{{URL('/manajemenadmin/admin')}}"><button type="button" class="btn btn-success btn-flat">Kelola Admin</button></a>

                  <button type="button" data-toggle = "modal" data-target = "#loginsebagai" class="btn btn-warning btn-flat dropdown-toggle pull-right">
                    <i class="fa fa-users"></i>
                  </button>
                </div>



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
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
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
          <img src="{{URL::asset('/private/storage/app/boss-512.png')}}" class="img-circle" alt="User Image">
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
        <li class="@if(Request::is('home')) active @endif">
          <a href="{{URL::asset('/home')}}">
            <i class="fa fa-home"></i>
            <span>Home</span>
          </a>
        </li>

         <li class="@if(Request::is('manajemenpelajaran/*')) or Request::is('manajemenpelajaran/*/*')) or Request::is('manajemenpelajaran/*/*/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Manajemen Pelajaran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('manajemenpelajaran/datapelajaran') or Request::is('manajemenpelajaran/datapelajaran/*/*')) active @endif">
            <a href="{{URL::asset('/manajemenpelajaran/datapelajaran')}}">
              <i class="fa fa-circle-o"></i>
              Data Pelajaran
            </a>
            </li>
           
        
            <li class="@if(Request::is('manajemenpelajaran/manajemendatadasarnilai') or Request::is('manajemenpelajaran/manajemendatadasarnilai/*/*')) active @endif">
            <a href="{{URL::asset('/manajemenpelajaran/manajemendatadasarnilai')}}">
              <i class="fa fa-circle-o"></i>
              Data Dasar Nilai
            </a>
            </li>

             <li class="@if(Request::is('manajemenpelajaran/kelompokpelajaran') or Request::is('manajemenpelajaran/kelompokpelajaran/*/*/*')) active @endif">
            <a href="{{URL::asset('/manajemenpelajaran/kelompokpelajaran')}}">
              <i class="fa fa-circle-o"></i>
              Data Kelompok Pelajaran
            </a>
            </li>

            </ul>
        </li>

        <li class="@if(Request::is('manajemenguru/*')) or Request::is('manajemenguru/*/*')) or Request::is('manajemenguru/*/*/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i>
            <span>Manajemen Guru</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('manajemenguru/dataguru') or Request::is('manajemenguru/dataguru/*/*')) active @endif">
            <a href="{{URL::asset('/manajemenguru/dataguru')}}">
              <i class="fa fa-circle-o"></i>
              Data Guru
            </a>
            </li>

            <li class="@if(Request::is('manajemenguru/datamengajar') or Request::is('manajemenguru/datamengajar/*/*')) active @endif">
              <a href="{{URL::asset('/manajemenguru/datamengajar')}}">
                <i class="fa fa-circle-o"></i>
                Data Mengajar
              </a>
            </li>

             <li class="@if(Request::is('manajemenguru/datamengajarkelas') or Request::is('manajemenguru/datamengajarkelas/*/*')) active @endif">
              <a href="{{URL::asset('/manajemenguru/datamengajarkelas')}}">
                <i class="fa fa-circle-o"></i>
                Data Mengajar Kelas
              </a>
            </li>
          </ul>
        </li>

        <li class="@if(Request::is('manajemensiswa/*')) or Request::is('manajemensiswa/*/*')) or Request::is('manajemensiswa/*/*/*')) active @endif treeview">
          <a href="{{URL::asset('/manajemensiswa/datasiswa')}}">
            <i class="fa fa-users"></i>
            <span>Manajemen Siswa</span>
          </a>     
        </li>


        
        <li class="@if(Request::is('manajemenkelas/*')) or Request::is('manajemenkelas/*/*')) or Request::is('manajemenkelas/*/*/*')) active @endif treeview">
          <a href="{{URL::asset('/manajemenkelas/datakelas')}}">
            <i class="fa fa-university"></i>
            <span>Manajemen Kelas</span>
          </a>
        </li>

        <li class="@if(Request::is('manajemenkaryawan') or Request::is('manajemenkaryawan/*') or Request::is('manajemenkaryawan/*/*')) active @endif treeview">
           <a href="#">
            <i class="fa fa-user-md"></i>
            <span>Manajemen Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

           <li class="@if(Request::is('manajemenkaryawan')) active @endif">
            <a href="{{URL::asset('/manajemenkaryawan')}}">
              <i class="fa fa-circle-o"></i>
              Data Karyawan
            </a>
            </li>

             <li class="@if(Request::is('manajemenkaryawan/datakelasbk')) active @endif">
            <a href="{{URL::asset('/manajemenkaryawan/datakelasbk')}}">
              <i class="fa fa-circle-o"></i>
              Data Kelas BK
            </a>
            </li>           
          </ul>
        </li>

         <li class="treeview">
           <a href="#">
            <i class="fa fa-plus-square"></i>
            <span>Ekstras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

            <li class="#" onclick="rataRata();" data-target="#menuangkatan" data-toggle="modal">
              <a href="#">
                <i class="fa fa-deviantart"></i>
                <span>Rata-Rata</span>
              </a>
            </li>

            <li class="#" onclick="transferNilaiGuru();" data-target="#modalTransfer" data-toggle="modal">
              <a href="#">
                <i class="fa fa-send"></i>
                <span>Transfer Nilai</span>
              </a>
            </li>
                   
          </ul>
        </li>

        
        
        <li class="@if(Request::is('datamadrasah')) active @endif treeview">
          <a href="{{URL::asset('datamadrasah')}}">
            <i class="fa fa-info-circle"></i>
            <span>Data Madrasah</span>
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

<!-- ==============================================MODAL UNTUK MENAMPILKAN  TAWARAN LOGIN SEBAGAI APA==================================================== -->
      <div class="example-modal" >
        <div class="modal fade modal modal-warning" id="loginsebagai" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masuk Sebagai ?</h4>
              </div>
              <div class="modal-body">
                              
                  <button type="button" class="btn btn-app btn-flat" data-target="#pilihankelas" data-toggle="modal" data-dismiss="modal" style="width: 174px;height: 150px"><i class="fa fa-university" ></i><p style="font-weight: 600;font-size: 25px">Wali Kelas</p></button>

                  <button type="button" class="btn btn-app btn-flat" style="width: 174px;height: 150px" data-toggle="modal" data-target="#kelasdanpelajaran" data-dismiss="modal"><i class="fa fa-user" ></i><p style="font-weight: 600;font-size: 25px">Guru</p></button>

                  <button type="button" class="btn btn-app btn-flat" style="width: 174px;height: 150px" data-toggle="modal" data-target="#modalBk" data-dismiss="modal" onclick="kelasTrigger();"><i class="fa fa-user-md" ></i><p style="font-weight: 600;font-size: 25px">BK</p></button>

                  <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right btn-flat" data-dismiss="modal">Close</button>
              
              </div>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
<!-- ==============================================MODAL UNTUK MENAMPILKAN  TAWARAN LOGIN SEBAGAI APA==================================================== -->

<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR KELAS (AS WALI KELAS)==================================================== -->
      <div class="example-modal" >
        <div class="modal fade modal modal-warning" id="pilihankelas" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Kelas</h4>
              </div>
              <div class="modal-body">
            
                 <div class="form-group">
                   <select class="form-control select2" id="pilihankelas" style="width: 100%">
                      @foreach(Session::get('daftarkelas') as $data)
                        <option value="{{Crypt::encrypt($data->id_guru)}}">{{$data->namakelas}}</option>
                      @endforeach
                   </select>
                 </div>        
              
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-right btn-flat" onclick="SubmitWaliTrigger();">Submit</button>
                  <button type="button" class="btn btn-default pull-left btn-flat" data-toggle="modal" data-target="#loginsebagai" data-dismiss="modal">Kembali</button>
                </div>
             
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR KELAS (AS WALI KELAS)==================================================== -->

<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR KELAS DAN PELAJARAN==================================================== -->
<div class="example-modal">
        <div class="modal fade modal modal-success" id="kelasdanpelajaran" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Kelas dan Pelajaran</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'admin/setguru','enctype'=>'multipart/form-data'))}}
                   <div class="form-group">                  
                    {{Form::label('pilihpelajaran','Pilih Pelajaran',['class'=>'control-label'])}}                   
                     <select name="pilihpelajaran" id="menupelajaran" class="form-control select2" style="width: 100%">

                     @foreach(session()->get('daftarpelajaran') as $step1)
                             <option value="{{$step1->id}}">{{$step1->namapelajaran}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="form-group">                  
                    {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label'])}}                   
                     <select name="pilihkelas" id="menukelas" class="form-control select2" style="width: 100%">
                     @foreach(Session::get('daftarkelas') as $step1)
                             <option value="{{$step1->id}}">{{$step1->namakelas}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left btn-flat" data-toggle="modal" data-target="#loginsebagai" data-dismiss="modal">Kembali</button>
                  <button type="button" class="btn btn-success btn-flat" onclick="findguru();" data-dismiss="modal">Eksekusi</button> 
                </div>


              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR KELAS DAN PELAJARAN==================================================== -->

<!-- ==============================================MODAL UNTUK MENAMPILKAN  ERROR GURU NOT FOUND==================================================== -->
      <div class="example-modal" >
        <div class="modal fade modal modal-danger" id="gurunotfound" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kesalahan</h4>
              </div>
              <div class="modal-body">
                              
                  <h1 align="center">Opps...</h1><h4 align="center">Guru untuk pelajaran pada kelas yang dipilih belum ada</h4>

                  <div class="modal-footer">
               <button type="button" style="display: none" id="errordismiss" data-dismiss="modal"></button>
              
              </div>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
<!-- ==============================================MODAL UNTUK MENAMPILKAN  ERROR GURU NOT FOUND==================================================== -->

<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR GURU==================================================== -->
<div class="example-modal">
        <div class="modal fade modal modal-success" id="daftarguru" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tentukan Guru <b id="namapelajaran"></b> Untuk Kelas <b id="namakelas"></b></h4>
              </div>
              <div class="modal-body">
                
                   <div class="form-group">                  
                    {{Form::label('pilihpelajaran','Pilih Guru',['class'=>'control-label'])}}                   
                     <select name="daftarguru" id="choosetheguru" class="form-control select2" style="width: 100%">

                    
                  </select>  
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success btn-flat">Eksekusi</button> 
                {{Form::close()}}
                </div>


              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

<!-- ==============================================MODAL UNTUK MENAMPILKAN  DAFTAR GURU==================================================== -->

<!-- ==============================================MODAL UNTUK MENAMPILKAN MENU RATA-RATA==================================================== -->
<div class="example-modal">
        <div class="modal fade modal modal-success" id="menuangkatan" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Angkatan dan Semester<p id="jajal"></p></h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'rerata','enctype'=>'multipart/form-data'))}}
                <div class="form-group">                  
                    {{Form::label('tahun','Pilih Angkatan',['class'=>'control-label'])}}                   
                     <select name="angkatan" id="angkatan" class="form-control select2" style="width: 100%">
                      @foreach(Session::get('dataTahun') as $tahun)
                        <option>{{$tahun}}</option>
                      @endforeach
                    </select>  
                </div>

                <div class="form-group">
                {{Form::label('semester','Pilih Semester',['class'=>'control-label'])}}   
                  <div class="form-control">
                  @for($i=1 ; $i<=6 ; $i++)
                    <label>
                      <input type="checkbox" class="flat-red form-control" id="semester" name="semester[]" value="{{$i}}">{{$i}}
                    </label>
                  @endfor
                  </div>
                
                   
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-success btn-flat" id="eksekusi" disabled="disabled">Unduh Excel</button> 
                {{Form::close()}}
                </div>


              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

<!-- ==============================================MODAL UNTUK MENAMPILKAN MENU RATA-RATA==================================================== -->

<!-- ==============================================MODAL UNTUK MENU MASUK SEBAGAI BK==================================================== -->
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
                  {{Form::open(array('role'=>'form','url'=>'admin/bk/processor','enctype'=>'multipart/form-data'))}}
                  {{Form::hidden('urlnow',Request::getPathInfo(),['class'=>'form-control'])}}
                <div class="form-group">
                  {{Form::label('pilihkelas', 'Pilih Kelas',['class'=>'control-label'])}}
                  <select class="form-control select2" name="pilihKelas" id="pilihKelas" style="width: 100%" onchange="kelasTrigger();">
                  @foreach(Session::get('daftarkelas') as $kelasBk)
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
<!-- ==============================================MODAL UNTUK MENU MASUK SEBAGAI BK==================================================== -->

<!-- ==============================================MODAL UNTUK MENU TRANSFER NILAI==================================================== -->

   <div class="example-modal" >
        <div class="modal fade modal modal-success" id="modalTransfer" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transfer Nilai</h4>
              </div>
              <div class="modal-body">
              <h3 style="display: none;text-align: center;" id="pesanKonfirmasi"></h3>
      
                <div class="form-group">
                  {{Form::label('pilihguru', 'Pilih Guru',['class'=>'control-label', 'id'=>'pilihguru'])}}
                  <select class="form-control select2" name="pilihGuruTransfer" id="pilihGuruTransfer" style="width: 100%" onchange="transferNilaiGuru();">
                  @foreach(Session::get('transferNilai') as $transfer)
                    <option value="{{$transfer->id_guru}}">{{$transfer->namaguru}}</option>
                  @endforeach
                  </select>
                </div>

                <div class="form-group">
                  {{Form::label('pilihpelajaran','Pilih Pelajaran',['class'=>'control-label', 'id'=>'pilihpelajaran'])}}
                  <select id="pilihPelajaranTransfer" name="pilihPelajaranTransfer" class="form-control select2" style="width: 100%" disabled="disabled" onchange="transferNilaiPelajaran();">
                    
                  </select>
                </div>

                 <div class="form-group">
                  {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label', 'id'=>'pilihkelas'])}}
                  <select id="pilihKelasTransfer" name="pilihKelasTransfer" class="form-control select2" style="width: 100%" disabled="disabled">
                    
                  </select>
                </div>

                 <div class="form-group">
                  {{Form::label('pilihgurutertuju','Pilih Guru yang Dituju',['class'=>'control-label', 'id'=>'pilihgurutertuju'])}}
                  <select id="pilihGuruTertujuTransfer" name="pilihGuruTertujuTransfer" class="form-control select2" style="width: 100%" disabled="disabled">
                    
                  </select>
                </div>
                

                <div class="modal-footer">
                  <button type="button" class="btn btn-success pull-right btn-flat" onclick="konfirmasiTransfer();" id="transferEksekusi" disabled="disabled">Eksekusi</button>       <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal" id="transferClose">Close</button>

                  <button type="button" class="btn btn-success pull-right btn-flat" id="transferYa" style="display: none" onclick="transferSetuju();">Ya</button>
                  <button type="button" class="btn btn-danger pull-left btn-flat" id="transferTidak" style="display: none" onclick="transferBatal();">Tidak</button>

                  <button type="button" class="btn btn-success pull-right btn-flat" id="transferYa2" style="display: none" onclick="jalankanTransferNilai();">Ya</button>
                  <button type="button" class="btn btn-danger pull-left btn-flat" id="transferTidak" style="display: none" onclick="transferBatal();">Tidak</button>

                  <button type="button" class="btn btn-warning pull-left btn-flat" id="transferKembali" style="display: none" onclick="transferBatal();">Kembali</button>
                  <button type="button" class="btn btn-success pull-right btn-right" id="transferTutup" style="display: none" onclick="transferBatal();" data-dismiss="modal">Tutup</button>
                </div>
                

              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

<!-- ==============================================MODAL UNTUK MENU TRANSFER NILAI==================================================== -->



  <!-- Main Footer -->
  <footer class="main-footer">
     Sistem Informasi Manajemen Nilai Siswa <b>{{session()->get('nama')}}</b>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <div class="pull-left" style="margin-left: 10px">
      <li class="active"><h2>Pengaturan</h2></li>
    </div>
    </ul>
    <!-- Tab panes -->
     @php
        $semesters = array('1/Ganjil', '2/Genap');
        $ajaran = array('2013/2014','2014/2015','2015/2016','2016/2017','2017/2018','2018/2019','2019/2020');
        $analisis = array('0', '1');
      @endphp
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <ul class="control-sidebar-menu">
          <li>
             <a href="#">
                  <div class="form-group">                  
                    {{Form::label('semester','Semester Saat Ini',['class'=>'control-label'])}}                   
                     <select name="semestering" id="semestering" class="form-control">
                      @foreach($semesters as $semester)
                        <option value="{{$semester}}" @if($semester == Session()->get('semester')) selected='selected' @endif>{{$semester}}</option>
                      @endforeach
                  </select>
                       
                </div>
         
              
          
           
          </li>
        </ul>
        <ul class="control-sidebar-menu">
          <li>
             <a href="#">
            <div class="form-group">                  
                    {{Form::label('tahunajaran','Tahun Ajaran',['class'=>'control-label'])}}                   
                     <select name="tahunajaran" id="tahunajaran" class="form-control">
                    @foreach($ajaran as $ajarans)
                      <option value="{{$ajarans}}" @if($ajarans == Session()->get('tahunajaran')) selected='selected' @endif>{{$ajarans}}</option>
                    @endforeach
                    
                  </select>
                         
                </div>
          </li>
        </ul>

         <ul class="control-sidebar-menu">
          <li>
             <a href="#">
            <div class="form-group">                  
                    {{Form::label('tahunajaran','Analisis Kenaikan Kelas',['class'=>'control-label'])}}                   
                     <select name="tahunajaran" id="analisis" class="form-control">
                    @foreach($analisis as $analis)
                      <option value="{{$analis}}" @if($analis == Session()->get('analisis')) selected='selected' @endif>@if($analis == 0)Hanya Semester 2 @else Kedua Semester @endif</option>
                    @endforeach
                    
                  </select>
                         
                </div>
         
              

          </li>
        </ul>

        <ul class="control-sidebar-menu">
          <li>
             <a href="#">
            <div class="form-group">                  
                    {{Form::label('formatkkm','Format KKM',['class'=>'control-label'])}}                   
                     <select name="formatkkm" id="formatkkm" class="form-control">
                    @foreach($analisis as $analis)
                      <option value="{{$analis}}" @if($analis == Session()->get('formatKKM')) selected='selected' @endif>@if($analis == 0)Satu KKM @else Tiga KKM @endif</option>
                    @endforeach
                    
                  </select>
                         
                </div>
         
              

          </li>
        </ul>

        <ul class="control-sidebar-menu">
          <li>
             <a href="#">
                       {{Form::label('tahunajaran','MAX Pelajaran Tak Mencapai KKM',['class'=>'control-label'])}}    
                    <input type="text" class="knob" id="max" value="{{Session::get('max')}}" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#00a65a">
        
           
          </li>
          <button type="button" id="add" class="btn btn-success btn-flat" style="margin-left: 10px" data-dismiss="modal" style="margin-top: 10px">Simpan</button>
        </ul>

        <!-- /.control-sidebar-menu -->

       
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
     
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
     
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- =================================================BUTTON TRIGGER MODALS======================================================= -->
<button type="button" style="display: none" id="showerror" data-toggle="modal" data-target="#gurunotfound"></button>
<button type="button" style="display: none" id="showdaftarguru" data-toggle="modal" data-target="#daftarguru"></button>

<!-- =================================================BUTTON TRIGGER MODALS======================================================= -->



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
<script src={{URL::asset('/plugins/knob/jquery.knob.js')}}></script>


<!-- AdminLTE App -->
<script src={{URL::asset('/dist/js/app.min.js')}}></script>

<script>
  $('input').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>

<script type="text/javascript">
$(document).ready(function(){

$('input[id="comando"]').on('ifChecked', function(event){
  $('input[id="pilihsiswa"]').iCheck('check');
  $('input[id="comando"]').iCheck('check');
});

$('input[id="comando"]').on('ifUnchecked', function(event){
  $('input[id="pilihsiswa"]').iCheck('uncheck');
  $('input[id="comando"]').iCheck('uncheck');
});

$('input[id="pilihsiswa"]').on('ifChanged', function(event){

  var checklength = document.querySelectorAll('input[id="pilihsiswa"]:checked').length;
  if (checklength != 0) {
      document.getElementById('bulkoption').disabled = false;
      document.getElementById('counter').innerHTML = checklength;
    }else{
      document.getElementById('bulkoption').disabled = true;
    }
});

});
</script>

<!--==================JQUERY UNTUK SELECT DATA ARRAY SKIN========================-->
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    $("#add").click(function() {
      var smstr = document.getElementById('semestering').value;
      var thn = document.getElementById('tahunajaran').value;
      var analisis = document.getElementById('analisis').value;
      var max = document.getElementById('max').value;
      var formatKKM = document.getElementById('formatkkm').value;

      var dataString = "semester="+smstr+"&tahunajaran="+thn+"&analisis="+analisis+"&jumlah="+max+"&formatKKM="+formatKKM;
      var alamat = "{{URL('pengaturan')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data) {
               alert('Pengaturan berhasil disimpan');
            }
        });
    });
</script>

<script>
  $(function () {
    $("#example1").DataTable();
  });

   $('#datepicker').datepicker({
       autoclose:true, format: 'dd MM yyyy'

    });

   $('#datepicker2').datepicker({
       autoclose:true, format: 'dd MM yyyy'

    });

</script>

<script type="text/javascript">
  function SubmitWaliTrigger(){
    var id = $('#pilihankelas option:selected').val();
    window.location = "{{URL('/admin/as/waliprocessor')}}/"+id;
  }
</script>

<script type="text/javascript">
function rataRata(){
   var scanAngkatan = $('#angkatan option:selected').text();
   if (scanAngkatan == "Tidak Tersedia :-(") {
    document.getElementById('eksekusi').disabled = true;
    $('input[id="semester"]').attr("disabled", true);
   }
}
</script>


<!---================================CEK KETERSEDIAAN GURU=======================================-->
<script type="text/javascript">
  function findguru(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var daftarpelajaran = $('#menupelajaran option:selected').val();
      var daftarkelas = $('#menukelas option:selected').val();

      var pelajaranchar = $('#menupelajaran option:selected').text();
      var kelaschar = $('#menukelas option:selected').text();

      var urls = "{{URL('admin/guru/home')}}";

      var dataString = "daftarpelajaran="+daftarpelajaran+"&daftarkelas="+daftarkelas+"&pelajaranchar="+pelajaranchar+"&kelaschar="+kelaschar;
      var alamat = "{{URL('admin/checkguru')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var results, namapelajaran, namakelas;

              if (data.results == 0) {
                document.getElementById('showerror').click();
                setTimeout(alertFunc, 3000);

                document.getElementById('namapelajaran').innerHTML = data.namapelajaran;
                document.getElementById('namakelas').innerHTML = data.namakelas;

              }else{
                window.location = urls;
              }
            }
            
        }); 

}
</script>
<!---================================CEK KETERSEDIAAN GURU=======================================-->

<script type="text/javascript">
  function alertFunc(){
      $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
    
      var daftarpelajaran = $('#menupelajaran option:selected').val();
      var daftarkelas = $('#menukelas option:selected').val();

      var dataString = "daftarpelajaran="+daftarpelajaran+"&daftarkelas="+daftarkelas;
      var alamat = "{{URL('findproperguru')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;

        // Get the raw DOM object for the select box
        select = document.getElementById('choosetheguru');
        
        // Clear the old options
        select.options.length = 0;
        
        // Load the new options
        options = data.options;
        for (index = 0; index < options.length; ++index) {
          option = options[index];
          select.options.add(new Option(option.text, option.value));
        }

        document.getElementById('errordismiss').click();
        document.getElementById('showdaftarguru').click();
            }
            
        }); 




    

    
  }
</script>


<script>
  $(function () {
    //Initialize Select2 Elements
    
    $(".select2").select2();  
    $("#nis").inputmask("9999", {"placeholder": "xxxx"});
    $("#nisn").inputmask("9999999999", {"placeholder": "xxxxxxxxxx"});
    $("#nomortelepon").inputmask("9999[99999999]");
    $("#nomorteleponortu").inputmask("9999[99999999]");
  });
  </script>

  @if(Request::is('manajemenpelajaran/datapelajaran') or Request::is('manajemenpelajaran/datapelajaran/*/*'))
  <script>
  $(function () {
    //Initialize Select2 Elements  
    $("#kkmkelasx").inputmask("99", {"placeholder": "xx"});
    $("#kkmkelasxi").inputmask("99", {"placeholder": "xx"});
    $("#kkmkelasxii").inputmask("99", {"placeholder": "xx"});
  });
  </script>
  @endif

   @if(Request::is('manajemenguru/dataguru') or Request::is('manajemenguru/dataguru/*/*'))
  <script>
  $(function () {
    //Initialize Select2 Elements  
   
  


  });
  </script>
  @endif
<!--==============================================================================-->

@if($errors->has('file'))
<script type="text/javascript">
   $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('importing').click();}, 0);
            });
</script>
@endif

<!--======================JQUERY UNTUK ANIMASI BOX===============================-->
 <script>
var buttons = document.getElementById("adding");
var button = document.getElementById("daftarkelas")
buttons.onclick = function(){
 document.getElementById ('coll').click();
 button.click();
}

function kembali(){
  document.getElementById ('coll').click();
  document.getElementById ('daftarkelas').click();
}
</script>
<!--==============================================================================-->


<!--========================JQUERY UNTUK SKIN TABLE===============================-->
<script>
  $(function () {
    $("#example1").DataTable();
  });

</script>
<!--==============================================================================-->


<script>
$(".js-example-placeholder-single").select2({
  placeholder: "ASAS",
  allowClear: true
});
</script>

<!--====================JQUERY UNTUK PREVIEW GAMBAR===============================-->
<script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#fotoguru").change(function () {
        readURL(this);
    });
</script>
<!--==============================================================================-->


<!--===================JQUERY UNTUK SKIN RADIO FORM===============================-->
<script>
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $('input[id="semester"]').on('ifChanged', function(event){

  var checklength = document.querySelectorAll('input[id="semester"]:checked').length;
  if (checklength != 0) {
      document.getElementById('eksekusi').disabled = false;
    }else{
      document.getElementById('eksekusi').disabled = true;
    }
});
</script>


@if(Request::is('manajemenpelajaran/manajemendatadasarnilai'))
<script type="text/javascript">
   $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>
@endif
<!--==============================================================================-->
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
  

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  
</script>

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

<script type="text/javascript">
  function transferNilaiGuru(){
    document.getElementById('transferEksekusi').disabled=true;
     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var pilihGuruTransfer = $('#pilihGuruTransfer option:selected').val(); 

      var dataString = "pilihGuruTransfer="+pilihGuruTransfer;
      var alamat = "{{URL('caripelajarantransfer')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;
        $('select[id="pilihPelajaranTransfer"]').attr("disabled", false);
        document.getElementById('transferEksekusi').disabled=false;
        // Get the raw DOM object for the select box
        select = document.getElementById('pilihPelajaranTransfer');

        

        
        // Clear the old options
        select.options.length = 0;
        
        // Load the new options
        options = data.options;
        for (index = 0; index < options.length; ++index) {
          option = options[index];
          select.options.add(new Option(option.text, option.value));
        }
        transferNilaiPelajaran();
        transferGuruTertuju();
            }
            
        }); 
   
  }
</script>

<script type="text/javascript">
  function transferNilaiPelajaran(){
    document.getElementById('transferEksekusi').disabled=true;
      $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var pilihGuruTransfer = $('#pilihGuruTransfer option:selected').val(); 
      var pilihPelajaranTransfer = $('#pilihPelajaranTransfer option:selected').val(); 

      var dataString = "pilihGuruTransfer="+pilihGuruTransfer+"&pilihPelajaranTransfer="+pilihPelajaranTransfer;
      var alamat = "{{URL('carikelastransfer')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;
        $('select[id="pilihKelasTransfer"]').attr("disabled", false);
        document.getElementById('transferEksekusi').disabled=false;
        // Get the raw DOM object for the select box
        select = document.getElementById('pilihKelasTransfer');

        
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

<script type="text/javascript">
  function transferGuruTertuju(){

     $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var pilihGuruTransfer = $('#pilihGuruTransfer option:selected').val(); 

      var dataString = "pilihGuruTransfer="+pilihGuruTransfer;
      var alamat = "{{URL('carigurutertuju')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var options, index, select, option;
        $('select[id="pilihGuruTertujuTransfer"]').attr("disabled", false);
        // Get the raw DOM object for the select box
        select = document.getElementById('pilihGuruTertujuTransfer');

        

        
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

<script type="text/javascript">
  function konfirmasiTransfer(){
     $('#pilihGuruTransfer').next(".select2-container").hide();
     $('#pilihPelajaranTransfer').next(".select2-container").hide();
     $('#pilihGuruTertujuTransfer').next(".select2-container").hide();
     $('#pilihKelasTransfer').next(".select2-container").hide();

     $('#pilihguru').hide();
     $('#pilihpelajaran').hide();
     $('#pilihkelas').hide();
     $('#pilihgurutertuju').hide();

     $('#transferEksekusi').hide();
     $('#transferClose').hide();

     $('#transferYa').show();
     $('#transferTidak').show();

     document.getElementById('pesanKonfirmasi').innerHTML = 'Apakah anda yakin untuk mentransfer nilai pelajaran '+$('#pilihPelajaranTransfer option:selected').text()+' di kelas '+$('#pilihKelasTransfer option:selected').text()+' dari guru '+$('#pilihGuruTransfer option:selected').text()+' kepada guru '+$('#pilihGuruTertujuTransfer option:selected').text()+' ?';
     $('#pesanKonfirmasi').show();


  }

  function transferBatal(){
    $('#pilihGuruTransfer').next(".select2-container").show();
     $('#pilihPelajaranTransfer').next(".select2-container").show();
     $('#pilihGuruTertujuTransfer').next(".select2-container").show();
     $('#pilihKelasTransfer').next(".select2-container").show();

     $('#pilihguru').show();
     $('#pilihpelajaran').show();
     $('#pilihkelas').show();
     $('#pilihgurutertuju').show();

     $('#transferEksekusi').show();
     $('#transferClose').show();

     $('#transferYa').hide();
     $('#transferYa2').hide();
     $('#transferTidak').hide();
     $('#pesanKonfirmasi').hide();

     $('#transferKembali').hide();
     $('#transferTutup').hide();

     clearInterval(engine);
  }
  var engine = {}, pelajaran2={}, kelas2={};

  function transferSetuju(){
    var wait = '';
    engine = window.setInterval( function() {
    
    if ( wait.length > 5 ) 
        wait = "";
    else 
        wait += ".";

    document.getElementById('pesanKonfirmasi').innerHTML = 'Memeriksa'+wait;

    }, 300);

         $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var pilihPelajaranTransfer = $('#pilihPelajaranTransfer option:selected').val(); 
      var pilihKelasTransfer = $('#pilihKelasTransfer option:selected').val();
      var pilihGuruTertujuTransfer = $('#pilihGuruTertujuTransfer option:selected').val();

      var dataString = "pilihPelajaranTransfer="+pilihPelajaranTransfer+"&pilihKelasTransfer="+pilihKelasTransfer+"&pilihGuruTertujuTransfer="+pilihGuruTertujuTransfer;
      var alamat = "{{URL('cekgurutertuju')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var pelajaran, kelas;
              pelajaran2 = data.pelajaran;
              kelas2 = data.kelas;

              if (data.pelajaran == 0 && data.kelas == 0) {
                clearInterval(engine);
                document.getElementById('pesanKonfirmasi').innerHTML = 'Guru '+$('#pilihGuruTertujuTransfer option:selected').text()+' tidak mengajar pelajaran '+$('#pilihPelajaranTransfer option:selected').text()+' dan tidak mengajar di kelas '+$('#pilihKelasTransfer option:selected').text()+'. Tetap lanjutkan ?';
                 $('#transferYa').hide();
                 $('#transferYa2').show();
              }else if(data.pelajaran != 0 && data.kelas == 0){
                  clearInterval(engine);
                  document.getElementById('pesanKonfirmasi').innerHTML = 'Guru '+$('#pilihGuruTertujuTransfer option:selected').text()+' tidak mengajar di kelas '+$('#pilihKelasTransfer option:selected').text()+'. Tetap lanjutkan ?';
                  $('#transferYa').hide();
                  $('#transferYa2').show();
              }else if(data.pelajaran == 0 && data.kelas != 0){
                  clearInterval(engine);
                  document.getElementById('pesanKonfirmasi').innerHTML = 'Guru '+$('#pilihGuruTertujuTransfer option:selected').text()+' tidak mengajar pelajaran '+$('#pilihPelajaranTransfer option:selected').text()+'. Tetap lanjutkan ?';
                  $('#transferYa').hide();
                  $('#transferYa2').show();
              }else if(data.pelajaran != 0 && data.kelas != 0){
                clearInterval(engine);
                jalankanTransferNilai();
              }
        
            }
            
        }); 

  }

  function jalankanTransferNilai(){
     var wait = '';
    engine = window.setInterval( function() {
    
    if ( wait.length > 5 ) 
        wait = "";
    else 
        wait += ".";

    document.getElementById('pesanKonfirmasi').innerHTML = 'Memproses'+wait;

    }, 300);


      $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
    
      var pilihPelajaranTransfer = $('#pilihPelajaranTransfer option:selected').val(); 
      var pilihKelasTransfer = $('#pilihKelasTransfer option:selected').val();
      var pilihGuruTransfer = $('#pilihGuruTransfer option:selected').val();
      var pilihGuruTertujuTransfer = $('#pilihGuruTertujuTransfer option:selected').val();

      var dataString = "pilihPelajaranTransfer="+pilihPelajaranTransfer+"&pilihKelasTransfer="+pilihKelasTransfer+"&pilihGuruTertujuTransfer="+pilihGuruTertujuTransfer+"&pilihGuruTransfer="+pilihGuruTransfer+"&pelajaranToggle="+pelajaran2+"&kelasToggle="+kelas2;
      var alamat = "{{URL('prosestransfernilai')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data:  dataString,
            success: function(data){
              var pesan;

              clearInterval(engine);
              document.getElementById('pesanKonfirmasi').innerHTML = data.pesan;
              $('#transferYa2').hide();
              $('#transferYa').hide();
              $('#transferTidak').hide();
              $('#transferKembali').show();
              $('#transferTutup').show();
        
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
