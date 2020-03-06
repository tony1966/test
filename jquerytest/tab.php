<html>
<head>
  <meta charset="utf-8">
</head>
<body>
<?php
$tab=$_GET["tab"];
switch($tab) {
  case "1" : {echo "頁籤 1 (Ajax)";break;}
  case "2" : {echo "頁籤 2 (Ajax)";break;}
  case "3" : {echo "頁籤 3 (Ajax)";break;}
  }
?>
</body>
</html>