<?php
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Taipei");    
echo date("Y-m-d H:i:s")." 載入<br>";
echo $_REQUEST["param1"].$_REQUEST["param2"];
?>
<script>
  alert("autoLoad 載入完成!");
</script>