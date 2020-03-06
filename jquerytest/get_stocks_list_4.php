<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$term=$_GET['term'];  //擷取 jQueryUI 傳出參數 'term'
$SQL="SELECT * FROM `stocks_list` WHERE `stock_id` LIKE '".$term. 
     "%' OR `stock_name` LIKE '".$term."%'"; 
$result=mysql_query($SQL, $conn); //執行 SQL 指令
$arr=Array(); //用來儲存 stock_id 欄位值之陣列
for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
     $row=mysql_fetch_array($result); //取得列陣列
     $label=$row["stock_name"];
     $value=$row["stock_id"];
     $arr[]='{"label":"'.$label.'","value":"'.$value.'"}'; //放入陣列
     } //end of for
echo "[".join(",", $arr)."]";
?>