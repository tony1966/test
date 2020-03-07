<?php
/*-----------------------------------------------------------------------------
Title        : Tools
Translator   : Tony
Version      : v1.0.0
Prototype    : 2013/05/09
Last Updated : 2013/05/09
Usage        : Tools for default.php/install.php/app.php
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
get_tabs()
功能 : 
  從資料表 tabs 讀取頁籤資料, 傳回頁籤之 HTML 碼字串			
參數 :                                   
  無
傳回值 :
  字串
範例 : 
  include_once("dbsettings.php"); //匯入資料庫設定檔
  include_once("lib/mysql.php"); //匯入資料庫模組
  echo get_tabs();
-----------------------------------------------------------------------------*/
function get_tabs(){ //製作頁籤
  $SQL="SELECT * FROM `tabs` ORDER BY tab_order"; //搜尋全部頁籤
  $RS=run_sql($SQL); 
  for ($i=0; $i<count($RS); $i++) {
       $href=$RS[$i]["tab_link"]; //超連結
       $tabs[$i]=space(6)."<li><a href='".$href."'>".$RS[$i]["tab_label"].
                 "</a></li>\n";    
       } 
  $tabs=space(2)."<div id='tabs'>\n".
        space(4)."<ul>\n".join("", $tabs).
        space(4)."</ul>\n".
        space(2)."</div>\n";  
  return $tabs;
  }
/*-----------------------------------------------------------------------------
get_jquery()
功能 : 
  傳回 jQuery UI 函式庫載入字串			
參數 :                                   
  無
傳回值 :
  字串
範例 : 
  include_once("dbsettings.php"); //匯入資料庫設定檔
  include_once("lib/mysql.php"); //匯入資料庫模組
  echo get_jquery();
-----------------------------------------------------------------------------*/
function get_jquery(){ 
  $RS=search("settings"); 
  if ($RS===FALSE) {$theme="hot-sneaks";}
  else {$theme=$RS[0]["jqueryui_theme"];}
  $jquery="<link href='jquery/themes/".$theme.
          "/jquery-ui.css' rel='stylesheet'>\r\n  ".
          "<link href='jquery/jquery-ui-timepicker-addon.css' ".
          "rel='stylesheet'>\r\n  ".
          "<link href='jquery/jquery.dataTables.css' rel='stylesheet'>\r\n  ".
          "<script type='text/javascript' src='jquery/jquery.js'>".
          "</script>\r\n  ".
          "<script type='text/javascript' src='jquery/jquery-ui.js'>".
          "</script>\r\n  ".
          "<script type='text/javascript' ".
          "src='jquery/jquery-ui-timepicker-addon.js'></script>\r\n  ".
          "<script type='text/javascript' ".
          "src='jquery/jquery-ui-sliderAccess.js'></script>\r\n  ".
          "<script type='text/javascript' ".
          "src='jquery/jquery.dataTables.min.js'></script>\r\n";
  return $jquery;
  }
?>