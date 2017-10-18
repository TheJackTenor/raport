@extends('headquarters')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Madrasah
		<small>{{session()->get('nama')}}</small>
		</h1>
	</section>


	<section class="content">
		

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Manajemen Data Madrasah</h3>
        
              <div class="box-tools pull-right">
              
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>

            </div>
            <!-- /.box-header -->
            <!-- form start {{Form::open(array('role'=>'form','url'=>'/manajemenkelas/datakelas/prosestambahkelas'))}} -->

            {{Form::open(array('role'=>'form','url'=>'datamadrasah/simpan','enctype'=>'multipart/form-data'))}}
              <div class="box-body">
                @if(Session::has('pesan'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    {{Session::get('pesan')}}
                  </div>
                @endif
                <div class="form-group {{ $errors->has('namainstansi') ? 'has-error' : ''}}"> 
                {{Form::label('namainstansi','Nama Instansi',['class'=>'control-label'])}}                    
                {{Form::text('namainstansi',$datas->namainstansi,['placeholder'=>'Masukkan Nama Instansi','class'=>'form-control'])}}

                  @if($errors->has('namainstansi'))
                    <span class="help-block">
                      <strong>{{$errors->first('namainstansi')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('namamadrasah') ? 'has-error' : ''}}">                  
                    {{Form::label('namamadrasah','Nama Madrasah',['class'=>'control-label'])}}                   
                     {{Form::text('namamadrasah',$datas->namamadrasah,['placeholder'=>'Masukkan Nama Madrasah','class'=>'form-control','id'=>'nip'])}}
                    @if($errors->has('namamadrasah'))
                      <span class="help-block">
                        <strong>{{$errors->first('namamadrasah')}}</strong>
                      </span>
                    @endif           
                </div>
              

                <div class="form-group {{$errors->has('nimnsm') ? 'has-error' : ''}}">
                  {{Form::label('nimnsm','NIM/NSM')}}
                  {{Form::text('nimnsm',$datas->nimnsm,['placeholder'=>'Masukkan NIM/NSM','class'=>'form-control'])}}
                    @if($errors->has('nimnsm'))
                    <span class="help-block">
                      <strong>{{$errors->first('nimnsm')}}</strong>
                    </span>
                  @endif                 
                </div> 

                <div class="form-group {{$errors->has('jalan') ? 'has-error' : ''}}">
                  {{Form::label('jalan','Jalan/Desa/Kelurahan')}}
                  {{Form::text('jalan',$datas->jalan,['placeholder'=>'Masukkan Jalan/Desa/Kelurahan','class'=>'form-control'])}}
                    @if($errors->has('jalan'))
                    <span class="help-block">
                      <strong>{{$errors->first('jalan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('desa') ? 'has-error' : ''}}">
                  {{Form::label('desa','Desa/Kelurahan')}}
                  {{Form::text('desa',$datas->desa,['placeholder'=>'Masukkan Desa/Kelurahan','class'=>'form-control'])}}
                    @if($errors->has('desa'))
                    <span class="help-block">
                      <strong>{{$errors->first('desa')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('kecamatan') ? 'has-error' : ''}}">
                  {{Form::label('kecamatan','Kecamatan')}}
                  {{Form::text('kecamatan',$datas->kecamatan,['placeholder'=>'Masukkan Kecamatan','class'=>'form-control'])}}
                    @if($errors->has('kecamatan'))
                    <span class="help-block">
                      <strong>{{$errors->first('kecamatan')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('kodepos') ? 'has-error' : ''}}">
                  {{Form::label('kodepos','Kode Pos')}}
                  {{Form::text('kodepos',$datas->kodepos,['placeholder'=>'Masukkan Kode Pos','class'=>'form-control'])}}
                    @if($errors->has('kodepos'))
                    <span class="help-block">
                      <strong>{{$errors->first('kodepos')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('telepon') ? 'has-error' : ''}}">
                  {{Form::label('telepon','Nomor Telepon')}}
                  {{Form::text('telepon',$datas->telepon,['placeholder'=>'Masukkan Nomor Telepon','class'=>'form-control'])}}
                    @if($errors->has('telepon'))
                    <span class="help-block">
                      <strong>{{$errors->first('telepon')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('kabupaten') ? 'has-error' : ''}}">
                  {{Form::label('kabupaten','Kabupaten/Kota')}}
                  {{Form::text('kabupaten',$datas->kabupaten,['placeholder'=>'Masukkan Kabupaten/Kota','class'=>'form-control'])}}
                    @if($errors->has('kabupaten'))
                    <span class="help-block">
                      <strong>{{$errors->first('kabupaten')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('provinsi') ? 'has-error' : ''}}">
                  {{Form::label('provinsi','Provinsi')}}
                  {{Form::text('provinsi',$datas->provinsi,['placeholder'=>'Masukkan Provinsi','class'=>'form-control'])}}
                    @if($errors->has('provinsi'))
                    <span class="help-block">
                      <strong>{{$errors->first('provinsi')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group {{$errors->has('website') ? 'has-error' : ''}}">
                  {{Form::label('website','Website')}}
                  {{Form::text('website',$datas->website,['placeholder'=>'Masukkan Website','class'=>'form-control'])}}
                    @if($errors->has('website'))
                    <span class="help-block">
                      <strong>{{$errors->first('website')}}</strong>
                    </span>
                  @endif                 
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  {{Form::label('email','Email')}}
                  {{Form::text('email',$datas->email,['placeholder'=>'Masukkan Email','class'=>'form-control'])}}
                    @if($errors->has('email'))
                    <span class="help-block">
                      <strong>{{$errors->first('email')}}</strong>
                    </span>
                  @endif                 
                </div>

                 <div class="form-group">                  
                    {{Form::label('kepalasekolah','Kepala Sekolah',['class'=>'control-label'])}}                   
                     <select name="kepalasekolah" id="katjurusan" class="form-control select2" style="width: 100%;">
                     @foreach($datagurus as $dataguru)
                        <option value="{{$dataguru -> id}}" @if($dataguru -> id == $datas->id_guru) selected='selected' @endif>{{$dataguru -> nip}} - {{$dataguru -> namaguru}}</option>     
                    @endforeach               
                  </select>            
                </div>

                 <div class="form-group {{$errors->has('foto') ? 'has-error' : ''}}">
                  
                  {{Form::label('foto','Unggah Logo Madrasah')}}
                
                  <div class="row">
                    <div class="col-md-2">
                      <img src="{{URL::asset('/private/storage/app')}}/{{$datas->logo}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;margin-bottom: 10px;background:grey;border: 0px;border-radius: 5px;" />
                    </div>
                  </div>                                  
                  <input type="file" id="fotoguru" name="foto" class="validate"/ >
                  <p class="help-block">Ekstensi foto yang diizinan : jpeg, png, bmp, gif, atau svg</p>

                  @if($errors->has('foto'))
                  <span class="help-block">
                    <strong>{{$errors->first('foto')}}</strong>
                  </span>
                  @endif
                </div>   

                   
              
              </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                 {{Form::close()}}               
              </div>
          </div>
          </div>
          </div>

	</section>
</div>


@endsection