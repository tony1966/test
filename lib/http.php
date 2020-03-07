<?php
/*-----------------------------------------------------------------------------
Title        : PHP MySQL API
Translator   : Tony
Version      : v1.0.0
Prototype    : 2013/03/26
Last Updated : 2013/03/30
Usage        : Manipulate HTTP Request
Note         : This software is translated from Michael Schrenk's work.
               It is only for private use.
               Original : http://www.webbotsspidersscreenscrapers.com/
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
功能 : 設定 HTTP 請求常數  
-----------------------------------------------------------------------------*/   
//定義在被請求之伺服器 LOG 上出現之請求者名稱 (偽裝)
define("WEBBOT_NAME", "Internet Explorer"); 
define("CURL_TIMEOUT", 25); //cURL 等候回應之時間 (秒)
define("COOKIE_FILE", realpath(".")."/cookie.txt"); //您的 cookie 存放位置
//定義 HTTP 請求方法常數
define("HEAD", "HEAD");
define("GET",  "GET");
define("POST", "POST");
//定義是否包含標頭之常數
define("EXCL_HEAD", FALSE);
define("INCL_HEAD", TRUE);
/*-----------------------------------------------------------------------------
function http_get($target, $ref)
功能 : 
  以 GET 方法擷取擷取一個網路上的檔案 (僅內容, 不含 HTTP 標頭的 ASCII 檔案).	
  ** 但測試發現含有標頭 ???
參數 :                                   
   $target : 要下載之檔案 URL                     
   $ref    : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 檔案內容 (HTML 之 BODY 部分, 不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?select2=ALLBUT0999&".
          "chk_date=100/11/25";
  $web_page=http_get($target,"");
  echo "<xmp>".$web_page['FILE']."</xmp>";
-----------------------------------------------------------------------------*/
function http_get($target, $ref) {
  return http($target, $ref, $method="GET", $data_array="", EXCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_get_withheader($target, $ref)
功能 : 
  以 GET 方法擷取擷取一個網路上的檔案 (含 HTTP 標頭). 
  傳回的檔案內容 $return_array['FILE']=標頭+內容
參數 :                                   
   $target : 要下載之檔案 URL                     
   $ref    : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 檔案內容 (含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?select2=ALLBUT0999&".
          "chk_date=100/11/25";
  $web_page=http_get_withheader($target,"");
  echo "<xmp>".$web_page['FILE']."</xmp>"; 
-----------------------------------------------------------------------------*/
function http_get_withheader($target, $ref) {
  return http($target, $ref, $method="GET", $data_array="", INCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_get_form($target, $ref, $data_array)
功能 : 
  以 GET 方法提交表單, 並下載一個不含 HTTP 標頭的頁面 (即表單 ACTION 屬性所指).		
參數 :                                   
   $target     : 要下載之檔案 URL 
   $data_array : 定義表單變數的關聯式陣列
   $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_get_form($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http_get_form($target, $ref, $data_array) {
  return http($target, $ref, $method="GET", $data_array, EXCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_get_form_withheader($target, $ref, $data_array)
功能 : 
  與 http_get_form() 相同, 但只傳回 HTTP 標頭.			
參數 :                                   
   $target     : 要下載之檔案 URL 
   $data_array : 定義表單變數的關聯式陣列
   $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_get_form_withheader($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http_get_form_withheader($target, $ref, $data_array) {
  return http($target, $ref, $method="GET", $data_array, INCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_post_form($target, $ref, $data_array) 
功能 : 
  以 POST 方法提交表單, 並下載一個不含 HTTP 標頭的頁面 (即表單 ACTION 屬性所指).	
參數 :                                   
  $target     : 要下載之檔案 URL 
  $data_array : 定義表單變數的關聯式陣列
  $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_post_form($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http_post_form($target, $ref, $data_array) {
  return http($target, $ref, $method="POST", $data_array, EXCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_post_withheader($target, $ref, $data_array) 
功能 : 
  與 http_post_form() 相同, 但只傳回 HTTP 標頭.			
參數 :                                   
  $target     : 要下載之檔案 URL 
  $data_array : 定義表單變數的關聯式陣列
  $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_post_withheader($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http_post_withheader($target, $ref, $data_array) {
  return http($target, $ref, $method="POST", $data_array, INCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http_header($target, $ref, $data_array)
功能 : 
  與 http_get_form() 相同, 但只傳回 HTTP 標頭.			
參數 :                                   
   $target     : 要下載之檔案 URL 
   $data_array : 定義表單變數的關聯式陣列
   $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_header($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http_header($target, $ref) { 
  return http($target, $ref, $method="HEAD", $data_array="", INCL_HEAD);
  }
/*-----------------------------------------------------------------------------
http($target, $ref, $method, $data_array, $incl_head) 
功能 : 
  以 GET 方法擷取一個 HTML 頁面 (即表單 ACTION 屬性所指).	所有 HTTP 重導向將被
  跟隨. 此為以上所有函式共同呼叫之母函式, 請直接使用上述包裹函式, 最好不要直接
  呼叫 http() 函式. 
參數 :                                   
  $target     : 要下載之檔案 URL 
  $ref        : 伺服器 referer 變數 (偽裝用之來源網址,不用的話設為 "")  
  $method     : HTTP 方法=HEAD, GET, POST
  $data_array : 定義表單變數的關聯式陣列
  $incl_head  : TRUE=包含 HTTP 標頭, FALSE=不含 HTTP 標頭 
傳回值 :
  關聯式陣列 :
  $return_array['FILE']   : 所取得之檔案內容 (不含 HTTP 標頭)   
  $return_array['STATUS'] : CURL 產生之傳送狀態     
  $return_array['ERROR']  : CURL 產生之錯誤狀態        
範例 : 
  $target="http://www.twse.com.tw/ch/trading/exchange/MI_INDEX/genpage/".
          "Report201111/A11220111125ALLBUT0999_1.php?";
  $data_array["select2"]="ALLBUT0999";
  $data_array["chk_date"]="100/11/25";
  $web_page=http_post_form($target,"",$data_array);
-----------------------------------------------------------------------------*/
function http($target, $ref, $method, $data_array, $incl_head) {
  $ch=curl_init(); //初始化 PHP/CURL handle
  if (is_array($data_array)) { //處理 $data_array
      //將 $data_array 陣列轉為請求字串, 例如 animal=dog&sport=baseball
      foreach ($data_array as $key => $value) { 
               if (strlen(trim($value))>0) {
                   $temp_string[]=$key . "=" . urlencode($value);
                   }
               else {$temp_string[]=$key;}
               } //end of foreach
      $query_string=join('&', $temp_string);
      } //end of if 
  //設定 CURL 參數
  if ($method==HEAD) { //設定標頭方法
      curl_setopt($ch, CURLOPT_HEADER, TRUE); //有 HTTP 標頭
      curl_setopt($ch, CURLOPT_NOBODY, TRUE); //不回傳 BODY
      } //end of if
  else { //不是 HEAD 方法
      if ($method==GET) { //設定 GET 方法
          if (isset($query_string)) {$target=$target."?".$query_string;} 
          curl_setopt($ch, CURLOPT_HTTPGET, TRUE); //GET 方法
          curl_setopt($ch, CURLOPT_POST, FALSE); //不是 POST
          } //end of if
      if ($method==POST) { //設定 POST 方法
          if (isset($query_string)) {
              curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
              } //end of if
          curl_setopt($ch, CURLOPT_POST, TRUE); //POST 方法 
          curl_setopt($ch, CURLOPT_HTTPGET, FALSE); //不是 GET
          } //end of if
      curl_setopt($ch, CURLOPT_HEADER, $incl_head); //設定包含標頭與否
      curl_setopt($ch, CURLOPT_NOBODY, FALSE); //傳回 BODY
      } //end of else        
  curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE); //設定 Cookie 位置
  curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE); //設定 Cookie 位置
  curl_setopt($ch, CURLOPT_TIMEOUT, CURL_TIMEOUT); //設定等待計時器
  curl_setopt($ch, CURLOPT_USERAGENT, WEBBOT_NAME); //網路機器人名字
  curl_setopt($ch, CURLOPT_URL, $target); //設定目標網站 URL
  curl_setopt($ch, CURLOPT_REFERER, $ref); //設定 Referer
  curl_setopt($ch, CURLOPT_VERBOSE, FALSE); //最小化 logs
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //不需要認證
  #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); //設定重導向跟隨
  curl_setopt($ch, CURLOPT_MAXREDIRS, 4); //設定最大重導向次數
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //設定傳回字串    
  //製作傳回陣列
  if (ini_get('open_basedir')=='' && ini_get('safe_mode')=='Off') {
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      $return_array['FILE']=curl_exec($ch);
      } //end of if
  else {$return_array['FILE']=curl_redir_exec($ch);} //以重導向模式擷取
  $return_array['FILE']=curl_exec($ch); //執行 CURL, 取得傳回之檔案內容
  $return_array['STATUS']=curl_getinfo($ch); //取得請求狀態
  $return_array['ERROR']=curl_error($ch); //取得錯誤訊息
  curl_close($ch); //關閉 PHP/CURL handle
  return $return_array; //回傳結果陣列
  }

function curl_redir_exec($ch) { //要求之 URL 有重導向時
  static $curl_loops=0; //CURL 迴圈次數 (計算重導向次數用)
  static $curl_max_loops=20; //設定最大 CURL 迴圈次數
  if ($curl_loops++>= $curl_max_loops) { 
      $curl_loops = 0;
      return FALSE; //超過最大重導向次數傳回 FALSE
      } //end of if
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data=curl_exec($ch);
  list($header, $data)=explode("\n\r", $data, 2);
  $http_code=curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if ($http_code==301 || $http_code==302) { //要求之 URL 已轉移 (301=永久)
      $matches=array();
      preg_match('/Location:(.*?)\n/', $header, $matches);
      $url=@parse_url(trim(array_pop($matches)));
      if (!$url) { //無法處理重導向之 URL
          $curl_loops=0;
          return $data;
          } //end of if
     $last_url=parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
     if (!$url['scheme']) {$url['scheme']=$last_url['scheme'];}
     if (!$url['host']) {$url['host']=$last_url['host'];}
     if (!$url['path']) {$url['path']=$last_url['path'];}
     $new_url=$url['scheme'] . '://' . $url['host'] . $url['path'] . 
              ($url['query']?'?'.$url['query']:''); //製作重導向新 URL
     curl_setopt($ch, CURLOPT_URL, $new_url); //重設擷取網址
     return curl_redir_exec($ch); //以新網址遞迴擷取
     } //end of if
  else { //要求之 URL 沒有重導向
     $curl_loops=0;
     return $data;
     } //end of else
  }
/*-----------------------------------------------------------------------------
send_ppsms($mobile_number, $message, $user, $pwd, $key, $time="")
功能 : 
  呼叫智邦 PP 簡訊 API 的發送簡訊.
  網址 : http://pp.url.com.tw/
  API 功能與 PHP 範例 : http://pp.url.com.tw/option/api
  查詢點數餘額 : http://login.url.com.tw/sharepoint/balance 
  (登入-會員中心-儲值點數)
參數 :                                   
   $mobile_number : 行動電話號碼 
   $message       : 簡訊內容    
   $user          : 智邦 PP 帳號 
   $pwd           : 智邦 PP 密碼 
   $key           : 智邦 PP KEY
   $time          : 傳送時間 (預約須大於 10 分鐘以上) '2011-01-01 12:45:00'
                    預設為空字串 "", 會立即傳送.
傳回值 :
  成功傳回 TRUE, 失敗傳回錯誤原因.        
範例 : 
   $mobile_number="0933631817"; 
   $message="Test SMS via 000webhost.com 簡訊測試 ^_^";
   $user="HT";
   $pwd="wid"; 
   $key="0cdbc9460526391ae97aed738b2018cd"; 
   $time='2011-01-01 12:45:00'; //指定時間傳送
   $result=send_ppsms($mobile_number,$message,$user,$pwd,$key,$time); 
   $result=send_ppsms($mobile_number,$message,$user,$pwd,$key); //立即傳送
   if ($result==TRUE) {echo "Success : SMS has been sent.";}
   else {echo $result;}
-----------------------------------------------------------------------------*/
function send_ppsms($mobile_number, $message, $user, $pwd, $key, $time="") { 
  $login=curl_init("http://pp.url.com.tw/api/msg"); //智邦 PP 簡訊發送網址  
  $post_string=array('api_key'   => $key,
                     'user_name' => $user,
                     'password'  => $pwd,
                     'sms_list'  => $mobile_number,
                     'sms_body'  => $message,
                     'sms_time'  => $time);
  curl_setopt($login, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($login, CURLOPT_POST, 1);
  curl_setopt($login, CURLOPT_POSTFIELDS, $post_string);
  curl_setopt($login, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  $r=curl_exec($login);
  eval('$c='.$r.';');
  if ($c['status']=='OK') {return TRUE;} 
  else {echo $c['message'];}
  }
?>