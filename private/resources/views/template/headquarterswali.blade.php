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

  <style type="text/css">
    th {
      text-align: center;
    }
  </style>
 
</head>

<body class="hold-transition skin-green sidebar-mini" @if(Request::is('hasil/cetakleger')) onload="execute();" @elseif(Request::is('hasil/cetakraportuas') or Request::is('hasil/cetakraportuts')) onload="simpanSetelanControl();" @endif>



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
                  {{Auth::user()->username}} - @if(Auth::user()->hak_akses !="1") Wali Kelas @else Admin @endif
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
              @if(Auth::user()->hak_akses != "1")
              <div class="pull-left">
                <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#exampleModal">Masuk sbg guru</button>
              </div>
              @endif

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

      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="@if(Request::is('home') or Request::is('admin/home')) active @endif">
          <a href="{{URL::asset('/home')}}">
            <i class="fa fa-home"></i>
            <span>Home @if(Auth::user()->hak_akses == "1") - Halaman Admin @endif</span>
          </a>
        </li>

        <li class="@if(Request::is('wali/manajemensiswa')) active @endif">
          <a href="{{URL::asset('/wali/manajemensiswa')}}">
            <i class="fa fa-users"></i>
            <span>Manajemen Siswa</span>
          </a>
        </li>

        <li class="@if(Request::is('identitas/*')) or Request::is('identitas/*/*')) or Request::is('identitas/*/*/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-sticky-note"></i>
            <span>Identitas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('identitas/daftarhadir&eksul') or Request::is('identitas/daftarhadir&eksul/*/*')) active @endif">
            <a href="{{URL::asset('/identitas/daftarhadir&eksul')}}">
              <i class="fa fa-circle-o"></i>
              Daftar Hadir & Eksul
            </a>
            </li>

            <li class="@if(Request::is('identitas/cekdeskripsisikap') or Request::is('identitas/cekdeskripsisikap/*/*')) active @endif">
              <a href="{{URL::asset('/identitas/cekdeskripsisikap')}}">
                <i class="fa fa-circle-o"></i>
                Cek Deskripsi Sikap
              </a>
            </li>
          </ul>
        </li>
        
        <li class="@if(Request::is('hasil/*') or Request::is('hasil/*/*') or Request::is('hasil/*/*/*')) active @endif treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Hasil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Request::is('hasil/cetakleger') or Request::is('hasil/cetakleger/*/*')) active @endif"><a href="{{URL::asset('/hasil/cetakleger')}}"><i class="fa fa-circle-o"></i>Cetak Leger</a></li>

            <li class="@if(Request::is('hasil/cetakraportuts')) active @endif">
              <a href="{{URL::asset('/hasil/cetakraportuts')}}"><i class="fa fa-circle-o"></i>Cetak Raport UTS</a>
            </li>

            <li class="@if(Request::is('hasil/cetakraportuas')) active @endif">
              <a href="{{URL::asset('/hasil/cetakraportuas')}}"><i class="fa fa-circle-o"></i>Cetak Raport UAS</a>
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

