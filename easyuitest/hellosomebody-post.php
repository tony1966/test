<?php
header('Content-Type: text/html;charset=UTF-8');
$name=$_POST["name"];
$surname=$_POST["surname"];
echo "Hello! ".$name." ".$surname."<br>".
     "The time is ".date("Y-m-d H:i:s");
?>