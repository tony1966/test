<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$term=$_GET['term'];  //擷取 jQueryUI 傳出參數 'term'
$SQL="SELECT * FROM `stocks_list`"; 
$result=mysql_query($SQL, $conn); //執行 SQL 指令
$stock=array(); 
for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
     $row=mysql_fetch_array($result); //取得列陣列
     $stock_name=$row["stock_name"];
     $stock_id="<a href='http://tw.stock.yahoo.com/q/q?s=".
               $row["stock_id"]."' target='_blank'>".
               $row["stock_id"]."</a>";
     $edit="<a href='edit_stocks_list.php?stock_id=".
           $row["stock_id"]."&stock_name=".
           $row["stock_name"]."' target='_blank'><img src='edit.gif' ".
           "style='border-width:0px;width:15px;height:15px;'></a>";
     $stock[$i]=array($edit, $stock_name, $stock_id);
     } //end of for
$arr["aaData"]=$stock;
echo json_encode($arr);  //將陣列轉成 JSON 資料格式傳回
?>