@if(Auth::user()->hak_akses != "1")
<div class="example-modal">
        <div class="modal fade modal modal-success" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masuk Sebagai Guru</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'homelanding/','enctype'=>'multipart/form-data','id'=>'super'))}}
                   <div class="form-group">                  
                    {{Form::label('pilihpelajaran','Pilih Pelajaran',['class'=>'control-label'])}}                   
                     <select name="pilihpelajaran" id="katjurusan" class="form-control select2" style="width: 100%">
                     @foreach(Session::get('pilihPelajaran') as $step)
                          <option value="{{$step->id}}">{{$step->namapelajaran}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="form-group">                  
                    {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label'])}}                   
                     <select name="pilihkelas" id="katjurusan" class="form-control select2" style="width: 100%">
                     @foreach(Session::get('pilihKelas') as $step)
                          <option value="{{$step->id}}">{{$step->namakelas}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-flat">Eksekusi</button>            
              </div>
              {{Form::close()}}
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

@endif

      <div class="example-modal">
        <div class="modal fade modal modal-danger" id="waitconfirmation" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="closefailed" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><p id="pesan2"></p></h4>
              </div>
              <div class="modal-body">
              
              <div style="text-align: center"><p><h4 id="heading">Pilih Kelas</h4></p></div>
              <div class="form-group">                   
                <select id="daftarkelas" name="daftarkelas" class="form-control" aria-hidden="true" onchange="callsiswa();" style="width: 100%;">
                  @foreach(Session::get('daftarmigrasikonfirmasi') as $daftarmigrasi)
                    <option value="{{$daftarmigrasi->kelaslama}}">{{$daftarmigrasi->namakelas}} - {{$daftarmigrasi->namaguru}}</option>
                  @endforeach
                </select>
                              
                </div>  

              <div class="table-responsive">
           
              <table id="daftarsiswa" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                </table>
                </div>
               

                <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat pull-left" onclick="tolak();" id="tolak">Tolak</button> 
                <button type="button" class="btn btn-success btn-flat" onclick="konfirmasi();" id="konfirmasi">Konfirmasi</button>          
              </div>
              </div>             
            </div>
          </div>
        </div>
      </div>



  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    Sistem Informasi Manajemen Nilai Siswa <strong>{{session()->get('nama')}}</strong>
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




<!--==============================ANIMASI BOX===================================-->

@if($errors->all() and !$errors->has('file'))
<script>
  $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('daftarkelas').click();}, 0);
            });
</script>

@elseif(Auth::check())
<script>
            $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('coll').click();}, 0);
            });
</script>
@endif
 <script>
var buttons = document.getElementById("adding");
var button = document.getElementById("daftarkelas")
buttons.onclick = function(){
 document.getElementById ('coll').click();
 button.click();
}
</script>

<!--=============================================================================-->

@if($errors->has('file'))
<script type="text/javascript">
   $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('importing').click();}, 0);
            });
</script>
@endif


<!--==================JQUERY UNTUK SELECT DATA ARRAY SKIN========================-->

<script type="text/javascript">
  function callsiswa(){
       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});    
      var id_kelas = document.getElementById('daftarkelas').value;
      var dataString = "id_kelas="+id_kelas;
      var alamat = "{{URL('wali/manajemensiswa/waitingconfirmation')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data: dataString,
            success: function(data){
              var trHTML = '';
              var no = 0;
              var nama, nisn;

              $("#daftarsiswa tbody tr").remove();              
              $.each(data.nama, function (i, item) {
              no++;            
              trHTML += '<tr><td>' + no + '</td><td>' + data.nama[i] + '</td><td>' + data.nisn[i] + '</td></tr>';
        });
              $('#daftarsiswa tbody').append(trHTML);
            }           
        }); 
  }
</script>

<script type="text/javascript">
  function tolak(){
       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});    
      var id_kelas = document.getElementById('daftarkelas').value;
      var dataString = "id_kelas="+id_kelas;
      var alamat = "{{URL('wali/manajemensiswa/cancelconfirmation')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data: dataString,
            success: function(data){
              $('#daftarkelas').hide();
              $('#daftarsiswa').hide();
              $('#konfirmasi').hide();
              $('#tolak').hide();
              document.getElementById('heading').innerHTML = "SUKSES!";

              $(document).ready(function(){
                window.setTimeout(function() {                  
                  clear();
             }, 1000);
            });


            }           
        }); 
  }
</script>


