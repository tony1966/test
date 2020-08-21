/*-----------------------------------------------------------------------------
include(filename)
功能 : 
  此函數用來匯入其他外部 Javascript 檔.	僅限於 Client 端之 WSH 應用中.			
參數 :                                   
  filename  : 外部 Javascript 檔名 (字串)   
傳回值 :
  無/null
範例 : 
  include("parse.js");    
-----------------------------------------------------------------------------*/
function include(filename) {
  try {
       var FSO=new ActiveXObject("Scripting.FileSystemObject");
       var TXO=FSO.openTextFile(filename,1);
       var fileData=TXO.readAll();
       eval(fileData);  //執行 JS 檔內容
       TXO.Close();
       TXO=null;
       FSO=null;
      }
  catch (e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
read_file(filename)
功能 : 
  此函數用來讀取外部文字檔, 結果以字串傳回.				
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
傳回值 :
  成功傳回檔案內容字串, 失敗傳回原因字串
範例 : 
  var fileData=read_file("test.log");    
-----------------------------------------------------------------------------*/
function read_file(filename) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      var TXO=FSO.openTextFile(filename,1,false);
      var fileData=TXO.readAll();
      TXO.Close();
      TXO=null;
      FSO=null;
      return fileData;
      }
  catch (e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
read_lines(filename)
功能 : 
  此函數用來讀取外部文字檔, 並以分行符號拆分每列後儲存在陣列中傳回.						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
傳回值 :
  成功傳回陣列, 失敗傳回原因
範例 : 
  var array_lines=read_lines("test.log");    
-----------------------------------------------------------------------------*/
function read_lines(filename) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      var TXO=FSO.openTextFile(filename,1,false);
      var array_lines=new Array();
      while (!TXO.atEndOfStream) {
            array_lines.push(TXO.ReadLine());  //讀取每行放入陣列中
            }
      TXO.Close();
      TXO=null;
      FSO=null;
      return array_lines;
      }
  catch (e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
write_file(filename,text)
功能 : 
  此函數用來將純文字寫入外部文字檔 (覆蓋或新建).						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
  text      : 檔案內容   
傳回值 :
  成功傳回 1, 失敗傳回原因
範例 : 
  var result=write_file("test.log", "This is a book");    
-----------------------------------------------------------------------------*/  
function write_file(filename,text) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      var TXO=FSO.openTextFile(filename,2,true); //2=寫入,true=新建
      TXO.Write(text); //寫入檔案
      TXO.Close();
      FSO=null;
      return 1;
      }
  catch(e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
append(filename,text)
功能 : 
  此函數用來將純文字寫入外部文字檔後面(不存在就新建).						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
  text      : 檔案內容   
傳回值 :
  成功傳回 1, 失敗傳回原因字串
範例 : 
  var result=append("test.log", "This is a book");    
-----------------------------------------------------------------------------*/  
function append(filename,text) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      var TXO=FSO.openTextFile(filename,8,true); //8=附加,true=新建
      TXO.Write(text); //寫入檔案
      TXO.Close();
      FSO=null;
      return 1;    
      }
  catch(e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
prepend(filename,text)
功能 : 
  此函數用來將純文字寫入外部文字檔前面(不存在就新建).						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
  text      : 檔案內容   
傳回值 :
  成功傳回 1, 失敗傳回原因字串
範例 : 
  var result=prepend("test.log", "This is a book");    
-----------------------------------------------------------------------------*/  
function prepend(filename,text) {
  var new_text=text + read_file(filename);  //串接
  return write_file(filename,new_text); 
  }
/*-----------------------------------------------------------------------------
remove_lines(filename,lines_array)
功能 : 
  此函數用來移除文字檔指定之行.						
參數 :                                   
  filename     : 文字檔檔名 (含路徑)   
  lines_array  : 要移除之行數陣列 (0 起算)  
傳回值 :
  成功傳回 1, 失敗傳回原因字串
範例 : 
  var result=remove_lines("test.log", [0]);    
  var result=remove_lines("test.log", [2,4,6]);    
-----------------------------------------------------------------------------*/  
function remove_lines(filename,lines_array) {
  var lines_array=lines_array.sort();  //行號排序,以便取出要刪的最後一行行數
  var text=read_lines(filename);  //讀取檔案成陣列
  var break_point=lines_array[lines_array.length-1] + 1;  //斷點
  var pre=text.slice(0, break_point); //前半部 (要處理刪除作業)
  //剩下的後半部陣列不須處理刪除作業
  var left=text.slice(break_point); //選取斷點至陣列尾
  var tmp=new Array();
  var line_str=lines_array.join();  //把欲刪除行號組成字串
  for (var i=0; i < pre.length; i++) {  //沒在刪除名單的放入 tmp 陣列
      if (line_str.indexOf(i.toString()) == -1 ) {tmp.push(pre[i]);} //不刪除
      else {continue;}  //有在刪除名單的不存入 tmp : 刪除
      }
  tmp=tmp.concat(left);  //串接刪除後的前半部與後半部串接
  return write_file(filename,tmp.join("\r\n")); 
  }
/*-----------------------------------------------------------------------------
remove_prelines(filename,numbers)
功能 : 
  此函數用來移除文字檔最前面指定之行數.						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
  numbers   : 移除之行數   
傳回值 :
  成功傳回 1, 失敗傳回原因字串
範例 : 
  var result=remove_prelines("test.log", 2);    
-----------------------------------------------------------------------------*/  
function remove_prelines(filename,numbers) {
  var lines=read_lines(filename);  //
  for (var i=0; i < numbers; i++) {lines.shift();}
  return write_file(filename,lines.join("\r\n")); 
  }
/*-----------------------------------------------------------------------------
remove_lastlines(filename,numbers)
功能 : 
  此函數用來移除文字檔最後面指定之行數.						
參數 :                                   
  filename  : 文字檔檔名 (含路徑)   
  numbers   : 移除之行數   
傳回值 :
  成功傳回 1, 失敗傳回原因字串
範例 : 
  var result=remove_lastlines("test.log", 2);    
-----------------------------------------------------------------------------*/  
function remove_lastlines(filename,numbers) {
  var lines=read_lines(filename);  //讀進檔案為陣列
  lines.reverse();  //陣列倒序
  for (var i=0; i < numbers; i++) {lines.shift();}  //刪除前面幾列
  lines.reverse();  //陣列倒序回去
  return write_file(filename,lines.join("\r\n")); 
  }
/*-----------------------------------------------------------------------------
get_files(folder)
功能 : 
  此函數用來取得指定目錄下的檔案列表, 以陣列傳回.						
參數 :                                   
  folder  : 檔案路徑 (注意, 目錄需用兩個倒斜線分隔) 
傳回值 :
  陣列或失敗原因
範例 : 
  var files=get_files("my_doc");    
  var files=get_files("c:\\test\\my_doc");    
-----------------------------------------------------------------------------*/  
function get_files(folder) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      var folderObj=FSO.GetFolder(folder); 
      var enumObj=new Enumerator(folderObj.Files); 
      var filesArray=new Array();
      for (;!enumObj.atEnd();enumObj.moveNext()) {      
          filesArray.push(enumObj.item().Name);
          }
      folderObj=null;
      enumObj=null;
      FSO=null;
      return filesArray;   
      }
  catch(e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
file_exist(file_name)
功能 : 
  此函數用來檢查檔案是否存在.						
參數 :                                   
  file_name : 檔案名稱與路徑 (注意, 目錄需用兩個倒斜線分隔) 
傳回值 :
  成功傳回 1, 失敗傳回原因
範例 :    
  var result=file_exist("c:\\test\\my_doc.txt");    
-----------------------------------------------------------------------------*/  
function file_exist(file_name) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      if (FSO.FileExists(file_name)) {return 1;}
      else {return 0;}
      FSO=null;    
      }
  catch(e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
delete_file(file_name)
功能 : 
  此函數用來刪除檔案.						
參數 :                                   
  file_name : 檔案名稱與路徑 (注意, 目錄需用兩個倒斜線分隔) 
傳回值 :
  成功傳回 1, 失敗傳回原因
範例 :    
  var result=delete_file("c:\\test\\my_doc.txt");    
-----------------------------------------------------------------------------*/  
function delete_file(file_name) {
  try {
      var FSO=new ActiveXObject("Scripting.FileSystemObject");
      if (FSO.FileExists(file_name)) {FSO.DeleteFile(file_name);}
      FSO=null;
      return 1;
      }
  catch(e) {return e.description;}
  }
/*-----------------------------------------------------------------------------
get_folder()
功能 : 
  此函數會傳回網頁檔所在本機路徑, 例如 D:\\project\\pitch\\								
參數 :  
  無
傳回值 : 字串 (雙倒斜線格式 D:\\project\\pitch\\)
-----------------------------------------------------------------------------*/
function get_folder() { //傳回目前網頁所在之目錄字串
  //取得目前網頁所在目錄,例如 /D:\project\pitch\pitch.htm
  var browser=window.navigator.appName;
  var b_version=window.navigator.appVersion;
  var version=b_version.split(";"); 
  var trim_Version=version[1].replace(/[ ]/g,""); 
  //取得目前網頁所在目錄,/D:/project/pitch/pitch.htm
  var sys_path=unescape(window.location.pathname);
  //去除檔名,從右邊開始找第一個右斜線 / 索引
  var pos=sys_path.lastIndexOf("\/"); 
  //須去除第一個右斜線,故從 1 開始直到右側第一個右斜線(含)
  var path=sys_path.substring(1,pos+1); 
  //工作目錄路徑演算結果例如 path=D:/project/pitch/
  //製作 FSO 物件運作所需之系統路徑字串 (由單一倒斜線轉成兩個倒斜線)
  var path_arr=path.split("\/"); //先拆成陣列
  var folder=path_arr.join("\\\\"); //再組合為字串 D:\\project\\pitch\\		
  return folder;
  }