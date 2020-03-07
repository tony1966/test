<?php
/*-----------------------------------------------------------------------------
Title        : PHP File API
Author       : Tony
Version      : v1.0.0
Prototype    : 2013/03/28
Last Updated : 2013/03/30
Usage        : Manipulate Files
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
read_file($filename)
功能 : 
  此函數用來讀取文字檔, 結果以字串傳回.				
參數 :                                   
  $filename : 文字檔檔名 (相對路徑, 例如 log/visitors.txt)   
傳回值 :
  成功傳回檔案內容, 失敗傳回 FALSE.
範例 : 
  $result=read_file("./download/test.txt");    
-----------------------------------------------------------------------------*/
function read_file($filename) {
  $result=file_get_contents(realpath($filename));
  return $result;
  }
/*-----------------------------------------------------------------------------
read_lines($filename)
功能 : 
  此函數以行為單位讀取外部文字檔, 去除跳行字元後存入陣列中傳回.				
參數 :                                   
  $filename : 文字檔檔名 (相對路徑, 例如 log/visitors.txt))   
傳回值 :
  陣列
範例 : 
  $result=read_lines("test.log");
  for ($i=0; $i<count($result); $i++) {
       echo "line ".$i.":".$result[$i];
       }
  foreach ($result as $k => $v) {
       echo "line ".$k[$i].":".$v;
       }
-----------------------------------------------------------------------------*/
function read_lines($filename) {
  $result=file(realpath($filename));
  return $result;  
  }
/*-----------------------------------------------------------------------------
read_binary($filename)
功能 : 
  此函數用來讀取二進位檔 (例如圖檔), 結果以字串傳回.				
參數 :                                   
  $filename : 二進位檔檔名 (相對路徑, 例如 log/visitors.txt))  
傳回值 :
  成功傳回二進位檔內容, 失敗傳回 FALSE.
範例 : 
  $result=read_binary("test.gif"); 
  echo $result; //顯示圖檔
-----------------------------------------------------------------------------*/
function read_binary($filename) {
  $pointer=fopen($filename, "rb");  //Windows 主機一定要加 b 才可以
  $result=fread($pointer, filesize($filename)); 
  fclose($pointer); //關閉
  return $result;
  }
/*-----------------------------------------------------------------------------
write_file($filename,$text)
功能 : 
  此函數以鎖定取代模式將文字寫入外部文字檔 (取代原內容).
參數 :                                   
  $filename : 文字檔檔名 (相對路徑, 例如 log/visitors.txt))
  $text     : 檔案內容   
傳回值 :
  成功傳回寫入之 bytes 數, 失敗傳回 FALSE.
  注意, 傳回 0 byte 亦被認為 FALSE, 故判斷時要用 if ($result===FALSE).
範例 : 
  $result=write_file("./log/daily.log", "This is a book");    
-----------------------------------------------------------------------------*/  
function write_file($filename,$text) {
  $result=file_put_contents(realpath($filename), $text, LOCK_EX); //鎖定&取代
  return $result; 
  }
/*-----------------------------------------------------------------------------
append_file($filename,$text)
功能 : 
  此函數以鎖定添加模式將文字寫入外部文字檔 (串在原內容尾端).
參數 :                                   
  $filename : 文字檔檔名 (相對路徑, 例如 log/visitors.txt))
  $text     : 檔案內容   
傳回值 :
  成功傳回寫入之 bytes 數, 失敗傳回 FALSE.
  注意, 傳回 0 byte 亦被認為 FALSE, 故判斷時要用 if ($result===FALSE).
範例 : 
  $result=write_file("./log/daily.log", "This is a book");    
-----------------------------------------------------------------------------*/  
function append_file($filename,$text) {
  $result=file_put_contents(realpath($filename), $text, FILE_APPEND|LOCK_EX); 
  return $result; 
  }
