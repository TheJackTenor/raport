<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MAN Maguwoharjo Sleman | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h2><a href="/sisfo"><b>{{session()->get('nama')}}</b></a></h2>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{$message}}</p>

    <form role="form" method="POST" action="{{ url('/siswadaftar/createnew') }}">
    {{ csrf_field() }}

    {{Form::hidden('id',$dec)}}
    {{Form::hidden('enc',$enc->enc)}}
    {{Form::hidden('kd',$enc->kd_user)}}
     
      <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
        <input id="password" type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if($errors->has('password'))
          <span class="help-block">
            <strong>{{$errors->first('password')}}</strong>
          </span>
        @endif

      </div>

      <div class="form-group {{$errors->has('passwordconf') ? 'has-error' : ''}}">
        <input id="passwordconf" type="password" class="form-control" placeholder="Konfirmasi Password" name="passwordconf">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if($errors->has('passwordconf'))
          <span class="help-block">
            <strong>{{$errors->first('passwordconf')}}</strong>
          </span>
        @endif

      </div>

      <div class="row">
       
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{URL::asset('/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
