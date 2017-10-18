@extends('template/headquarterskaryawan')
@section('content')




<div class="content-wrapper">
	<section class="content-header">
		<h1>Dokumentasi Data Siswa
		</h1>

		<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
	</section>


	<section class="content">
		

  <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Guru</h3>
       
              <div class="box-tools pull-right">             
            <button type="button" id="menu" class="btn btn-success btn-flat" data-toggle="modal" data-target="#exampleModal">Menu</button>          
          </div>
       
            </div>

     
            <div class="box-body">
               {{Form::open(array('role'=>'form','url'=>'send/','enctype'=>'multipart/form-data'))}}
                 
                <div class="form-group"> 
                               
                <input type="email" name="email" placeholder="email">
                <input type="text" name="isi" placeholder="isi">
                            
                </div>          
                <button type="submit" class="btn btn-success">Kirim</button>
               {{csrf_field()}}

                
              {{Form::close()}}
            </div>
          
           
          </div>
        </div>
      </div>

<div class="example-modal">
        <div class="modal fade modal modal-success" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian Data Siswa</h4>
              </div>
              <div class="modal-body">
                {{Form::open(array('role'=>'form','url'=>'homelanding/','enctype'=>'multipart/form-data','id'=>'super'))}}
                 
                  <div class="form-group {{ $errors->has('pilihguru') ? 'has-error' : ''}}"> 
                {{Form::label('daftarsiswa','Pilih Siswa',['class'=>'control-label'])}}                    
                <select id="pilihguru" name="pilihguru" class="form-control select2" aria-hidden="true"  style="width: 100%;">
                 @foreach($daftarsiswa as $data)
                  <option>{{$data -> nisn}} - {{$data -> namasiswa}}</option>
                  @endforeach
                </select>
                            
                </div>          

               

                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Eksekusi</button>            
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
      

  



         



	</section>
</div>


@endsection