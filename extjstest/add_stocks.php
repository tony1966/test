<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$data=$_POST['data'];
$data=file_get_contents("php://input");
$obj=json_decode($data); 
$SQL="INSERT INTO `stocks`(`name`,`id`,`close`,`volumn`,`meeting`,". 
     "`election`,`category`) VALUES('".$obj->name."',".$obj->id.",".
	 $obj->close.",".$obj->volumn.",'".$obj->meeting."',".
	 $obj->election.",'".$obj->category."')";
$result=mysql_query($SQL, $conn);
mysql_close();
?>