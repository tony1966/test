<?php
header('Content-Type: text/html;charset=UTF-8');
include_once("../lib/http.php");
$target="http://mybidrobot.allalla.com/phptest/http_test.php?name=uuu";
echo "<a href='$target' target='_blank'>$target</a><br>";
$ref="";
$para["name"]="ppp";
$web_page=http_get($target,$ref); //¤U¸üºô­¶ÀÉ
echo $web_page['FILE']."<br>";
?>