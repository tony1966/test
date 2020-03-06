<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$start=$_GET['start'];  //擷取 ExtJS 傳出參數 'start'
$limit=$_GET['limit'];  //擷取 ExtJS 傳出參數 'limit'
$sort=$_GET['sort'];    //擷取 ExtJS 傳出參數 'sort'
$sort=trim($sort,"[");
$sort=trim($sort,"]");
$obj=json_decode($sort);
$property=$obj->property;
$dir=$obj->direction;
$SQL="SELECT COUNT(*) FROM `stocks_list`";
$RS=mysql_query($SQL, $conn);
list($total)=mysql_fetch_row($RS); //紀錄總筆數
$SQL="SELECT * FROM `stocks_list` ORDER BY ".$property." ".$dir." ".
     "LIMIT ".$start.",".$limit;
$result=mysql_query($SQL, $conn); //執行 SQL 指令
$stock=array(); 
for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
     $row=mysql_fetch_array($result); //取得列陣列
     $stock_name=$row["stock_name"];
     $stock_id="<a href='http://tw.stock.yahoo.com/q/q?s=".
               $row["stock_id"]."' target='_blank'>".
               $row["stock_id"]."</a>";
     $stock[$i]=array("stock_name" => $stock_name, 
                      "stock_id" => $stock_id);
     } //end of for
$arr=array("totalProperty" => $total, "root" => $stock);
echo json_encode($arr);  //將陣列轉成 JSON 資料格式傳回
?>