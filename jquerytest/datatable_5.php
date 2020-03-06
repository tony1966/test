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
  <form method=post action="datatable_5.php">
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
  <table id="table1">
      <thead>
          <tr>
              <th>股票名稱</th>
              <th>股票代號</th>
              <th>收盤價 (元)</th>
              <th>成交量 (張)</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>台積電</td>
              <td>2330</td>
              <td>111.5</td>
              <td>19268</td>
          </tr>
          <tr>
              <td>中華電</td>
              <td>2412</td>
              <td>95.1</td>
              <td>7096</td>
          </tr>
          <tr>
              <td>中碳</td>
              <td>1723</td>
              <td>145.0</td>
              <td>317</td>
          </tr>
          <tr>
              <td>創見</td>
              <td>2451</td>
              <td>104.0</td>
              <td>459</td>
          </tr>
          <tr>
              <td>華擎</td>
              <td>3515</td>
              <td>108.5</td>
              <td>95</td>
          </tr>
          <tr>
              <td>訊連</td>
              <td>5203</td>
              <td>98.5</td>
              <td>326</td>
          </tr>
      </tbody>
  </table>
  <script language="JavaScript">
    $(document).ready(function(){ 
      var opt={"oLanguage":{"sUrl":"dataTables.zh-tw.txt"},
               "bJQueryUI":true
	      };
      $("#table1").dataTable(opt);
      });
  </script>
</body>
</html>