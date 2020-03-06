<?php
$op=$_GET["op"];
switch ($op) {
  case 'get_dialog' : {
       $txt="<input type='text' id='inputbox'>";
       echo utf8_encode($txt); //以 utf-8 編碼
       break;
       } //end of case
  case '' : {

       break;
       } //end of case
  } //end of switch
?>
</body>
</html>