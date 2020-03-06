<?php
//製作複利表
$r=Array(); //列陣列
$c=Array(); //行陣列
$title=Array();
for ($i=1; $i<=50; $i++) { //列=年
     $c[]=$i;
     for ($j=1; $j<=30; $j++) { //行=利息
          if ($i==1) {$title[]='{"sTitle":"'.$j.'%"}';} //製作標題
          $c[]=round(pow(1 + $j/100,$i),3); 
          } //end of for
     $r[]="[".join(",",$c)."]";
     $c=null; //歸零以免串接
     } //end of for
$sTitle=join(",",$title);
$compound="[".join(",",$r)."]";
$compound_table=<<<FORM
<style>
  th,td {max-width:120px !important;word-wrap:break-word;text-align:left;}
</style>
<table id="compound_table"></table>
<script type='text/javascript'>
  $(document).ready(function() {
    var opt={"oLanguage":{"sUrl":"../jquery/dataTables.zh-tw.txt"},
             "sScrollY":"200px","bAutoWidth":true,"bPaginate":false,
             "bSort": false,"aoColumns":[{"sTitle":"年"},{$sTitle}],
             "aaData":{$compound},"bFilter":false,"bInfo":false,
             "sScrollX":"100%"
             };
    $("#compound_table").dataTable(opt);
    });
</script>
FORM;
//製作年金表
$r=Array(); //列陣列
$c=Array(); //行陣列
$title=Array();
for ($i=1; $i<=50; $i++) { //列=年
     $c[]=$i;
     for ($j=1; $j<=30; $j++) { //行=利息
          if ($i==1) {$title[]='{"sTitle":"'.$j.'%"}';} //製作標題
          $c[]=round((pow(1 + $j/100,$i)-1)/($j/100),3); 
          } //end of for
     $r[]="[".join(",",$c)."]";
     $c=null; //歸零以免串接
     } //end of for
$sTitle=join(",",$title);
$annuity="[".join(",",$r)."]";
$annuity_table=<<<FORM
<table id="annuity_table"></table>
<script type='text/javascript'>
  $(document).ready(function() {
    var opt={"oLanguage":{"sUrl":"../jquery/dataTables.zh-tw.txt"},
             "sScrollY":"200px","bAutoWidth":true,"bPaginate":false,
             "bSort": false,"aoColumns":[{"sTitle":"年"},{$sTitle}],
             "aaData":{$annuity},"bFilter":false,"bInfo":false,
             "sScrollX":"100%"
             };
    $("#annuity_table").dataTable(opt);
    });
</script>
FORM;
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
  <meta charset="utf-8">  
  <title></title>
  <style>
    article,aside,figure,figcaption,footer,header,hgroup,menu,nav,section {display:block;}
    th,td {max-width:120px !important;word-wrap:break-word;text-align:left;}
    body {font: 62.5% "Trebuchet MS", sans-serif; margin: 10px;}
    fieldset {margin-top:10px;-moz-border-radius:5px;
              -webkit-border-radius:5px;
              -khtml-border-radius:5px;
              border-radius:5px;width:97.5%;}
  </style>
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
</head>
<body>
<fieldset class="ui-widget-content">
  <legend style="text-align:left;font-weight:bold;">複利終值表</legend>
  <?php echo $compound_table ?>
</fieldset>
<fieldset class="ui-widget-content">
  <legend style="text-align:left;font-weight:bold;">年金終值表</legend>
  <?php echo $annuity_table ?>
</fieldset>
</body>
</html>