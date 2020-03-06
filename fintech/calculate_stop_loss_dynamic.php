<?php
$buy=$_POST["buy"];
$close=$_POST["close"];
$ratio=$_POST["ratio"];
if ($close < $buy) {        //虧損狀態
  $sell=$buy*(1-$ratio);    //認賠賣出價
  }  
else {                       
  $sell=$close*(1-$ratio);  //向上移動停損線
  }  
echo json_encode(array('sell' => $sell));
?>