<?php
header('Content-Type: text/html;charset=UTF-8');
function http_post($url,$params) {
  $ua="Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 ".
      "(KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36";
  $data=http_build_query($params);   //陣列轉成 URL 字串
  $ch=curl_init();                   //啟始 curl session
  curl_setopt($ch,CURLOPT_URL,$url); //設定 url
  curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  //不直接輸出,傳回文字流
  curl_setopt($ch,CURLOPT_AUTOREFERER,true);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION,2);
  $headers=array();
  $cookie="JSESSIONID=0000mcsjq0PxmwWHR9DJVo8ALiq:11qbqhb3v";
  $headers[]='Cookie: '.$cookie;
  $headers[]='Host: www.tdcc.com.tw';
  $headers[]='Origin: http://www.tdcc.com.tw';
  $headers[]='Referer: http://www.tdcc.com.tw/smWeb/QryStock.jsp';
  $headers[]='DNT: 0';
  curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
  curl_setopt($ch,CURLOPT_COOKIEJAR,"cookies.txt");   //寫入 cookie 之檔案
  curl_setopt($ch,CURLOPT_COOKIEFILE,"cookies.txt");  //送出 cookie
  curl_setopt($ch,CURLOPT_HEADER,false);         //不需要傳回標頭
  curl_setopt($ch,CURLOPT_USERAGENT,$ua);        //設定 User Agent
  $output=curl_exec($ch);
  curl_setopt($ch,CURLOPT_POST,true);            //使用 POST 方法傳遞
  curl_setopt($ch,CURLOPT_POSTFIELDS,$data);     //設定要傳送的參數    
  $output=curl_exec($ch);
  curl_close($ch);
  return $output;
  }
$params=array(
  "SCA_DATE" => "20150430",
  "SqlMethod" => "StockNo",
  "StockNo" => "2412",
  "StockName" => "",
  "sub" => "查詢"
  );
$url="http://www.tdcc.com.tw/smWeb/QryStock.jsp";
$page=http_post($url,$params);
$page=iconv("BIG5","UTF-8",$page);
echo $page;
?>