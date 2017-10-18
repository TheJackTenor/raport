<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <meta name="csrf-token" content="{{ csrf_token() }}" /> 
        <title>{{Session::get('nama')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/dist/css/skins/skin-blue.min.css')}}">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
           <link rel="stylesheet" href="{{URL::asset('/plugins/select2/select2.min.css')}}">
  <!-- Font Awesome -->
 

        <!-- Styles -->
        <style>
            html, body {
                background-color: #E7E7E6;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a{
                color: #626363;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body @if(Auth::check()) @if(Auth::user()->hak_akses == 6) onload="kelasTrigger();" @endif @endif>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if(Auth::check())
                      @if(Auth::user()->hak_akses == 2 or Auth::user()->hak_akses == 3 or Auth::user()->hak_akses == 6)
                        @if(!Session::has('togglewali') and !Session::has('toggle') or !Session::has('toggleBk'))
                         <button id="opener" type="button" class="btn btn-warning btn-flat" data-toggle="modal" @if(Auth::user()->hak_akses == 2) data-target="#exampleModal" @elseif(Auth::user()->hak_akses == 3) data-target="#exampleModalwali" @elseif(Auth::user()->hak_akses == 6) data-target="#modalBk" @endif>Masuk Sebagai ?</button>

                          <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-danger btn-flat">Sign out</button></a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                        @else
                        <a href="{{ url('/home') }}">Home</a>
                         <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                        @endif
                      @else
                        <a href="{{ url('/home') }}">Home</a>
                         <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                      @endif                       
                    @else
                        <a href="{{ url('/formlogon') }}">Login</a>
                        <a href="{{ url('/siswadaftar') }}">Daftar</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{session()->get('nama')}}
                </div>

                <div class="links">
                    <b>Mewujudkan insan madrasah yang islami, unggul, inklusif dan berwawasan lingkungan</b>
                </div>
            </div>
        </div>

@if(Auth::check())
@if(Auth::user()->hak_akses == 2 or Auth::user()->hak_akses == 3)
<div class="example-modal">
        <div class="modal fade modal modal-success" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Kelas dan Pelajaran</h4>
              </div>
              <div class="modal-body">
              @php
                $pilihPelajaran = session()->get('pilihPelajaran');
                $pilihKelas = session()->get('pilihKelas');
              @endphp

              @if($pilihPelajaran == '[]' or $pilihKelas == '[]')
                <h3 style="text-align: center">Admin belum memasukkan data mengajar pelajaran dan kelas anda. Hubungi admin untuk menyelesaikan permasalahan ini.</h3>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button> 
                </div>

              @else

                {{Form::open(array('role'=>'form','url'=>'homelanding/','enctype'=>'multipart/form-data','id'=>'super'))}}
                
                   <div class="form-group">                  
                    {{Form::label('pilihpelajaran','Pilih Pelajaran',['class'=>'control-label'])}}                   
                     <select name="pilihpelajaran" id="katjurusan" class="form-control select2" style="width: 100%">
                     @php
                      $pilihPelajaran = session()->get('pilihPelajaran');
                      $pilihKelas = session()->get('pilihKelas');
                     @endphp

                     @foreach($pilihPelajaran as $step)
                        <option value="{{$step->id}}">{{$step->namapelajaran}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="form-group">                  
                    {{Form::label('pilihkelas','Pilih Kelas',['class'=>'control-label'])}}                   
                     <select name="pilihkelas" id="katjurusan" class="form-control select2" style="width: 100%">
                     @foreach($pilihKelas as $step)
                        <option value="{{$step->id}}">{{$step->namakelas}}</option>
                     @endforeach
                  </select>  
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success btn-flat">Eksekusi</button> 
                </div>


                {{Form::close()}}


              @endif


                
              </div>
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

        <div class="example-modal" >
        <div class="modal fade modal modal-warning" id="exampleModalwali" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masuk Sebagai ?</h4>
              </div>
              <div class="modal-body">
                              
                  <a href="{{URL('/homelandingwali')}}"><button type="button" class="btn btn-app btn-flat" style="width: 250px;height: 150px"><i class="fa fa-university" ></i><p style="font-weight: 600;font-size: 25px">Wali Kelas</p></button></a>

                  <button type="button" class="btn btn-app pull-right btn-flat" style="width: 250px;height: 150px" data-toggle="modal" data-target="#exampleModal" data-dismiss="modal"><i class="fa fa-user" ></i><p style="font-weight: 600;font-size: 25px">Guru</p></button>

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

@elseif(Auth::user()->hak_akses == 6)

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





@endif

      
    </body>
<script src={{URL::asset('/plugins/jQuery/jquery-2.2.3.min.js')}}></script>
<!-- Bootstrap 3.3.6 -->
<script src={{URL::asset('/plugins/select2/select2.full.min.js')}}></script>
<script src={{URL::asset('/js/bootstrap.min.js')}}></script>

<script type="text/javascript">
  $(".select2").select2();  
</script>

<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
});

  $('#exampleModalwali').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
});

  $('#modalBk').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
});
</script>

@if(Auth::check() and Session::has('toggle') == false || Session::has('togglewali') == false || Session::has('toggleBk') == false)
@if(Auth::user()->hak_akses == 2 or Auth::user()->hak_akses == 3 or Auth::user()->hak_akses == 6)
<script>
  $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('opener').click();}, 0);
            });
</script>
@endif
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
</html>
