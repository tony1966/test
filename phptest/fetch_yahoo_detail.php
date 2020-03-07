<?php
header('Content-Type: text/html;charset=UTF-8');
function http_post($url,$params) {
  $ua="Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 ".
      "(KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36";
  $data=http_build_query($params);   //陣列轉成 URL 字串
  $ch=curl_init();                   //啟始 curl session
  curl_setopt($ch,CURLOPT_URL,$url); //設定 url
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  //不直接輸出,傳回文字流
  curl_setopt($ch,CURLOPT_HEADER,false);         //不需要傳回標頭
  curl_setopt($ch,CURLOPT_USERAGENT,$ua);        //設定 User Agent
  curl_setopt($ch,CURLOPT_POST,true);            //使用 POST 方法傳遞
  curl_setopt($ch,CURLOPT_POSTFIELDS,$data);     //設定要傳送的參數    
  $output=curl_exec($ch);
  curl_close($ch);
  return $output;
  }
$params=array("s" => "2412");
$url="https://tw.stock.yahoo.com/q/ts";
$page=http_post($url,$params);
$page=iconv("BIG5","UTF-8",$page);
echo $page;
?>