<?php
/*-----------------------------------------------------------------------------
Title        : jQuery UI API
uthor        : Tony
Version      : v1.1.1
Prototype    : 2013/03/31
Last Updated : 2013/04/15
Usage        : Manipulate jQuery UI widget
               %examples to show the returned codes :
	       echo "<xmp>".get_accordion($header,$content,"acc1")."</xmp>";
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
function get_datatable($id, $url, $column, $scrollY="400px",  
                       $paginate=false, $page_buttons="", $jqueryui=false, 
                       $locale="zh-TW")
功能 : 
  產生 jQuery UI 自動完成功能字串.			
參數 :  
  $id           : table 元素之 id                                 
  $url          : Ajax 後端資料提供程式 url
  $column       : 表格標頭欄位二維陣列 (Ajax 模式用)
                  第一維乃關聯式陣列, 有四個索引 :
                  $column["title"]:"名稱"
                  $column["width"]:"20px"/"20%"
                  $column["class"]:"editClass" (樣式)
                  $column["type"]:"string"/"numeric"
  $scrollY      : 指定垂直卷軸高度 (字串)
                  例如 "400px"/"100%"
  $page_buttons : 分頁時設定右下角分頁按鈕類型 (字串) :
                  "two"  : 上頁/下頁兩個按鈕
                  "full" : 上頁/下頁/首頁/尾頁/鄰近5頁按鈕
  $jqueryui     : 是否套用 jQueryUI 主題佈景
  $locale       : 語言設定, 預設 "zh-TW", ""=英文
傳回值 :
  字串
範例 :
  $url="get_stocks_list.php";
  $column["title"]=array("編輯","股票名稱","股票代號");
  $column["width"]=array("20px","20%","");
  $column["class"]=array("editClass","","");
  $column["type"]=array("","string","numeric");
  echo get_datatable("table1", $url, $column);
  echo get_datatable("table1", $url, $column, "100%");
  echo get_datatable("table1", $url, $column, "600px");
  echo get_datatable("table1", $url, $column, "", true);
  echo get_datatable("table1", $url, $column, "", true, "full");
  echo get_datatable("table1", $url, $column, "", true, "full", true);
  echo get_datatable("table1", $url, $column, "", true, "", true);

  ----後端程式 get_stocks_list.php (原始)-----
  header('Content-Type: text/html;charset=UTF-8');
  $host="mysql.1freehosting.com"; 
  $username="u911852767_test";
  $password="a5572056";
  $database="u911852767_test";
  $conn=mysql_connect($host, $username, $password); //建立連線
  mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
  mysql_select_db($database, $conn); //開啟資料庫
  $SQL="SELECT * FROM `stocks_list`"; 
  $result=mysql_query($SQL, $conn); //執行 SQL 指令
  $stock=array(); 
  for ($i=0; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
       $row=mysql_fetch_array($result); //取得列陣列
       $stock_name=$row["stock_name"];
       $stock_id=$row["stock_id"];
       $stock[$i]=array($stock_name, $stock_id);
       } //end of for
  $arr["aaData"]=$stock; //一定要用 aaData
  echo json_encode($arr);  //將陣列轉成 JSON 資料格式傳回

  ----後端程式 get_stocks_list.php (使用函式庫)-----
  header('Content-type: application/json; charset=utf-8');
  include_once("dbsettings.php"); //匯入資料庫設定檔
  include_once("lib/mysql.php"); //匯入資料庫模組
  $SQL="SELECT * FROM `stocks_list`";
  $RS=run_sql($SQL);
  $stock=array();
  for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
       $stock_id=$RS[$i]["stock_id"];
       $stock_name=$RS[$i]["stock_name"];
       $stock[$i]=array($stock_name, $stock_id);
       }
  $arr["aaData"]=$stock; //一定要用 aaData
  echo json_encode($arr); //將陣列轉成 JSON 資料格式傳回  
-----------------------------------------------------------------------------*/
function get_datatable($id, $url, $column, $scrollY="400px",  
                       $paginate=false, $page_buttons="", $jqueryui=false, 
                       $locale="zh-TW") {
  $opt=Array();
  if ($locale=="zh-TW") { //繁體中文化
      $opt[]='"oLanguage":{"sProcessing":"處理中...",'.
             '"sLengthMenu":"顯示 _MENU_ 項結果",'.
             '"sZeroRecords":"沒有匹配結果",'.
             '"sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",'.
             '"sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",'.
             '"sInfoFiltered":"(從 _MAX_ 項結果過濾)",'.
             '"sSearch":"搜索:",'.
             '"oPaginate":{"sFirst":"首頁",'.
             '"sPrevious":"上頁",'.
             '"sNext":"下頁",'.
             '"sLast":"尾頁"}}';
      }
  if ($jqueryui) {$opt[]='"bJQueryUI":true';} //預設 false
  if ($scrollY!="") { //水平卷軸
      $opt[]='"sScrollY":"'.$scrollY.'"';
      $opt[]='"bScrollCollapse":true';
      } 
  if ($paginate) { //預設 true
      if ($page_buttons != "") { //預設 "two_button"
          $opt[]='"sPaginationType":"full_numbers"'; 
          }
      }
  else {$opt[]='"bPaginate":false';}
  $opt[]='"bProcessing":true'; 
  $columns=array();
  for ($i=0; $i<count($column["title"]); $i++) {
       if ($column["title"][$i] != "") {
           $arr[]='"sTitle":"'.$column["title"][$i].'"';
           }           
       if ($column["width"][$i] != "") {
           $arr[]='"sWidth":"'.$column["width"][$i].'"';
           }
       if ($column["class"][$i] != "") {
           $arr[]='"sClass":"'.$column["class"][$i].'"';
           }
       if ($column["type"][$i] != "") {
           $arr[]='"sType":"'.$column["type"][$i].'"';
           }
       $columns[]='{'.join(",", $arr).'}';
       $arr=null; //重置
       } 
  $opt[]='"aoColumns":['.join(",", $columns).']';
  $opt[]='"sAjaxSource":"'.$url.'"';
  $opt="{".join(",", $opt)."}";
  $result="<table id='".$id."'></table>\n".
          "<script>$('#".$id."').dataTable(".$opt.");</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_autocomplete($id, $source, $minLength=0)
功能 : 
  產生 jQuery UI 自動完成功能字串.			
參數 :  
  $id        : 文字框之 id                                 
  $source    : 資料來源字串, 可以是下列三種 :
               1. 本機陣列 Javascript 字串 : 
                  例如 $source="['Choice1', 'Choice2']"; 
               2. 本機 JSON 物件陣列字串 : 
                  例如 $source="[{label:'Choice1', value:'value1'},".
                               "{label:'Choice2', value:'value2'}]";
                  其中 label 會顯示在建議選單, 而 value 則顯示於文字框中
               3. URL 字串 (Ajax 動態擷取) : 
                  會傳回 JSON 格式資料之 URL (若為不同主機則須 JSONP), 例如 :
                  $source="'get_suggestions.php'"; (須兩重引號, 單雙無妨)
                  注意, 伺服端輸出之 JSON 必須用雙引號, 例如 : 
                  echo '[{label:"Choice1", value:"value1"},'.
                        '{label:"Choice2", value:"value2"}]';
                  若輸出單引號格式將無作用. 
                  自動完成不會過濾結果, 但會以 GET 方式將使用者輸入值用 term 
                  變數送給伺服端, 例如 :
                  get_suggestions.php?term=12
                  伺服端可利用 term 來過濾要回傳之資料. 
  $minLength : 開始搜尋來源顯示選單最少須輸入之字元數目 (預設 0)
傳回值 :
  字串
範例 :
  //來源=本機自訂陣列
  $source="['Choice1', 'Choice2']";
  //來源=從資料庫取得資料產生本機陣列
  $SQL="SELECT stock_id,stock_name FROM stocks_list ORDER BY stock_id";
  $RS=run_sql($SQL);
  for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
       $id[]="'".$RS[$i]["stock_id"]."'";
       }
  $source="[".join(",",$id)."]";  //製作 Javascript 陣列
  //來源=本機物件陣列
  $source="[{label:'Choice1',value:'value1'},".
          "{label:'Choice2',value:'value2'}]";
  //來源=遠端伺服器程式
  $source="'get_stocklist.php'";
  echo "股票: ".get_autocomplete("auto1", $source, 1);
  //伺服端提供 JSON 的程式
  header('Content-type: application/json; charset=utf-8');
  include_once("dbsettings.php"); //匯入資料庫設定檔
  include_once("mysql.php"); //匯入資料庫模組
  $term=$_GET["term"];
  $SQL="SELECT stock_id,stock_name FROM stocks_list ".
       "WHERE stock_id LIKE '".$term."%' ORDER BY stock_id"; //用 term 過濾
  for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
       $id=$RS[$i]["stock_id"];
       $name=$RS[$i]["stock_name"];
       $stock[]='{"label":"'.$id.'('.$name.')","value":"'.$id.'"}';
       //$stock[]="{'label':'".$id."(".$name.")','value':'".$id."'}"; //無效
       }
  echo "[".join(",",$stock)."]";
