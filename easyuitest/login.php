<?php
header('Content-Type: text/html;charset=UTF-8');
$account=$_REQUEST["account"];
$password=$_REQUEST["password"];
if ($account=="blabla" && $password=="blabla") {echo 1;}
else {echo 0;}
?>