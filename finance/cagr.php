<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage Express 2.0">
<title>test</title>
</head>
<body bgcolor="#FFFFFF">
<?php
if (empty($_REQUEST["PV"])) {
?>
計算年複合成長率<br>
<form method="post" action="cagr.php">
  初值 <input type="text" name="PV" value=""><br>
  終值 <input type="text" name="FV" value=""><br>
  周期 <input type="text" name="n" value=""> 
  <input type="button" value="OK" onclick="check(this.form)">
  <script language="javascript">
    function check(formObj) {
      var PV=formObj.PV.value;
      var FV=formObj.FV.value;
      var n=formObj.n.value;
      if (PV==""||FV==""||n=="") {
          alert("三個欄位都要輸入!");
          return;
          }
      formObj.submit();
      }
  </script>
</form>
<?php
    }
else {
    $PV=(float)$_REQUEST["PV"];
    $FV=(float)$_REQUEST["FV"];
    $n=(float)$_REQUEST["n"];
    if ($PV != 0 && $n != 0) {
        $cagr=round((pow($FV/$PV,1/$n)-1)*100,2);
        echo "初值=$PV<br>終值=$FV<br>周期=$n<br>年複合成長率=$cagr%<br>".
             "<input type='button' value='回上一頁' ".
             "onclick='history.go(-1)'>";
        }
    else {      
        echo "初值與周期不可為 0<br>".
             "<input type='button' value='回上一頁' ".
             "onclick='history.go(-1)'>";;
        }
    }
?>
</body>
</html>