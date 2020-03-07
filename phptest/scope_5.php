<?php
$a=1; //全域變數
function increment(){
  static $a;
  echo ++$a; //增量
  }
echo $a; //顯示 1 (顯示全域變數之值)
increment(); //顯示 1 (預設 null 值為 0 增量後為 1)
increment(); //顯示 2 
?>