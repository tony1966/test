<?php
  if (is_null($_POST["theme"])) {$theme="default";}
  else {$theme=$_POST["theme"];}
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>ExtJS4</title>
  <link rel="stylesheet" href="../extjs/resources/css/ext-all.css">
<?php
  if ($theme=="default") {$css="";$js="";}
  else {
      $css='<link rel="stylesheet" href="../extjs/resources/css/ext-'.$theme.'.css">';
      $js='<script type="text/javascript" src="../extjs/ext-'.$theme.'.js"></script>';
      } //end of if
  echo "  ".$css."\n";
?>
  <script type="text/javascript" src="../extjs/ext-all.js"></script>
<?php 
  echo "  ".$js."\n";
?>
  <style>
    body {margin:20px;}
  </style>
</head>
<body>
  ExtJS Look and Feel 測試 : 切換主題布景 : 
  <form method=post action="extjstest_look_and_feel.php">
    <select name="theme" onchange="javascript:this.form.submit();">
      <option value="default"<? if($theme=="default") {echo " selected";}?>>default</option>
      <option value="neptune"<? if($theme=="neptune") {echo " selected";}?>>neptune</option>
    </select>
  </form>
  <script type="text/javascript">
    Ext.onReady(function() {
      Ext.MessageBox.alert("通知訊息", "您好! Hello World!"); 
      });
  </script>
</body>
</html>