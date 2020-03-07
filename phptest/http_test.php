<?php
header('Content-Type: text/html;charset=UTF-8');
$request=$_REQUEST["name"];
$post=$_POST["name"];
$get=$_GET["name"];
echo "<br>";
echo "REQUEST=".$request."<br>";
echo "POST=".$post."<br>";
echo "GET=".$get;
?>