<?php
header('Content-Type: text/html;charset=UTF-8');
function httpPost($url,$params) {
  //製作參數字串 (p1=v1&p2=v2...)
  $postData=""; //提交參數字串初始值
  foreach($params as $k => $v) {$postData .= $k . '='.$v.'&';} //串接參數字串
  rtrim($postData,'&'); //去掉最後一個 &
  //設定 Request 標頭
  $header=array( 
    'Host: www.tdcc.com.tw',
    'Referer: http://www.tdcc.com.tw/smWeb/QryStock.jsp'
    );
  //啟始 curl
  $ch=curl_init(); 
  //設定 curl 選項
  curl_setopt($ch,CURLOPT_URL,$url); //設定 url
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE); //以文件傳回,不要直接輸出
  curl_setopt($ch,CURLOPT_COOKIEJAR,"cookies.txt"); //寫入 cookie 檔
  curl_setopt($ch,CURLOPT_COOKIEFILE,"cookies.txt"); //送出 cookie 檔
  curl_setopt($ch,CURLOPT_HEADER,TRUE); //要送出標頭
  curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
  curl_setopt($ch,CURLOPT_USERAGENT,getRandomUserAgent()); //設定隨機 UA
  curl_setopt($ch,CURLOPT_POST,TRUE);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$postData); //設定參數欄位    
  $output=curl_exec($ch); //執行 curl
  curl_close($ch); //關閉 curl
  $output=iconv("BIG5","UTF-8",$output); //轉成 utf-8 格式
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
    "(like Gecko) Safari/48",
    "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 ".
    "(KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36"
    );
  $random=rand(0,count($userAgents)-1);
  return $userAgents[$random];
  }
$params=array(
  "SCA_DATE" => "20150430",
  "SqlMethod" => "StockNo",
  "StockNo" => "2412",
  "StockName" => "",
  "sub" => "查詢"
  );
$url="http://www.tdcc.com.tw/smWeb/QryStock.jsp";
echo httpPost($url,$params);
?>