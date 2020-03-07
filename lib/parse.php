<?php
/*-----------------------------------------------------------------------------
Title        : PHP MySQL API
Translator   : Tony
Version      : v1.0.0
Prototype    : 2013/03/25
Last Updated : 2013/03/30
Usage        : Manipulate PHP string
Note         : This software is translated from Michael Schrenk's work.
               It is only for private use.
               Original : http://www.webbotsspidersscreenscrapers.com/
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
功能 : 定義常數  
-----------------------------------------------------------------------------*/
define("EXCL", true); //不包含界定字串
define("INCL", false); //包含界定字串
define("BEFORE", true); //回傳界定字元之前部分
define("AFTER", false); //回傳界定字元之後部分
/*-----------------------------------------------------------------------------
split_string($string, $delineator, $desired, $type)
功能 : 
  以指定之界定字串分割字串, 傳回在該界定字串之前或之後的子字串. 
  此函數所處理之字串與大小寫無關, 傳回字串之大小寫不受影響.
參數 :                                   
  $string     : 待分割字串
  $delineator : 界定字串
  $desired    : 傳回部位, BEFORE=界定字串之前, AFTER=界定字串之後
  $type       : 傳回值是否包含界定字串, INCL=包含, EXCL=不含  
傳回值 :
  字串
範例 : 
  $result=split_string($string, $delineator, $desired, $type)
-----------------------------------------------------------------------------*/
function split_string($string, $delineator, $desired, $type) {
  $lc_str=strtolower($string);
	$marker=strtolower($delineator);
  if ($desired==BEFORE) { //傳回界定字串之前部分
      if ($type==EXCL) {$split_here=strpos($lc_str, $marker);} //不含界定字串
      else {$split_here=strpos($lc_str, $marker)+strlen($marker);} //包含        
      $parsed_string=substr($string, 0, $split_here); //取得子字串
     }
  else { //傳回界定字串之後部分
      if($type==EXCL) {$split_here=strpos($lc_str, $marker)+strlen($marker);}
      else {$split_here=strpos($lc_str, $marker);} //包含界定字串
      $parsed_string=substr($string, $split_here, strlen($string));
     }
  return $parsed_string; //傳回子字串
  }
/*-----------------------------------------------------------------------------
return_between($string, $start, $stop, $type)
功能 : 
  此函數會在待剖析字串字串中搜尋指定之起始字串 $start 與結束字串 $stop, 傳回在
  該組界定字串之間的子字串, 型態 $type 用來設定傳回值中是否要包含組界定字串. 
  此函數所處理之字串與大小寫無關, 傳回字串之大小寫不受影響.				
傳回值 :
  字串  
參數 : 
  $string  : 待分割字串                          
  $start   : 起始字串          
  $end     : 結束字串               
  $type    : 傳回值是否包含界定字串, INCL=包含, EXCL=不含 
範例 :
-----------------------------------------------------------------------------*/
function return_between($string, $start, $stop, $type) {
  $temp=split_string($string, $start, AFTER, $type);
  return split_string($temp, $stop, BEFORE, $type);
  }
/*-----------------------------------------------------------------------------
parse_array($string, $start, $stop)
功能 : 
  此函數會在待剖析字串字串中重複搜尋指定之起始字串 $start 與結束字串 $stop 間的
  子字串, 並把每次符合的子字串放入陣列中傳回. 傳回值為陣列, 元素中包含界定字串. 
  此函數所處理之字串與大小寫無關, 傳回陣列中字串之大小寫不受影響.		
傳回值 :
  字串  
參數 : 
  $string : 待分割字串 
  $start  : 起始字串    
  $stop   : 結束字串
範例 :  
-----------------------------------------------------------------------------*/
function parse_array($string, $start, $stop) {
  preg_match_all("($start(.*)$stop)siU", $string, $matching_data);
  return $matching_data[0];
  }
