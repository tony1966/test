<?php
$a=1; //全域變數
function func(){
  $GLOBALS["a"]=2; //修改全域變數值為 2
  echo $GLOBALS["a"]; 
  }
func(); //顯示 2 (顯示全域變數之值)
echo $a; //顯示 2 (顯示全域變數之值) 
?>