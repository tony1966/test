<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage Express 2.0">
<title>計算變異係數 CV</title>
</head>
<body bgcolor="#FFFFFF">
<P>計算變異係數 CV</P>
<?php
if (empty($_REQUEST["numbers"])) {
?>
<form method="post" action="cv.php">
  <input type="text" name="numbers" size="30" value="100,100,100,100,100">
  <input type="submit" value="ok">
</form>
<?php
    }
else {
    $arr=explode(",",$_REQUEST["numbers"]);
    $sum=0;         //總和
    $square=0;      //平方和
    $count=count($arr);
    for ($j=0; $j<count($arr); $j++) { 
         $sum += $arr[$j]; //和累計
         $square += pow($arr[$j], 2); //平方和累計 (計算標準差用)
         } //end of for
    $avg=round($sum/$count,2);  //計算平均值
    $std=sqrt(($square-pow($sum,2)/$count)/($count-1)); //計算樣本標準差
    if($avg != 0) {$CV=round(100*$std/$avg);}
    else {$CV=9999;}  //表示極大值
    echo "array=".join(",",$arr)."<br>";
    echo "sum=".$sum."<br>";
    echo "square=".$square."<br>";
    echo "avg=".$avg."<br>";
    echo "std=".$std."<br>";
    echo "CV=".$CV."%<br>";
    }
?>
</body>
</html>