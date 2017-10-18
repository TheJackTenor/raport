<!DOCTYPE html>
<html>
<head>
  <title>Success... Redirecting</title>
</head>
<body onload="muah();">
<?php

echo "Success... Redirecting ->";

?>
<script src={{URL::asset('/plugins/jQuery/jquery-2.2.3.min.js')}}></script>
<script type="text/javascript">
function muah(){
  $(document).ready(function(){window.setTimeout(function() {
              window.location.href = '{{URL('/formlogon')}}';}, 1000);
            });
}
</script>
</body>


</html>

