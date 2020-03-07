<?php
$a=1; //全域變數
function increment(){
  echo ++$a; //沒有設值預設為 null, 增量計算時會轉為 0
  }
echo $a; //顯示 1 (顯示全域變數之值)
increment(); //顯示 1 (null 值為 0 增量後為 1)
increment(); //顯示 1 (null 值為 0 增量後為 1)
?>