<script type="text/javascript">
function clear(){
       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});
  var alamat = "{{URL('clean')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            success: function(data){
              var options, status, index, select, option, no;

              if (data.status == 0) {
                document.getElementById('heading').innerHTML = "Kosong";
                document.getElementById('migrasikonfirmasi').innerHTML = 0;
              }else{
                $('#daftarkelas').show();
                  $('#daftarsiswa').show();
                  $('#konfirmasi').show();
                  $('#tolak').show();
                  document.getElementById('migrasikonfirmasi').innerHTML = data.no;
                  // Get the raw DOM object for the select box
                  select = document.getElementById('daftarkelas');        
                  // Clear the old options
                  select.options.length = 0;
        
                  // Load the new options
                  options = data.options;
                  for (index = 0; index < options.length; ++index) {
                    option = options[index];
                    select.options.add(new Option(option.text, option.value));
                  }
                  callsiswa();
              }
            }            
        });
}

</script>


<script type="text/javascript">
  function konfirmasi(){
       $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});    
      var id_kelas = document.getElementById('daftarkelas').value;
      var dataString = "id_kelas="+id_kelas;
      var alamat = "{{URL('wali/manajemensiswa/okconfirmation')}}";

        $.ajax({
            type: 'POST',
            url: alamat,
            data: dataString,
            success: function(data){
              $('#daftarkelas').hide();
              $('#daftarsiswa').hide();
              $('#konfirmasi').hide();
              $('#tolak').hide();
              document.getElementById('heading').innerHTML = "SUKSES!";

              $(document).ready(function(){
                window.setTimeout(function() {                  
                  clear();
             }, 1000);
            });
            }           
        }); 
  }
</script>

 
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



<!--==============================================================================-->
@if(Request::is('identitas/daftarhadir&eksul'))
<script type="text/javascript">
  for (var i=1; i<={{$no}}; i++) {
    $("#sakit"+i).inputmask("9[9]",{autoUnmask:true});
    $("#ijin"+i).inputmask("9[9]",{autoUnmask:true}); 
    $("#alpha"+i).inputmask("9[9]",{autoUnmask:true});

    $("#nilai1"+i).inputmask("a",{autoUnmask:true});
    $("#nilai2"+i).inputmask("a",{autoUnmask:true});
    $("#nilai3"+i).inputmask("a",{autoUnmask:true});
  }
</script>
@endif

<!--========================JQUERY UNTUK SKIN TABLE DLL===============================-->
<script>
  $(function () {
    $("#example1").DataTable();
  });

   $('#datepicker').datepicker({
       autoclose:true, format: 'dd-MM-yyyy'

    });

   $('#datepicker2').datepicker({
       autoclose:true,format: 'dd-MM-yyyy'

    });
</script>
<!--==============================================================================-->


<script>
$(".js-example-placeholder-single").select2({
  placeholder: "ASAS",
  allowClear: true
});
</script>

@if(Request::is('hasil/cetakleger'))
<script>
var jumlah = 0, rerata ;
function execute(){
  for (var i = 1; i <= {{$row}}; i++) {
    jumlah = 0;
    for (var s = 1; s <= {{$cell}}; s++) {
      jumlah = parseInt(jumlah) + parseInt(document.getElementById('cell'+i+s).value);
      if (s == {{$cell}}) {
        rerata = jumlah / {{$cell}};
        rerata = Math.round(rerata);
        document.getElementById('jumlah'+i).value = jumlah;
        document.getElementById('rerata'+i).value = rerata;
      }
    }
  }

}

</script>
@endif

<script>
  $(function () {
    //Initialize Select2 Elements
    
    $(".select2").select2();  
    $("#nis").inputmask("9999", {"placeholder": "xxxx"});
    $("#nisn").inputmask("9999999999", {"placeholder": "xxxxxxxxxx"});
    $("#nomortelepon").inputmask("9999[99999999]");
    $("#nomorteleponortu").inputmask("9999[99999999]");
    $("#nomorteleponwali").inputmask("9999[99999999]");
  });
  </script>

<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
})
</script>

@if(Request::is('kompentensi/*'))
<script type="text/javascript">

  $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('sidebartoggle').click();}, 0);
            });
</script>
@endif

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


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
