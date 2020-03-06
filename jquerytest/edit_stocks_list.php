<?php
$stock_id=$_REQUEST["stock_id"];
$stock_name=$_REQUEST["stock_name"];
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI 測試</title>
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <style>
    article,aside,figure,figcaption,footer,header,hgroup,menu,nav,section {display:block;}
    body {font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
  </style>
</head>
<body>
  <form id="edit_form">
  <p>股票代號 : <input type="text" id="stock_id" value="<?php echo $stock_id ?>"></p>
  <p>股票名稱 : <input type="text" id="stock_name" value="<?php echo $stock_name ?>"></p>
  <p><input type="button" id="submit" value="確定"></p>
  </form>
  <script language="JavaScript">
    $(document).ready(function(){ 
      $("#submit").click(function() {
        alert("更新!");
		});
      });
  </script>
</body>
</html>