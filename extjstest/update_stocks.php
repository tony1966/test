<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'");   //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$input=file_get_contents("php://input");
$data=ltrim($input,'{"data":');    //去除 root 字串
$data=rtrim($data,"}");            //去除右大括號
$data=ltrim($data,"[");            //去除左括號
$data=rtrim($data,"]");            //去除右括號
$obj=json_decode($data);
$SQL="SELECT * FROM stocks WHERE id=".$obj->id;
$result=mysql_query($SQL, $conn);
$count=mysql_num_rows($result);
if ($count==0) { //新紀錄
  $SQL="INSERT INTO `stocks` (`name`,`id`,`close`,`volumn`,`meeting`,". 
       "`election`,`category`) VALUES('".$obj->name."','".$obj->id."','".
       $obj->close."','".$obj->volumn."','".$obj->meeting."','".
       $obj->election."','".$obj->category."')";
  }
else {
  $SQL="UPDATE `stocks` SET name='".$obj->name."',id='".$obj->id."',close='".
       $obj->close."',volumn='".$obj->volumn."',meeting='".$obj->meeting.
       "',election='".$obj->election."',category='".$obj->category."' ".
       "WHERE id=".$obj->id;
  }
$result=mysql_query($SQL, $conn);
mysql_close();
$handle=fopen("output.txt", "w");
fwrite($handle, $data);
fclose($handle);
?>