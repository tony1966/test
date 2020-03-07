<?php
$a=1; //全域變數
function func($a){
  global $a; //宣告 $a 為全域變數
  $a=2; //修改全域變數值為 2
  echo $a; 
  }
func(3); //顯示 2 (顯示全域變數之值)
echo $a; //顯示 2 (顯示全域變數之值) 
?>