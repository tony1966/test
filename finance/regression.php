<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage Express 2.0">
<title>線性迴歸 Linear Regression</title>
</head>
<body bgcolor="#FFFFFF">
<P>計算線性迴歸方程式 Y = a + bX</P>
<?php
if (empty($_REQUEST["X"])) {
?>
<form method="post" action="regression.php">
  X : <input type="text" name="X" size="30" value="25,23,27,35,30"><br>
  Y : <input type="text" name="Y" size="30" value="35,27,36,45,42"><br>
  <input type="submit" value="ok">
</form>
<?php
    }
else {
    $X=explode(",",$_REQUEST["X"]);
    $Y=explode(",",$_REQUEST["Y"]);
    $xavg=array_sum($X)/count($X); //X 平均值
    $yavg=array_sum($Y)/count($Y); //Y 平均值
    $XMD=Array();         //X 離均差
    $YMD=Array();         //Y 離均差
    $mdcross_sum=0;       //X,Y 離均差交乘積和
    $xdif_square_sum=0;   //X 離均差平方和
    $count=count($X);
    for ($i=0; $i<count($X); $i++) { 
         $xdif=(float)$X[$i]-$xavg; //X 離均差
         $ydif=(float)$Y[$i]-$yavg; //Y 離均差
         $XMD[$i]=$xdif;
         $YMD[$i]=$ydif;
         $mdcross_sum += $xdif*$ydif;       //X,Y 離均差交乘積和
         $xdif_square_sum += pow($xdif, 2); //X 離均差平方和
         } //end of for
    $b=round($mdcross_sum/$xdif_square_sum, 2);  //計算斜率 b
    $a=round($yavg-$b*$xavg,2);                  //計算常數項 a
    echo "X=".join(", ",$X)."<br>";
    echo "Y=".join(", ",$Y)."<br>";
    echo "常數項 a=".$a."<br>";
    echo "斜率 b=".$b."<br>";
    echo "線性迴歸方程式 Y = ".$a." + (".$b.")X<br>";
    echo "X 平均值=".$xavg."<br>";
    echo "Y 平均值=".$yavg."<br>";
    echo "X 離均差=".join(", ",$XMD)."<br>";
    echo "Y 離均差=".join(", ",$YMD)."<br>";
    echo "X,Y 離均差交乘積和=".$mdcross_sum."<br>";
    echo "X 離均差平方和=".$xdif_square_sum."<br>";
    }
?>
</body>
</html>