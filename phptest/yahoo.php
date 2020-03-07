<?php
header('Content-Type: text/html;charset=UTF-8');
function httpPost($url,$params) {
  //製作參數字串 (p1=v1&p2=v2...)
  $postData=""; //提交參數字串初始值
  foreach($params as $k => $v) {$postData .= $k . '='.$v.'&';} //串接參數字串
  rtrim($postData,'&'); //去掉最後一個 &
  $ch=curl_init(); //啟始 curl
  //設定 curl 選項
  curl_setopt($ch,CURLOPT_URL,$url); //設定 url
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); //設定要傳回字串
  curl_setopt($ch,CURLOPT_HEADER,false); //不需要傳回標頭
  curl_setopt($ch,CURLOPT_USERAGENT,getRandomUserAgent()); //設定隨機 UA
  //curl_setopt($ch,CURLOPT_POST,count($postData)); //設定參數字元數
  curl_setopt($ch,CURLOPT_POST,TRUE);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$postData); //設定參數欄位    
  $output=curl_exec($ch);
  curl_close($ch);
  return $output;
  }
function getRandomUserAgent() {
  $userAgents=array(
    "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) ".
    "Gecko/20070725 Firefox/2.0.0.6",
    "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
    "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322;". 
    ".NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
    "Opera/9.20 (Windows NT 6.0; U; en)",
    "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.50",
    "Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1) ".
    "Opera 7.02 [en]",
    "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; fr; rv:1.7) ".
    "Gecko/20040624 Firefox/0.9",
    "Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 ".
    "(like Gecko) Safari/48"       
    );
  $random=rand(0,count($userAgents)-1);
  return $userAgents[$random];
  }
$params=array("s" => "2412");
$url="https://tw.stock.yahoo.com/q/ts";
$page=httpPost($url,$params);
$page=iconv("BIG5","UTF-8",$page);
echo $page;
?>