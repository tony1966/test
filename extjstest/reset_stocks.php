<?php
header('Content-Type: text/html;charset=UTF-8');
$host="mysql.1freehosting.com"; 
$username="u911852767_test";
$password="a5572056";
$database="u911852767_test";
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$SQL="DELETE FROM stocks";
$result=mysql_query($SQL, $conn); //刪除全部資料
$SQL="INSERT INTO `stocks` (`name`,`id`,`close`,`volumn`,`meeting`,".
     "`election`,`category`) VALUES".
     "('台積電', '2330', 123, 4425119, '2014-06-04', 0, '半導體'),".
     "('中華電', '2412', 96.4, 5249, '2014-06-15', 0, '通信'),".
     "('中碳', '1723', 192.5, 918, '2014-07-05', 0, '塑化'),".
     "('創見', '2451', 108, 733, '2014-06-30', 0, '模組'),".
     "('華擎', '3515', 118.5, 175, '2014-07-20', 1, '主機板'),".
     "('訊連', '5203', 97, 235, '2014-05-31', 0, '軟體')";
$result=mysql_query($SQL, $conn); 
mysql_close();
echo "資料表重設完成!".$arr[0];  
?>