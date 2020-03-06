<?php
$buy=$_POST["buy"];
$close=$_POST["close"];
$ratio=$_POST["ratio"];
$step=$buy*$ratio;          //向上停損步階
$dsr=($close-$buy)/$step;   //差價步階比
if ($dsr < 1) {             //尚未站上無風險投資線
  $sell=$buy-$step;         //認賠賣出價
  }  
else {                      //已站上無風險投資線
  $sell=$buy + $step*(floor($dsr)-1); //向上移動停損線
  }  
echo json_encode(array('sell' => $sell));
?>