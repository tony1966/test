<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$q=$_REQUEST["q"]; //combobox 送出的查詢參數
if (isset($q)) { //有搜尋
  $where=" WHERE `stock_id` LIKE '".$q."%' OR ".
         "`stock_name` LIKE '%".$q."%'";
  }
else {$where="";} //沒有搜尋,顯示全部
$SQL="SELECT stock_id,stock_name FROM stocks_list".$where;
$result=mysql_query($SQL, $conn); //執行 SQL 指令
$arr=array(); 
for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
  $row=mysql_fetch_array($result); //取得列陣列
  $value=$row["stock_id"];
  $text=$row["stock_id"]." (".$row["stock_name"].")";
  $arr[$i]=array("value" => $value,"text" => $text);
  }
echo json_encode($arr);
?>