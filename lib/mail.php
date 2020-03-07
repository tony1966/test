<?php
/*-----------------------------------------------------------------------------
Title        : PHP Mail API
Translator   : Tony
Version      : v1.0.0
Prototype    : 2013/03/26
Last Updated : 2013/03/30
Usage        : Manipulate PHP Mail
Note         : This software is translated from Michael Schrenk's work.
               It is only for private use.
               Original : http://www.webbotsspidersscreenscrapers.com/
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
formatted_mail($subject, $message, $address, $content_type)
功能 : 
  此函數根據傳入之 MySQL 伺服器位址, 帳號, 密碼建立資料庫連線並傳回連線識別字.		
參數 :                                   
  $subject      : 郵件主旨字串
  $message      : 郵件內容字串
  $address      : 郵件位址之關聯陣列 :
                  $address['to']      : 收件者地址                       
                  $address['from']    : 寄件者地址                        
                  $address['replyto'] : 回覆地址                
                  $address['cc']      : 副本收件者地址        
                  $address['bcc']     : 密件副本收件者地址
  $content_type : 定義郵件內容之 MIME 類型. 
                  "Text/plain" : 純文字               
                  "Text/html"  : HTML 格式
傳回值 :
  成功傳回 TRUE, 失敗傳回 FALSE
範例 :
  formatted_mail($subject, $message, $address, $content_type)
-----------------------------------------------------------------------------*/
function formatted_mail($subject, $message, $address, $content_type) {
  if (!isset($address['cc'])) {$address['cc']="";} //設定副本收件人預設值
  if (!isset($address['bcc'])) {$address['bcc']="";} //設定密件副本收件人預設值
  //若沒有指定回覆位址, 預設為寄件人位址 (這很重要, 因為郵件無法遞送時, 也是
  //通知 "Reply-To:" 位址的, 若沒有設定就會變成通知郵件伺服器管理員, 寄件人
  //不知道郵件沒有送達, 此處未指定時, 預設值為寄件人位址.
  if (!isset($address['replyto'])) {$address['replyto']=$address['from'];}    
  //設定郵件標頭
  $headers=""; 
  $headers=$headers."From: ".$address['from']."\r\n"; //設定標頭:寄件人
  $headers=$headers."Return-Path: ".$address['from']."\r\n"; //設定標頭:回傳路徑
  $headers=$headers."Reply-To: ".$address['replyto']."\r\n"; 設定標頭:回覆位址
  if (strlen($address['cc'])< 0 ) { //設定副本收件人
      $headers = $headers . "Cc: ".$address['cc']."\r\n";
      }
  if (strlen($address['bcc'])< 0 ) { //設定密件副本收件人
      $headers = $headers . "Bcc: ".$address['bcc']."\r\n";
      }
  $headers=$headers."Content-Type: ".$content_type."\r\n"; //標頭加上內容類型
  $subject=utf8_b64($subject); //轉換為 base64 之 utf-8, 避免中文引起之亂碼
  $result=mail($address['to'], $subject, $message, $headers); //傳送郵件    
  return $result;
  }
/*-----------------------------------------------------------------------------
utf8_b64($nonascii)
功能 : 
  此函數呼叫 base64_encode() 將非 ASCII 編碼之字串 (例如中文字) 加以編碼, 以免
  郵件主旨變成亂碼. 關於郵件主旨亂碼問題 : 
  郵件內文可以透過標頭中的 "Content-Type:text/plain;charset=utf-8\r\n" 設定, 
  但是主旨 Subject 與寄件人, 收件人, 副本收文者等均非內文, 但卻有可能出現中文 
  (收信者可能使用名稱代號), 在 PHP 傳送郵件時會出現亂碼情形. 在 RFC2047 有提供
  關於在標頭中傳送非 ASCII 碼的修正方式, 以使用 utf-8 傳送為例, 應將原主旨用 
  base64_encode() 函式轉換後以 "=?utf-8?b?" 與 "?=" 括起來. 修正格式以 "=?" 
  起始, 以 "?=" 結束. 第一個參數指定編碼字元集, 第二個參數為編碼格式, b 代表 
  Base64 (以英文字母, 數字, 以及 % 等 64 個字元組成).
參數 :                                   
  $nonascii : 含有非 ASCII 碼之字串 (如中文)
傳回值 :
  傳回 TRUE, 失敗傳回 FALSE
範例 :
  $from=utf8_b64($_POST["from"]);
  $subject=utf8_b64($_POST["subject"]);
-----------------------------------------------------------------------------*/
function utf8_b64($nonascii) {     
  return $utf8b64="=?utf-8?b?".base64_encode($nonascii)."?=";
  }
?>
