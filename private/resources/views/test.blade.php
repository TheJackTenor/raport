@extends('headquarters')
@section('content')


<style type="text/css">
  .verticalTableHeader {
    text-align:center;
    white-space:nowrap;
    transform: rotate(-90deg);
}
.verticalTableHeader p {
    margin:0 -999px;/* virtually reduce space needed on width to very little */
    display:inline-block;
}
.verticalTableHeader p:before {
    content:'';
    width:0;
    padding-top:100%;
    /* takes width as reference, + 10% for faking some extra padding */
    display:inline-block;
    vertical-align:middle;
}


.selector {
      word-wrap: break-word;      /* IE 5.5-7 */
      white-space: -moz-pre-wrap; /* Firefox 1.0-2.0 */
      white-space: pre-wrap;      /* current browsers */
}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Kompetensi
		<small>ASPEK PENGETAHUAN</small>
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
     
            <div class="box-body">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                {{Session::get('message')}}
              </div>
            @endif
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="danger" colspan="14" style="text-align: center;">KOMPETENSI PENGETAHUAN</th>
                  <th class="success"></th>
                  <th class="success" colspan="2"></th>
                  <th class="success" rowspan="3" style="text-align: center;padding-bottom: 70px"><p>DESKRIPSI</p></th>
                  <th class="success" rowspan="3" style="text-align: center;padding-bottom: 80px">T/TT</th>
                
                </tr>

                <tr>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="active"></th>
                  <th class="success" style="text-align: center;">KD1</th>
                  <th class="success" style="text-align: center;">KD2</th>
                  <th class="success" style="text-align: center;" >KD3</th>
                  <th class="success" style="text-align: center;" >KD4</th>
                  <th class="success" style="text-align: center;" >KD5</th>
                  <th class="success" style="text-align: center;" >KD6</th>
                  <th class="success" style="text-align: center;" >KD7</th>
                  <th class="success" style="text-align: center;" >KD8</th>
                  <th class="success" style="text-align: center;" >KD9</th>
                  <th class="success" style="text-align: center;" >KD10</th>
                  <th class="success" style="text-align: center;" >KD11</th>
                  <th class="success" style="text-align: center;" >KD12</th>
                  <th class="success" style="text-align: center;" >KD13</th>
                  <th class="success" style="text-align: center;" >KD14</th>
                  <th class="success" rowspan="2"></th>
                  <th rowspan="2" class="verticalTableHeader"><P>NILAI PENGETAHUAN</P></th> 
                  <th rowspan="2" class="verticalTableHeader" style="padding-bottom: 40px"><p>PREDIKAT</p></th>
                </tr>

                <tr>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Urut</th>
                  <th class="success" style="text-align: center;padding-bottom: 40px">Nama Peserta Didik</th>
                  <th class="success" style="text-align: center;padding-bottom: 35px">Nomor Induk</th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                  <th class="verticalTableHeader"><p>Keterangan 1</p></th>
                </tr>

                <form> 
                <tr>
                  <td></td>
                  <td><input type="text" class="form-control" name="" style="width: 250px;margin-top: 30px "></td>
                  <td><input type="text" class="form-control" name="" style="width: 60px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td class="success"></td>
                  <td><input type="text" class="form-control" name="" style="width: 49px;margin-top: 30px"></td>
                  <td><input type="text" class="form-control" name="" style="width: 38px;margin-top: 30px"></td>
                  <td ><textarea class="form-control" name="" rows="4" style="width: 600px"></textarea></td>
                  <td><input type="text" class="form-control" name="" style="width: 45px;margin-top: 30px"></td>
                </tr>

                </form>
                </thead>
                <tbody>  
                           
                
                </tbody>
                
              </table>
              </div>
              <button id="adding" type="button" class="btn btn-success">Tambah Data</button>
            </div>
            @endif
           
          </div>
        </div>
      </div>

  

     





	</section>
</div>

<script type="text/javascript">

  $(document).ready(function(){window.setTimeout(function() {
               document.getElementById ('sidebartoggle').click();}, 0);
            });
</script>

@endsection