String.prototype.split_string=split_string;
String.prototype.return_between=return_between;
String.prototype.parse_array=parse_array;
String.prototype.remove=remove;
String.prototype.get_attribute=get_attribute;
String.prototype.trim=trim;
String.prototype.ltrim=ltrim;
String.prototype.rtrim=rtrim;
String.prototype.zfill=zfill;
String.prototype.ljust=ljust;
String.prototype.rjust=rjust;
String.prototype.encode=encode;
String.prototype.decode=decode;
/*-----------------------------------------------------------------------------
split_string(delineator, desired, type)
功能 : 
  此函數會在一個待剖析字串中搜尋指定之界定字串 delineator, 依據所需要的位置
  desired, 傳回在該界定字串之前或之後的子字串, 型態 type 用來設定傳回值中是否
  要包含界定字串. 此函數所處理之字串與大小寫無關 (包括參數).								
參數 :                                     
  delineator : 界定字串    
  desired    : "before" : 傳回界定字串前之子字串
               "after"  : 傳回界定字串後之子字串        
  type       : "incl"   : 包含界定字串    
               "excl"   : 不包含界定字串
-----------------------------------------------------------------------------*/
function split_string(delineator, desired, type) {
  //處理預設值
  var desired = String(desired).toLowerCase() || "before"; 
  var type = String(type).toLowerCase() || "excl"; 
  //為與大小寫無關, 全部轉為小寫處理
  var lc_str = String(this).toLowerCase(); 
  var marker = delineator.toLowerCase(); 
  if (lc_str.indexOf(marker, 0) == -1) { //沒找到分割字串:傳回 ""
     return "";
     } 
  else { //有找到分割字串
     if (desired == "before") {  //傳回分割字串前的部分
        if (type == "excl") { //不包含分割字串:不必加分割字串本身       
           var split_here = lc_str.indexOf(marker, 0);
           }  
        else { //包含分割字串:要加計分割字串本身
           var split_here = lc_str.indexOf(marker, 0) + marker.length;
           }   
        var parsed_string = this.substring(0, split_here);
        }
     else { //傳回界定字串後的部分 "after"
        if (type == "excl") { //不包含分割字串:要扣除分割字串本身
           var split_here = lc_str.indexOf(marker, 0) + marker.length;
           }
        else { //包含分割字串:要加計分割字串本身
           var split_here = lc_str.indexOf(marker, 0);
           }        
        var parsed_string = this.substring(split_here, lc_str.length + 1);
        }  
     }
  return parsed_string;
  }
/*-----------------------------------------------------------------------------
return_between(start, stop, type)
功能 : 
  此函數會在待剖析字串字串中搜尋指定之起始字串 start 與結束字串 stop, 傳回在該組
  界定字串之間的子字串, 型態 type 用來設定傳回值中是否要包含組界定字串. 
  此函數所處理之字串與大小寫無關 (包括參數).							
參數 :                                   
  start : 起始字串    
  stop  : 結束字串        
  type  : "incl"   : 包含界定字串    
          "excl"   : 不包含界定字串
-----------------------------------------------------------------------------*/
function return_between(start, stop, type) {
  //傳回起始字串後面的部分
  var temp = this.split_string(start, "AFTER", type); 
  //傳回結束字串前面的部分
  return temp.split_string(stop, "BEFORE", type);  
  }
/*-----------------------------------------------------------------------------
parse_array(start, stop)
功能 : 
  此函數會在待剖析字串字串中重複搜尋指定之起始字串 start 與結束字串 stop 間的
  子字串, 並把每次符合的子字串放入陣列中傳回. 傳回值為陣列, 元素中包含界定字串. 
  此函數所處理之字串與大小寫無關 (包括參數).							
參數 :                                   
  start : 起始字串    
  stop  : 結束字串  
-----------------------------------------------------------------------------*/
function parse_array(start, stop) {
  var reg=new RegExp("(" + start + "([\\s\\S]*?)" + stop + ")","ig"); 
  return this.match(reg);  //傳回符合之陣列
  }
