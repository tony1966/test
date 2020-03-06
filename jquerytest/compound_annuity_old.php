<?php
//製作複利表
$r=Array(); //列陣列
$c=Array(); //行陣列
$title=Array();
for ($i=1; $i<=50; $i++) { //列=年
     $c[]=$i;
     for ($j=1; $j<=20; $j++) { //行=利息
          if ($i==1) {$title[]='{"sTitle":"'.$j.'%"}';} //製作標題
          $c[]=round(pow(1 + $j/100,$i),3); 
          } //end of for
     $r[]="[".join(",",$c)."]";
     $c=null; //歸零以免串接
     } //end of for
$csTitle=join(",",$title);
$compound="[".join(",",$r)."]";
$r=null;
$c=null;
$title=null;
//製作年金表
$r=Array(); //列陣列
$c=Array(); //行陣列
$title=Array();
for ($i=1; $i<=50; $i++) { //列=年
     $c[]=$i;
     for ($j=1; $j<=20; $j++) { //行=利息
          if ($i==1) {$title[]='{"sTitle":"'.$j.'%"}';} //製作標題
          $c[]=round((pow(1 + $j/100,$i)-1)/($j/100),2); 
          } //end of for
     $r[]="[".join(",",$c)."]";
     $c=null; //歸零以免串接
     } //end of for
$asTitle=join(",",$title);
$annuity="[".join(",",$r)."]";
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
  </style>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet" />
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
</head>
<body>
<div id="acc1">
  <h3>複利終值表</h3>
  <div>
    <table id="compound_table">
      <thead>
        <tr>
          <th>ee</th>
          <th>ee</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <h3>年金終值表</h3>
  <div>
    <table id="annuity_table">    
      <thead></thead>
      <tbody></tbody>
    </table>
  </div>
</div>
<script type='text/javascript'>
  $(document).ready(function() {
    var opt={"oLanguage":{"sUrl":"../jquery/dataTables.zh-tw.txt"},
             "sScrollY":"200px","bAutoWidth":false,"bPaginate":false,
             "bSort": false,"aoColumns":[{"sTitle":"年"},<?php echo $csTitle ?>],
             "aaData":<?php echo $compound ?>,"bFilter":false,"bInfo":false,
             "sScrollX":"100%","sScrollXInner":"100%","bScrollCollapse":true
             };
    $("#compound_table").dataTable(opt);
    var opt={"oLanguage":{"sUrl":"../jquery/dataTables.zh-tw.txt"},
             "sScrollY":"200px","bAutoWidth":false,"bPaginate":false,
             "bSort": false,"aoColumns":[{"sTitle":"年"},<?php echo $asTitle ?>],
             "aaData":<?php echo $annuity ?>,"bFilter":false,"bInfo":false,
             "sScrollX":"100%","sScrollXInner":"100%","bScrollCollapse":true
             };
    $("#annuity_table").dataTable(opt);
    $("#acc1").accordion();
    });
</script>
</body>
</html>