/*-----------------------------------------------------------------------------
upload_file($uploader,$path="./")
功能 : 
  此函數將上傳之單一檔案, 由暫存區移至指定路徑下.
參數 :                                   
  $uploader : 上傳元件名稱, 即 <input type="file" name="uploader"> 中之 name 值
  $path     : 檔案儲存路徑, 例如 "./images"   
傳回值 :
  成功傳回陣列, 失敗傳回 FALSE. 陣列有三個元素 :
  $result["name"]=檔案名稱
  $result["type"]=檔案類型
  $result["size"]=檔案大小
範例 : 
  <input type="file" name="uploader">
  $result=upload_file("uploader", "./images"); 
  echo "檔案 ".$result["name"]." 上傳成功 (".$result["size"]." bytes)";
-----------------------------------------------------------------------------*/  
function upload_file($uploader,$path="./") {
  if ($_FILES[$uploader]["error"]==0) { //上傳成功
      $tmp_name=$_FILES[$uploader]["tmp_name"];
      $new_name=$path.$_FILES[$uploader]["name"];
      if (move_upload_file($tmp_name, $new_name)) { //移動成功
          $result["name"]=$_FILES[$uploader]["name"];
          $result["type"]=$_FILES[$uploader]["type"];
          $result["size"]=$_FILES[$uploader]["size"];
          } //end of if
      else {$result=FALSE;} //移動失敗
      } //end of if
  else {$result=FALSE;} //上傳失敗
  return $result; 
  }
/*-----------------------------------------------------------------------------
upload_files($uploader,$path="./")
功能 : 
  此函數將上傳之多個檔案, 由暫存區移至指定路徑下.
參數 :                                   
  $uploader : 上傳元件名稱, 乃陣列形式, 例如下列 input 中之 name 值
              檔案1 : <input type="file" name="uploader[]"> 
              檔案2 : <input type="file" name="uploader[]"> 
              上傳表單之 enctype 須設為 multipart/form-data :
              <form action="upload.php" method="post" 
              enctype="multipart/form-data">
  $path     : 檔案儲存路徑, 例如 "./images" (預設值為目前程式所在目錄 ./)
傳回值 :
  成功傳回一個二維陣列, 失敗傳回 FALSE. 陣列第一維為數字索引, 第二維為關聯式,
  有三個元素 : 例如第一個上傳檔案 :
  $result[0]["name"]=檔案名稱
  $result[0]["type"]=檔案類型
  $result[0]["size"]=檔案大小
範例 : 
  <input type="file" name="uploader[]">
  $result=upload_files("uploader", "./images"); 
  for ($i=0; $i<count($result); $i++) {
       echo $result[$i]["name"]."上傳成功(".$result[$i]["size"]." bytes)<br>";
       }
-----------------------------------------------------------------------------*/  
function upload_files($uploader,$path="./") {
  $counts=count($_FILES[$uploader]["name"]); //上傳檔案數
  for ($i=0; $i<$counts; $i++) { 
       if ($_FILES[$uploader]["error"][$i]==0) { //上傳成功
           $tmp_name=$_FILES[$uploader]["tmp_name"][$i];
           $new_name=$path.$_FILES[$uploader]["name"][$i];
           if (move_upload_file($tmp_name, $new_name)) { //移動成功
               $result[$i]["name"]=$_FILES[$uploader]["name"][$i];
               $result[$i]["type"]=$_FILES[$uploader]["type"][$i];
               $result[$i]["size"]=$_FILES[$uploader]["size"][$i];
               } //end of if
           else {$result=FALSE;} //移動失敗
           } //end of if
       else {$result=FALSE;} //上傳失敗
       } //end of for
  return $result; 
  }
/*-----------------------------------------------------------------------------
get_filelist($path)
功能 : 
  此函數指定路徑下之檔案與目錄列表.
參數 :  
  $path : 檔案儲存路徑, 例如 "./images", "sys/log"   
傳回值 :
  成功傳回陣列, 失敗傳回 FALSE. 陣列有兩個個元素 :
  $result["file"]=檔案列表
  $result["dir"]=目錄列表
範例 :
  $result=get_filelist("./images"); 
  echo "檔案列表".$result["file"]." 上傳成功 (".$result["size"]." bytes)";
-----------------------------------------------------------------------------*/  
function get_filelist($path) {
  $realpath=realpath($path);
  $resource=scandir($realpath);
  foreach ($resource as $filename) {
    if (is_dir($realpath."\\".$filename)) {$dir[]=$filename;}
    if (is_file($realpath."\\".$filename)) {$file[]=$filename;}
    }
  $result["dir"]=join(",",$dir);
  $result["file"]=join(",",$file);
  return $result; 
  }
?>