/*-----------------------------------------------------------------------------
remove(start, stop)
功能 : 
  此函數會在待剖析字串中重複搜尋指定之起始字串 start 與結束字串 stop 間的
  子字串, 並把每次符合的子字串從待剖析字串中刪除. 傳回值為刪除後之字串.
  注意, 刪除子字串時會連同界定字串一起刪除.
  此函數所處理之字串與大小寫無關 (包括參數). 							
參數 :                                   
  start : 起始字串    
  stop  : 結束字串 
-----------------------------------------------------------------------------*/
function remove(start, stop) {
  var remove_array = this.parse_array(start, stop);  //傳回要移除的子字串陣列
  var string = this; 
  if (remove_array != null) { //有找到子字串:執行刪除
    for (var i = 0; i < remove_array.length; i++) {    //依序移除
      var reg = new RegExp(remove_array[i],"ig");    //要刪除之子字串 reg 物件
      var string = string.replace(reg, "");
      }
    return string; 
    }
  else {return this;}  //沒有找到子字串:傳回待剖析字串本身
  }
/*-----------------------------------------------------------------------------
get_attribute(attribute)
功能 : 
  此函數會在待剖析 HTML 字串中搜尋指定之屬性值. 					
參數 :          
  attribute : HTML 元素之屬性, 例如 style, class 等  
-----------------------------------------------------------------------------*/
function get_attribute(attribute) {
  var cleaned_html = this.tidy_html();             //整理 tag 元素
  cleaned_html = cleaned_html.replace("\r", "");   //去除 CR 
  cleaned_html = cleaned_html.replace("\n", "");   //去除 LF  
  var start=attribute.toLowerCase() + "=\"";       //屬性開頭 (全小寫)
  return cleaned_html.return_between(start, "\"", "EXCL");   //回傳屬性值
  }
//=====以下函數來自 VBscript=====//
/*-----------------------------------------------------------------------------
trim()
  此函數會刪除字串開頭與結尾處之空白字元後傳回 (與 VBscript 之 Trim 同).
  空白字元, 包括空格(space),水平定位(tab),跳頁(form-feed)與換列(linefeed),
  相當於 [ \f\n\r\t\v\u00A0\u2028\u2029]
參數 :                                     
  無
-----------------------------------------------------------------------------*/
function trim() {
  return this.replace(/(^\s*)|(\s*$)/g,"");  
  }
/*-----------------------------------------------------------------------------
ltrim()
  此函數會刪除字串開頭處之空白字元後傳回 (與 VBscript 之 Ltrim 同).								
參數 :                                     
  無
-----------------------------------------------------------------------------*/
function ltrim() {
  return this.replace(/(^\s*)/g, "");
  }
/*-----------------------------------------------------------------------------
rtrim()
  此函數會刪除字串結尾處之空白字元後傳回 (與 VBscript 之 Rtrim 同).								
參數 :                                     
  無
-----------------------------------------------------------------------------*/
function rtrim() {
  return this.replace(/(\s*$)/g, "");
  }
//======以下函數來自 Python=====//
//參考 : http://docs.python.org/release/2.5.2/lib/string-methods.html
/*-----------------------------------------------------------------------------
isdigit()
  此函數會判斷字串內容是否全為數字 (與 Python 之 isdigit 同).								
參數 :                                     
  無
-----------------------------------------------------------------------------*/
function isdigit() {
  return str.match(/D/)==null;  
  }
/*-----------------------------------------------------------------------------
startswith(prefix[,start[, end]])
  此函數會判斷字串內容是否以 prefix 開頭 (與 Python 之 startwith 同).
  備選參數 start 與 end 可指定比對之起訖位置, 預設為從頭 (0) 比到尾 (length-1).
參數 :                                     
  無
-----------------------------------------------------------------------------*/
String.prototype.startswith = function (prefix, start, end) { 
  var start=start || 0;          //預設值
  var end=end || this.length-1;  //預設值
  var haystack=this.substring(start,end+1);
  var needle=new RegExp("^" + prefix,"ig");  //是否以 prefix 結尾 (不分大小寫)
  WScript.Echo(haystack);
  return needle.test(haystack);
  }
