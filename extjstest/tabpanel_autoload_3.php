<?php
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Taipei");    
echo date("Y-m-d H:i:s")." 載入<br>";
$params=$_REQUEST["param1"].$_REQUEST["param2"];
echo '<button onclick="javascript:show()">確定</button>'.
     '<script>'.
     'function show() {'.
     '  alert("'.$params.'");'.
     '  }'.
     '</script>';
?>