/*-----------------------------------------------------------------------------
remove($string, $start, $stop)
功能 : 
  此函數會在待剖析字串中重複搜尋指定之起始字串 $start 與結束字串 $stop 間的
  子字串, 並把每次符合的子字串從待剖析字串中刪除. 傳回值為刪除後之字串.
  注意, 刪除子字串時會連同界定字串一起刪除.
  此函數所處理之字串與大小寫無關, 傳回字串之大小寫不受影響.						
傳回值 :
  字串  
參數 : 
  $string : 待分割字串 
  $start  : 起始字串    
  $stop   : 結束字串
範例 :
-----------------------------------------------------------------------------*/
function remove($string, $start, $stop) {
  $remove_array=parse_array($string, $start, $stop); //要移除的部分放入陣列
  for ($i=0; $i < count($remove_array); $i++) {
       $string=str_replace($remove_array, "", $string); //設為空字串一一移除
       }
  return $string;
  }
/*-----------------------------------------------------------------------------
tidy_html($input_string)
功能 : 
  此函數會剖析原始網頁,將雜亂不正確的 HTML 碼整理成格式完整正確之 HTML 文件檔案
  格式後傳回. 						
參數 :
  $input_string : HTML 格式字串
傳回值 :
  字串 (HTML 格式字串)
範例 :
  $tidy=tidy_html('<p>paragraph</i>'); 
  結果將傳回 :
  <html>
  <head>
  <title></title>
  </head>
  <body>
  <p>paragraph</p>
  </body>
  </html>
-----------------------------------------------------------------------------*/
function tidy_html($input_string) {
  if (function_exists('tidy_get_release')) { //偵測主機是否有安裝 Tidy
      if (substr(phpversion(), 0, 1)==4) { //處理 PHP4 情況
          tidy_setopt('uppercase-attributes', TRUE);
          tidy_setopt('wrap', 800);
          tidy_parse_string($input_string); //剖析字串 
          $cleaned_html=tidy_get_output(); //轉為 HTML 字串輸出
          } //end of if
      if (substr(phpversion(), 0, 1)==5) { //處理 PHP5 情況
          $config=array('uppercase-attributes' => true,
                        'wrap'                 => 800);
          $tidy=new tidy; //建立 Tidy 物件
          $tidy->parseString($input_string, $config, 'utf8'); //剖析字串
          $tidy->cleanRepair(); //重整為正確之 HTML 格式
          $cleaned_html=tidy_get_output($tidy); //轉為 HTML 字串輸出 
          } //end of if
      } //end of if
  else {$cleaned_html=$input_string;} //此主機未安裝 Tidy, 傳回原字串
  return $cleaned_html; 
  }
/*-----------------------------------------------------------------------------
get_attribute($tag, $attribute)
功能 : 
  此函數會在待剖析 HTML 字串中搜尋指定之屬性值. 					
參數 :   
  $tag        : HTML 元素之標籤名稱, 例如 a, p 等
  $attribute  : HTML 元素之屬性名稱, 例如 style, class 等
傳回值 :
  字串 (屬性值)   
範例 :
-----------------------------------------------------------------------------*/
function get_attribute($tag, $attribute) {
  $cleaned_html=tidy_html($tag); //用 Tidy 重整標籤的 HTML 格式
  $cleaned_html=str_replace("\r", "", $cleaned_html);  //清除回車字元
  $cleaned_html=str_replace("\n", "", $cleaned_html);  //清除跳行字元
  //呼叫 return_between() 取出雙引號中間的屬性值
  return return_between($cleaned_html, strtoupper($attribute)."=\"", "\"", EXCL);
  }
/*-----------------------------------------------------------------------------
space($repeat,$format="text")
功能 : 
  此函數會傳回指定數目的空格. 					
參數 :   
  $repeat : 空格數目
  $format : 空格格式, "text"=純文字空白 (預設), "html"=網頁空白 (&nbsp)
傳回值 :
  空白字串   
範例 :
  $str=space(7)."<p>test</p>";
-----------------------------------------------------------------------------*/
function space($repeat,$format="text") {
  $format=strtolower($format);
  if ($format=="text") {return str_repeat(" ", $repeat);} //傳回純文字空白
  else {return str_repeat("$nbsp", $repeat);} //傳回網頁空白
  }