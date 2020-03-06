<?php
  if (is_null($_POST["theme"])) {$theme="hot-sneaks";}
  else {$theme=$_POST["theme"];}
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI 測試</title>
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/<?php echo $theme; ?>/jquery-ui.css" rel="stylesheet">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <style>
    article,aside,figure,figcaption,footer,header,hgroup,menu,nav,section {display:block;}
    body {font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
  </style>
</head>
<body>
  <form method=post action="datatable_11_1.php">
    <select name="theme" onchange="javascript:this.form.submit();">
      <option value="black-tie"<? if($theme=="black-tie") {echo " selected";}?>>black-tie
      <option value="blitzer"<? if($theme=="blitzer") {echo " selected";}?>>blitzer
      <option value="cupertino"<? if($theme=="cupertino") {echo " selected";}?>>cupertino
      <option value="dark-hive"<? if($theme=="dark-hive") {echo " selected";}?>>dark-hive
      <option value="dot-luv"<? if($theme=="dot-luv") {echo " selected";}?>>dot-luv
      <option value="eggplant"<? if($theme=="eggplant") {echo " selected";}?>>eggplant
      <option value="excite-bike"<? if($theme=="excite-bike") {echo " selected";}?>>excite-bike
      <option value="flick"<? if($theme=="flick") {echo " selected";}?>>flick
      <option value="hot-sneaks"<? if($theme=="hot-sneaks") {echo " selected";}?>>hot-sneaks
      <option value="humanity"<? if($theme=="humanity") {echo " selected";}?>>humanity
      <option value="le-frog"<? if($theme=="le-frog") {echo " selected";}?>>le-frog
      <option value="mint-choc"<? if($theme=="mint-choc") {echo " selected";}?>>mint-choc
      <option value="overcast"<? if($theme=="overcast") {echo " selected";}?>>overcast
      <option value="pepper-grinder"<? if($theme=="pepper-grinder") {echo " selected";}?>>pepper-grinder
      <option value="redmond"<? if($theme=="redmond") {echo " selected";}?>>redmond
      <option value="smoothness"<? if($theme=="smoothness") {echo " selected";}?>>smoothness
      <option value="south-street"<? if($theme=="south-street") {echo " selected";}?>>south-street
      <option value="start"<? if($theme=="start") {echo " selected";}?>>start
      <option value="sunny"<? if($theme=="sunny") {echo " selected";}?>>sunny
      <option value="swanky-purse"<? if($theme=="swanky-purse") {echo " selected";}?>>swanky-purse
      <option value="trontastic"<? if($theme=="trontastic") {echo " selected";}?>>trontastic
      <option value="ui-darkness"<? if($theme=="ui-darkness") {echo " selected";}?>>ui-darkness
      <option value="ui-lightness"<? if($theme=="ui-lightness") {echo " selected";}?>>ui-lightness
      <option value="vader"<? if($theme=="vader") {echo " selected";}?>>vader
    </select>
  </form>
  <table id="table1"></table>
  <script language="JavaScript">
    $(document).ready(function(){ 
      var opt={"oLanguage":{"sUrl":"dataTables.zh-tw.txt"},
               "bJQueryUI":true,
               "sPaginationType":"full_numbers",
               "aoColumns":[{"sTitle":"股票名稱"},{"sTitle":"股票代號"}],
               "sAjaxSource":"http://mybidrobot.allalla.com/jquerytest/get_stocks_list_aa.php"
               };
      $("#table1").dataTable(opt);
      });
  </script>
</body>
</html>