/*-----------------------------------------------------------------------------
endswith(prefix[,start[, end]])
  此函數會判斷字串內容是否以 prefix 開頭 (與 Python 之 startwith 同).
  備選參數 start 與 end 可指定比對之起訖位置, 預設為從頭 (0) 比到尾 (length-1).
參數 :                                     
  無
-----------------------------------------------------------------------------*/
String.prototype.endswith = function (prefix, start, end) { 
  var start=start || 0;          //預設值
  var end=end || this.length-1;  //預設值
  var haystack=this.substring(start,end+1);
  var needle=new RegExp(prefix + "$","ig");  //是否以 prefix 結尾 (不分大小寫)
  WScript.Echo(haystack);
  return needle.test(haystack);
  }
/*-----------------------------------------------------------------------------
title()
  此函數會將字串 (英文) 中每一個字的第一個字元改成大寫, 其餘字元改為小寫後傳回
  (與 Python 之 title 同).								
參數 :                                     
  無
-----------------------------------------------------------------------------*/
String.prototype.title = function () {
  var words=this.replace(/[ ]{2,}/g," ").split(" ");  //兩個以上連續空格改為1個
  for (var i=0; i<words.length; i++) {
    var first=words[i].charAt(0).toUpperCase();  //每字首字元大寫
    var others=words[i].substr(1).toLowerCase();  //第2字元至最後小寫
    words[i]=first + others;  //重組回字
    }
  return words.join(" ");  //重組回字串傳回
  };
/*-----------------------------------------------------------------------------
swapcase(prefix[,start[, end]])
  此函數會將字串 (英文) 中每一個小寫字元改成大寫, 大寫字元改成小寫後傳回
  (與 Python 之 swapcase 同).								
參數 :                                     
  無
-----------------------------------------------------------------------------*/
String.prototype.swapcase = function () {
  var arr=[];  //暫存字元用
  var lower=/[a-z]/;   //小寫字元
  var upper=/[A-Z]/;  //大寫字元
  for (var i=0; i<this.length; i++) {  //走訪每一個字元
    if (lower.test(this.charAt(i))) {  //小寫字母->改成大寫
      arr.push(this.charAt(i).toUpperCase());
      }
    else if (upper.test(this.charAt(i))) {  //大寫字母->改成小寫
      arr.push(this.charAt(i).toLowerCase());
      }
    else {arr.push(this.charAt(i));} 
    }
  return arr.join(""); //串接全部字元
  };
/*-----------------------------------------------------------------------------
zfill(width)
  此函數會將數字字串前面填滿 0 使得總長為 width 字元 (與 Python 之 isalnum 同).
  若字串長度小於 width, 則無法填 0 而傳回字串本身.
參數 :                                     
  width : 填補之後字串總長度
傳回值 :
  字串
-----------------------------------------------------------------------------*/
function zfill(width) {
  var zeros="";  //補0字串初始值
  if (width < this.length) {return this;} //width小於字串長度:不用補,傳回本身
  else {  //需要補滿 0
     for (var i=0; i<width-this.length; i++) {zeros += "0";}  //製作補0字串
     return zeros + this;  //前面冠上補0字串
     }
  }
/*-----------------------------------------------------------------------------
ljust(width[, fillchar])
  此函數會在字串前面以 fillchar 字元填滿使得總長為 width 字元 (與 Python 之 
  ljust 同). 若字串長度小於 width, 則無法填滿而傳回字串本身. fillchar 預設為
  空格 space=" ".
參數 :                                     
  width    : 填補之後字串總長度
  fillchar : 填補字元
傳回值 :
  字串
-----------------------------------------------------------------------------*/
function ljust(width, fillchar) {
  var fillchar=fillchar || " ";  //填補字元預設值為 " "
  var filler="";                 //填補字串初始值
  if (width < this.length) {return this;} //width小於字串長度:不用補,傳回本身
  else {  //需要補滿
     for (var i=0; i<width-this.length; i++) {filler += fillchar;}  //製作填補字串
     return filler + this;  //前面冠上填補字串
     }  
  }
