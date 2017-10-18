<!DOCTYPE html>
<html>
<head>

	 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{URL::asset('/plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('/plugins/datatables/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{URL::asset('/plugins/iCheck/all.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{URL::asset('/dist/css/skins/skin-blue.min.css')}}">
	<script src="{{URL::asset('/codebase/spreadsheet.php?load=js')}}"></script>
	<link rel="stylesheet" href="{{URL::asset('/codebase/dhtmlx_core.css')}}" />
	<link rel="stylesheet" href="{{URL::asset('/codebase/dhtmlxspreadsheet.css')}}" />
</head>
<body>
	<style>
		.ssheet_cont {
			width: 700px;
			height: 450px;
			float: left;
		}
	</style>
	<script>
		window.onload = function() {
			var dhx_sh1 = new dhtmlxSpreadSheet({
				load: "../codebase/php/data.php",
				save: "../codebase/php/data.php",
				parent: "nilaikelasx",
				math : true,
				icons_path: "../codebase/imgs/icons/",
				autowidth: true,
				autoheight: true
			}); 
			dhx_sh1.load("nilai");
			
		};
	</script>
	<div class="ssheet_cont" id="nilaikelasx"></div>


</body>
</html>
