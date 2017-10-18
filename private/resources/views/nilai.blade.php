  @extends('headquarters')
  @section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manajemen Kelas
        <small>Data kelas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelas</h3>
              @if(Session::has('status'))
              @else
              <div class="box-tools pull-right">             
            <button id="daftarkelas" type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>          
          </div>
          @endif
            </div>

            @if(Session::has('status'))

            @else
            <!-- /.box-header -->
            <div class="box-body">
            <style>
    .ssheet_cont {
      
      height: 450px;
      float: left;
    }
  </style>
  <script>
    window.onload = function() {
      var dhx_sh1 = new dhtmlxSpreadSheet({
        load: "{{URL::asset('/codebase/php/data.php')}}",
        save: "{{URL::asset('/codebase/php/data.php')}}",
        parent: "gridobj1",
        math : true,
        icons_path: "../codebase/imgs/icons/",
        autowidth: false,
        autoheight: true
      }); 
      dhx_sh1.load("nilai");
      
    };
  </script>
<div class="form-group">
    <div class="form-control ssheet_cont" id="gridobj1"></div>
</div>


            @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
</div>
      


    </section>


    <!-- /.content -->
  </div>

  @endsection