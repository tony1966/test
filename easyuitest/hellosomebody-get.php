<?php
header('Content-Type: text/html;charset=UTF-8');
$name=$_GET["name"];
$surname=$_GET["surname"];
echo "Hello! ".$name." ".$surname."<br>".
     "The time is ".date("Y-m-d H:i:s");
?>