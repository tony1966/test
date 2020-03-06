<?php
header('Content-Type: text/html;charset=UTF-8');
$account=$_REQUEST["account"];
$password=$_REQUEST["password"];
echo "登入成功!<br>帳號:$account<br>密碼:$password";
?>