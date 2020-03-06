<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$modified=$_POST['modified'];
$modified=trim($modified,"[");    //去除左括號
$modified=trim($modified,"]");    //去除右括號
$arr=explode("},{",$modified);    //轉為陣列
$result="";
foreach ($arr as $k => $v) {
  if (count($arr) > 1) { //只有一筆不需矯正
    if ($k==0) {$arr[$k]=$v."}";}
    else if ($k==count($arr)-1) {$arr[$k]="{".$v;}
    else {$arr[$k]="{".$v."}";}
    }
  $obj=json_decode($arr[$k]); //轉成物件
  $name=$obj->name;
  $id=$obj->id;
  $close=$obj->close;
  $volumn=$obj->volumn;
  $meeting=$obj->meeting;
  $election=$obj->election;
  $category=$obj->category;
  $SQL="UPDATE stocks SET name='".$name."',close=".$close.",".
       "volumn=".$volumn.",meeting='".$meeting."',election=".
	     $election.",category='".$category."' WHERE id=".$id;
  $result .= mysql_query($SQL, $conn);
  }
mysql_close();
echo $result."完成回存!".$arr[0].$SQL;  //將陣列轉成 JSON 資料格式傳回
?>