-----------------------------------------------------------------------------*/
function get_autocomplete($id, $source, $minLength=0) {
  $opt="{source:".$source.",minLength:".$minLength."}";  
  if ($label!="") {$label="<label for='".$id."'>".$label.": </label>\n";}
  $result=$label.
          "<input id='".$id."'>\n".
          "<script>$('#".$id."').autocomplete(".$opt.");</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_datepicker($id, $change_YM=false, $show_week=false, $locale="zh-TW")
功能 : 
  產生 jQuery UI 日期選取器內容.			
參數 :                                   
  $id        : 日期選擇器 input/div/span 元素之 id
  $change_YM : 是否顯示年月更改選單, true=顯示, false=不顯示 (預設)
  $show_week : 是否顯示週數欄位, true=顯示, false=不顯示 (預設)
  $locale    : 語言設定, 預設 "zh-TW"
傳回值 :
  字串
範例 : 
  echo get_datepicker("datepicker1"); //不顯示年月下拉式選單, 中文
  echo get_datepicker("datepicker2",true); //顯示年月下拉式選單, 中文
  echo get_datepicker("datepicker3",false,false,""); //不顯示下拉式選單, 英文
  echo get_datepicker("datepicker4",true,true); //顯示下拉式選與週, 中文
  echo get_datepicker("datepicker5",true,true,""); //顯示下拉式選與週, 英文
-----------------------------------------------------------------------------*/
function get_datepicker($id, $change_YM=false, $show_week=false, 
                        $locale="zh-TW") {
  $opt=Array();
  if ($change_YM) {$opt[]="changeYear: true"; $opt[]="changeMonth: true";}
  if ($locale=="zh-TW") { //繁體中文化
      $opt[]='dayNames:["星期日","星期一","星期二","星期三","星期四",'.
             '"星期五","星期六"]'; //星期欄位名稱全名 (提示)
      $opt[]='dayNamesMin:["日","一","二","三","四","五","六"]'; //星期欄位名稱
      $opt[]='monthNames:["一月","二月","三月","四月","五月","六月",'.
             '"七月","八月","九月","十月","十一月","十二月"]'; //標題月份名稱
      $opt[]='monthNamesShort:["一月","二月","三月","四月","五月","六月",'.
             '"七月","八月","九月","十月","十一月","十二月"]'; //月份下拉式名稱
      $opt[]='prevText:"上月"'; //上月按鈕提示
      $opt[]='nextText:"次月"'; //次月按鈕提示
      $opt[]='weekHeader:"週"'; //週數欄位名稱      
      }
  if ($show_week) {$opt[]='showWeek:true';} //顯示週數
  $opt[]='dateFormat:"yy-mm-dd"'; //input 日期格式
  $opt[]='showMonthAfterYear:true'; //標題月在年後
  $opt="{".join(",", $opt)."}";
  $result="<input id='".$id."'>\n".
          "<script>$('#".$id."').datepicker(".$opt.");\n</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_datetimepicker($id, $picker_type="slider", $change_YM=false, 
                   $show_week=false, $locale="zh-TW")
功能 : 
  產生 jQuery UI 日期時間選取器內容 (第三方插件).			
參數 :                                   
  $id          : 日期選擇器 input/div/span 元素之 id
  $picker_type : 時間選擇器類型 : 
                 "slider" (預設), "touch" (按鈕+滑動桿), "select" (下拉式選單)
  $change_YM   : 是否顯示年月更改選單, true=顯示, false=不顯示 (預設)
  $show_week   : 是否顯示週數欄位, true=顯示, false=不顯示 (預設)
  $locale      : 語言設定, 預設 "zh-TW"
傳回值 :
  字串
範例 : 
  echo get_datetimepicker("datetimepicker1"); //預設 slider
  echo get_datetimepicker("datetimepicker1", "select"); //下拉式選單
  echo get_datetimepicker("datetimepicker1", "touch"); //按鈕+滑動桿
-----------------------------------------------------------------------------*/
function get_datetimepicker($id, $picker_type="slider", $change_YM=false,  
                            $show_week=false, $locale="zh-TW") {
  $opt=Array();
  if ($change_YM) {$opt[]="changeYear: true"; $opt[]="changeMonth: true";}
  if ($locale=="zh-TW") { //繁體中文化
      $opt[]='dayNames:["星期日","星期一","星期二","星期三","星期四",'.
             '"星期五","星期六"]'; //星期欄位名稱全名 (提示)
      $opt[]='dayNamesMin:["日","一","二","三","四","五","六"]'; //星期欄位名稱
      $opt[]='monthNames:["一月","二月","三月","四月","五月","六月",'.
             '"七月","八月","九月","十月","十一月","十二月"]'; //標題月份名稱
      $opt[]='monthNamesShort:["一月","二月","三月","四月","五月","六月",'.
             '"七月","八月","九月","十月","十一月","十二月"]'; //月份下拉式名稱
      $opt[]='prevText:"上月"'; //上月按鈕提示
      $opt[]='nextText:"次月"'; //次月按鈕提示
      //以下為 timepicker 的繁體中文化選項
      $opt[]='timeOnlyTitle:"選擇時分秒"';      
      $opt[]='timeText:"&nbsp;&nbsp;&nbsp;<b>時間</b>"';        
      $opt[]='hourText:"&nbsp;&nbsp;&nbsp;<b>時</b>"';     
      $opt[]='minuteText:"&nbsp;&nbsp;&nbsp;<b>分</b>"';      
      $opt[]='secondText:"&nbsp;&nbsp;&nbsp;<b>秒</b>"';       
      $opt[]='millisecText:"毫秒"';       
      $opt[]='timezoneText:"時區"';       
      $opt[]='currentText:"現在時間"';       
      $opt[]='closeText:"確定"';       
      $opt[]='amNames:["上午","AM","A"]';       
      $opt[]='pmNames:["下午","PM","P"]';       
      }
  if ($show_week) {$opt[]='showWeek:true';} //顯示週數
  $opt[]='showMonthAfterYear:true'; //標題月在年後
  $opt[]='dateFormat:"yy-mm-dd"'; //日期格式
  $opt[]='timeFormat:"HH:mm:ss"'; //時間格式
  $opt[]='showSecond:true'; //顯示秒數
  $opt[]='showButtonPanel:false'; //不顯示下方 Now 與 Close 按鈕
  if ($picker_type=="touch") { //按鈕+滑動桿
      $opt[]='addSliderAccess:true';
      $opt[]='sliderAccessArgs:{touchonly:false}';
      } 
  else if ($picker_type=="select") { //下拉式選單
      $opt[]='controlType:"select"';
      }
  else { //預設=滑動桿
      $opt[]='stepHour:1';
      $opt[]='stepMinute:1';
      $opt[]='stepSecond:1';
      }
  $opt="{".join(",", $opt)."}";
  $result="<input id='".$id."'>\n".
          "<script>$('#".$id."').datetimepicker(".$opt.");\n</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_accordion($id, $header, $content)
功能 : 
  此函數用來建立 jQuery UI 之摺疊選單功能.			
參數 :   
  $id      : 摺疊選單 div 之 id                              
  $header  : 標題陣列
  $content : 內容陣列
傳回值 :
  字串
範例 : 
  $header=Array("標題一","標題二","標題三");
  $content=Array("內容一","內容二","內容三");
  echo get_accordion("acc1",$header,$content);
-----------------------------------------------------------------------------*/
function get_accordion($id, $header, $content) {
  $result="<div id='".$id."'>\n";
  for ($i=0; $i<count($header); $i++) {
       $result .= "  <h3>".$header[$i]."</h3>\n".
                  "  <div>".$content[$i]."</div>\n";
       }
  $result .= "</div>\n".
             "<script>$('#".$id."').accordion();</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_msgbox($id, $title="", $content="", $button="OK", $modal=false)
功能 : 
  產生 jQuery UI 按鈕內容.			
參數 : 
  $id      : 對話框 div 元素之 id 
  $title   : 對話框標題 (div 元素之 title 屬性)
  $content : 對話框內容 (HTML 格式可)
  $button  : 按鈕上的文字
  $modal   : 是否為強制模式 (預設 FALSE)
傳回值 :
  字串
範例 : 
  echo get_msgbox("dialog1","錯誤訊息","非管理員不能刪除","確定");
  echo get_button("button1","刪除");
  //控制設定部份
  $('#button1').click(function(){
    $('#dialog1').dialog('open'); //開啟訊息框
    });
-----------------------------------------------------------------------------*/
function get_msgbox($id, $title="", $content="", $button="OK", $modal=false) {
  if ($modal) {$modal="modal:true";}
  else {$modal="modal:false";}
  $opt="{".$modal.",autoOpen:false,buttons:{'".$button."':function(){".
       "\$(this).dialog('close');}}}"; //函數中的 $ 必須脫逸, 否則錯誤
  $result="<div id='".$id."' title='".$title."'>\n".$content."\n</div>\n".
          "<script>$('#".$id."').dialog(".$opt.");</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_dialog($id, $title="", $content="", $modal=false)
功能 : 
  產生 jQuery UI 對話框內容.			
參數 : 
  $id      : 對話框 div 元素之 id 
  $title   : 對話框標題 (div 元素之 title 屬性)
  $content : 對話框內容 (HTML 格式)
  $modal   : 是否為強制模式 (預設 false)
傳回值 :
  字串
範例 : 
  echo get_dialog("dialog1","確認訊息","確定要刪除嗎?");
  //jQuery 部份
  $('#dialog1').dialog({
    buttons:{
             "確定":function(){},
             "取消":function(){$(this).dialog("close");}
            }
    }); //設定按鈕與 click 事件處理器
  $('#dialog1').dialog({
    buttons:{"確定":function(){$(this).dialog("close");}}
    }); //實作 msgbox
-----------------------------------------------------------------------------*/
function get_dialog($id, $title="", $content="", $modal=FALSE) {
  if ($modal) {$modal="modal:true";}
  else {$modal="modal:false";}
  $opt="{".$modal.",autoOpen:false}"; //預設非強制, 不自動開啟
  $result="<div id='".$id."' title='".$title."'>\n".$content."\n</div>\n".
          "<script>$('#".$id."').dialog(".$opt.");</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_button($id, $label, $icon_left="", $icon_right="")
功能 : 
  產生 jQuery UI 按鈕內容.			
參數 : 
  $id         : 按鈕的 id
  $label      : 按鈕上顯示的文字
  $icon_left  : 按鈕左方圖案, 預設 "" 不顯示, 可傳入之值如下.
  $icon_right : 按鈕左方圖案, 預設 "" 不顯示, 可傳入之值如下 :
                "search"=搜尋 "wrench"=扳手 "search"=搜尋  "copy"=複製
                "gear"=設定   "home"=主頁   "hear"=心形    "clipboard"=剪貼簿
                "info"=訊息   "alert"=注意  "help"=協助    "check"=確認
                "play"=播放   "pause"=暫停  "stop"=停止    "trash"=垃圾桶    
                其餘 icon 名稱詳參 : (去掉前面的 ui-icon-)
                http://www.petefreitag.com/cheatsheets/jqueryui-icons/
傳回值 :
  字串
範例 : 
  echo get_button("button1","刪除"); //產生一個按鈕 widget
  相關按鈕事件 
  $('#button1').click(function(){ //按下按鈕 button1 時
    $('#dialog1').dialog('open'); //打開對話框 dialog1
    });
-----------------------------------------------------------------------------*/
function get_button($id, $label, $icon_left="", $icon_right="") {
  if ($icon_left!="") {$icon[]='primary: "ui-icon-'.$icon_left.'"';}
  if ($icon_right!="") {$icon[]='secondary: "ui-icon-'.$icon_right.'"';}
  if (count($icon)!=0) {$opt="{icons: {".join(",",$icon)."}}";}
  else {$opt="";}
  $result="<button id='".$id."'>".$label."</button>\n".
          "<script>\n$('#".$id."').button(".$opt.");</script>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_highlight($content, $title="Notice!")
功能 : 
  產生 jQuery UI 高亮度 (黃色背景) 內容.			
參數 :                                   
  $content : 內容
  $title   : 標題 (粗體)
傳回值 :
  字串
範例 : 
  $result=get_highlight("無法建立資料庫 $database !","注意");
-----------------------------------------------------------------------------*/
function get_highlight($content, $title="Notice!") {
  $result="<div class='ui-widget'>\n".
          "  <div class='ui-state-highlight ui-corner-all' style='".
          "margin-top: 20px; padding: 0 .7em;'>\n".
          "  <p><span class='ui-icon ui-icon-info' style='".
          "float: left; margin-right: .3em;'></span>\n".
          "<strong>".$title."</strong> \n".$content."</p>\n";
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_alert($content, $title="Alert!")
功能 : 
  產生 jQuery UI 注意 (紅色背景) 內容.		
參數 :                                   
  $content : 內容
  $title   : 標題 (粗體)
傳回值 :
  字串
範例 : 
  $result=get_alert("無法建立資料庫 $database !","注意");
-----------------------------------------------------------------------------*/
function get_alert($content, $title="Notice!") {
  $result="<div class='ui-widget'>\n".
          "  <div class='ui-state-error ui-corner-all' style='".
          "padding: 0 .7em;'>\n".
          "  <p><span class='ui-icon ui-icon-alert' style='".
          "float: left; margin-right: .3em;'></span>\n".
          "<strong>".$title."</strong> \n".$content."</p>\n";
  return $result;
  } 
?>