<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$SQL="SELECT * FROM `category`"; 
$result=mysql_query($SQL, $conn); //執行 SQL 指令
$arr=array(); 
for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
     $row=mysql_fetch_array($result); //取得列陣列
     if ($i==4) {
       $arr[$i]=array("value" => $row["category"],
                      "text" => $row["category"],
                      "selected" => true);
       }
     else {
       $arr[$i]=array("value" => $row["category"],
                      "text" => $row["category"]);
       }
     } 
echo json_encode($arr);  //將陣列轉成 JSON 資料格式傳回
?>