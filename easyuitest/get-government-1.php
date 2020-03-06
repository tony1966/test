<?php
header('Content-Type: text/html;charset=UTF-8');
include("db.php");
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$result=array();
$id=isset($_POST['id']) ? intval($_POST['id']) : 0;
$rs=mysql_query("SELECT * FROM government WHERE parentId=$id"); 
while ($row=mysql_fetch_array($rs)){ //若節點存在
  $node=array();
  $node["id"]=$row["id"];
  $node["text"]=$row["text"];
  $node["state"]=has_child($row["id"]) ? "closed" : "open";
  array_push($result,$node);
  }
echo json_encode($result);
function has_child($id){
  $SQL="SELECT count(*) FROM government WHERE parentId=$id";
  $rs=mysql_query($SQL);
  $row=mysql_fetch_array($rs);
  return $row[0] > 0 ? true : false;
  }
?>