/*-----------------------------------------------------------------------------
rjust(width[, fillchar])
  此函數會在字串後面以 fillchar 字元填滿使得總長為 width 字元 (與 Python 之 
  ljust 同). 若字串長度小於 width, 則無法填滿而傳回字串本身. fillchar 預設為
  空格 space=" ".
參數 :                                     
  width    : 填補之後字串總長度
  fillchar : 填補字元
傳回值 :
  字串
-----------------------------------------------------------------------------*/
function rjust(width, fillchar) {
  var fillchar=fillchar || " ";  //填補字元預設值為 " "
  var filler="";                 //填補字串初始值
  if (width < this.length) {return this;} //width小於字串長度:不用補,傳回本身
  else {  //需要補滿
     for (var i=0; i<width-this.length; i++) {filler += fillchar;}  //製作填補字串
     return this + filler;  //後面冠上填補字串
     }
  }
/*-----------------------------------------------------------------------------
encode(key)
  此函數會依據傳入之 key 對字串進行特定編碼. 其相對之解碼函式為 decode(), 必須
  傳入相同 key 才會解出原始字串. 
參數 :                                     
  key : 編碼所用之鍵字串.
傳回值 : 
  由 key 字串中之字元編碼所組成之加密字串
源碼 : http://www.360doc.com/content/13/0806/13/1073512_305112816.shtml 
-----------------------------------------------------------------------------*/
function encode(key) {
  if (!key) { 
    var key="8ABC7DLO5MN6Z9EFGdeJfghijkHIVrstuvwWSTUXYabclmnopqKPQRxyz01234";
    } 
  var nl=this.length;
  var t=[];
  var a,b,c,x,m=function(y){t[t.length]=key.charAt(y)};
  var N=key.length;
  var N2=N*N,N5=N*5;
  for (x=0;x<nl;x++) {
    a=this.charCodeAt(x);
    if (a<N5) m(Math.floor(a/N)),m(a%N);
    else m(Math.floor(a/N2)+5),m(Math.floor(a/N)%N),m(a%N);
    }
  var s=t.join("");
  return String(s.length).length+String(s.length)+s;  
  };
/*-----------------------------------------------------------------------------
decode(key)
  此函數會依據傳入之 key 對字串進行特定解碼. 其相對之編碼函式為 encode(), 必須
  傳入編碼所用之相同 key 才會解出原始字串. 
參數 :                                     
  key : 解碼所用之鍵字串.
傳回值 : 
  由 key 字串中之字元解碼所組成之還原字串
源碼 : http://www.360doc.com/content/13/0806/13/1073512_305112816.shtml
-----------------------------------------------------------------------------*/
function decode(key) {
  if (!key) { 
    var key="8ABC7DLO5MN6Z9EFGdeJfghijkHIVrstuvwWSTUXYabclmnopqKPQRxyz01234";
    } 
  var c=this.charAt(0)*1;
  if (isNaN(c)) return "";
  c=this.substr(1,c)*1;
  if (isNaN(c)) return "";
  var nl=this.length;
  var t=[];
  var a,f,b,x=String(c).length+1;
  var enc=this; 
  var m=function(y){return key.indexOf(enc.charAt(y))};
  var N=key.length;
  if (nl!=x+c) return "";
  while (x<nl) {
    a=m(x++)
    if (a<5)f=a*N+m(x);
    else f=(a-5)*N*N+m(x)*N+m(x+=1);
    t[t.length]=String.fromCharCode(f);
    x++;
    }
  return t.join("");  
  };