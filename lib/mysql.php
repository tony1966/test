<?php
/*-----------------------------------------------------------------------------
Title        : PHP MySQL API
Translator   : Tony
Version      : v1.0.0
Prototype    : 2013/03/23
Last Updated : 2013/03/30
Usage        : Manipulate MySQL database
Note         : This software is translated from Michael Schrenk's work.
               It is only for private use.
               Original : http://www.webbotsspidersscreenscrapers.com/
-----------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------
功能 : 設定錯誤訊息顯示常數, 並檢查設定檔中的常數是否已全部設定  
-----------------------------------------------------------------------------*/
define('SHOW_ERROR',FALSE); //顯示 (TRUE) 或抑制 (FALSE) 錯誤訊息, 測試時打開
if (strlen(MYSQL_ADDRESS) + 
    strlen(MYSQL_USERNAME) + 
    strlen(MYSQL_PASSWORD) + 
    strlen(MYSQL_ADDRESS) + 
    strlen(DATABASE) == 0) {
    die ("錯誤 : 尚未設定 dbsettings.php 檔案中的 MySQL 資料庫常數.<br>\n");
    }
/*-----------------------------------------------------------------------------
get_connection($address=MYSQL_ADDRESS, $username=MYSQL_USERNAME, 
               $password=MYSQL_PASSWORD)
功能 : 
  此函數根據傳入之 MySQL 伺服器位址, 帳號, 密碼建立資料庫連線並傳回連線識別字.		
參數 :                                   
  $address  : MySQL 伺服器位址 (預設值為常數 MYSQL_ADDRESS, 本機設為 localhost)
  $username : MySQL 使用者名稱 (預設值為常數 MYSQL_USERNAME)
  $password : MySQL 使用者密碼 (預設值為常數 MYSQL_PASSWORD)
傳回值 :
  連線識別字或 FALSE (連線失敗)
範例 : 
  $conn=get_connection();    
  $conn=get_connection("localhost","root","mysql"); //CREATE DATABASE 須 root
-----------------------------------------------------------------------------*/
function get_connection($address=MYSQL_ADDRESS, $username=MYSQL_USERNAME, 
                        $password=MYSQL_PASSWORD) {
  @$conn=mysql_connect($address, $username, $password); //抑制錯誤顯示
  //設定查詢所用之字元集為 utf-8
  if ($conn) {mysql_query("SET NAMES 'utf8'");}
  else {
      if (SHOW_ERROR) {
          echo "無法建立 MySQL 資料庫連線, 請檢查 dbsettings.php 設定!<br>";
          }
      } //end of else
  return $conn;
  }
/*-----------------------------------------------------------------------------
create_database($database, $address=MYSQL_ADDRESS, $username=MYSQL_USERNAME,
                $password=MYSQL_PASSWORD)
功能 : 
  建立空白資料庫 (注意, 建立資料庫須管理者帳號與密碼)			
參數 :                                   
  $database : 資料庫名稱 (字串)   
  $address  : MySQL 伺服器位址 (預設值為常數 MYSQL_ADDRESS, 本機設為 localhost)
  $username : MySQL 使用者名稱 (預設值為常數 MYSQL_USERNAME)
  $password : MySQL 使用者密碼 (預設值為常數 MYSQL_PASSWORD)
傳回值 :
  TRUE (成功) 或 FALSE (失敗)
範例 : 
  $result=create_database("stocks");    
-----------------------------------------------------------------------------*/
function create_database($database, $address=MYSQL_ADDRESS, 
                         $username=MYSQL_USERNAME, $password=MYSQL_PASSWORD) {
  $conn=get_connection($address,$username,$password); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $SQL="CREATE DATABASE IF NOT EXISTS ".$database." DEFAULT CHARSET=utf8 ".
       "DEFAULT COLLATE=utf8_unicode_ci";
  $result=mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL CREATE DATABASE Error : ".mysql_error($conn)."<br>";
          }
     }
  return $result;
  }
/*-----------------------------------------------------------------------------
drop_database($database, $address=MYSQL_ADDRESS, $username=MYSQL_USERNAME, 
              $password=MYSQL_PASSWORD)
功能 : 
  刪除資料庫 (注意, 刪除資料庫須管理者帳號與密碼)
參數 :                                   
  $database : 資料庫名稱 (字串)   
  $address  : MySQL 伺服器位址 (預設值為常數 MYSQL_ADDRESS, 本機設為 localhost)
  $username : MySQL 使用者名稱 (預設值為常數 MYSQL_USERNAME)
  $password : MySQL 使用者密碼 (預設值為常數 MYSQL_PASSWORD)   
傳回值 :
  TRUE (成功) 或失敗原因
範例 : 
  $result=drop_database("stocks");    
-----------------------------------------------------------------------------*/
function drop_database($database, $address=MYSQL_ADDRESS, 
                       $username=MYSQL_USERNAME, $password=MYSQL_PASSWORD) {
  $conn=get_connection($address,$username,$password); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $SQL="DROP DATABASE IF EXISTS ".$database;
  $result=mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL DROP DATABASE Error : ".mysql_error($conn)."<br>";
          }
     }
  return $result;
  }
/*-----------------------------------------------------------------------------
insert($table, $data_array, $database=DATABASE)
功能 : 
  此函數將傳入之資料陣列插入指定資料表中.			
參數 :                                   
  $table      : 資料表名稱 (字串)  
  $data_array : 資料陣列 (關聯式陣列, 例如 : $arr["user"]="tony")
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  TRUE (成功) 或失敗原因字串
範例 : 
  $data_array["user"]="tony";
  $data_array["age"]=18;
  $result=insert("users", $data_array); //預設資料庫
  $result=insert("users", $data_array, "stocks");  //指定資料庫
-----------------------------------------------------------------------------*/
function insert($table, $data_array, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  foreach ($data_array as $key => $value) { //產生欄位名稱與值陣列
           $tmp_col[] = $key;
           $tmp_dat[] = "'$value'";
          }
  $columns=join(",", $tmp_col); //轉成字串
  $data=join(",", $tmp_dat); //轉成字串 
  $SQL="INSERT INTO ".$table."(".$columns.")VALUES(". $data.")";
  $result=mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL INSERT Error : ".mysql_error($conn)."<br>";
          }
     }
  return $result;
  }
/*-----------------------------------------------------------------------------
update($table, $data_array, $f, $v, $database=DATABASE)
功能 : 
  此函數將傳入之資料陣列更新指定欄位值之紀錄.
參數 :                                   
  $table      : 資料表名稱 (字串)  
  $data_array : 資料陣列 (關聯式陣列, 例如 : $arr["user"]="tony")
  $f          : 欄位名稱
  $v          : 欄位之值
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  TRUE (成功) 或失敗原因字串
範例 : 
  $data_array["user"]="tony";
  $data_array["age"]=18;
  $result=update("users", $data_array);
  $result=update("users", $data_array, "stocks");  //指定資料庫
-----------------------------------------------------------------------------*/
function update($table, $data_array, $f, $v, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $setting_list=""; //資料更新字串
  for ($i=0; $i<count($data_array); $i++) {
       list($key,$value)=each($data_array);
       $setting_list.= $key."="."\"".$value."\"";
       if ($i!=count($data_array)-1) {$setting_list .= ",";}
      }
  $SQL="UPDATE ".$table." SET ".$setting_list." WHERE ". 
       $f." = " . "\"" . $v . "\"";
  $result = mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL UPDATE Error : ".mysql_error($conn)."<br>";
          }
     }
  return $result;
  }
/*-----------------------------------------------------------------------------
update_all($table, $data_array, $database=DATABASE)
功能 : 
  此函數將傳入之資料陣列更新該資料表全部記錄之指定欄位之值.
參數 :                                   
  $table      : 資料表名稱 (字串)  
  $data_array : 資料陣列 (關聯式陣列, 例如 : $arr["user"]="tony")
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  TRUE (成功) 或 FALSE, 失敗原因字串
範例 : 
$data_array["status"]="X";  
update_all("stocks_list", $data_array);  //將 status 欄位全部設為 "X"
-----------------------------------------------------------------------------*/
function update_all($table, $data_array, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $setting_list=""; //資料更新字串
  for ($i=0; $i<count($data_array); $i++) {
       list($key,$value)=each($data_array);
       $setting_list.= $key."="."\"".$value."\"";
       if ($i!=count($data_array)-1) {$setting_list .= ",";}
      }
  $SQL="UPDATE ".$table." SET ".$setting_list;
  $result=mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL UPDATE Error : ".mysql_error($conn)."<br>";
          }
     }
  return $result;
  }
/*-----------------------------------------------------------------------------
search($table, $f="", $v="", $database=DATABASE)
功能 : 
  執行資料庫搜尋操作 (SELECT ...)
參數 :                                   
  $table      : 資料表名稱 (字串) 
  $f          : 欄位名稱 (預設值為空字串, 表示搜尋全部紀錄)
  $v          : 欄位之值 (預設值為空字串, 表示搜尋全部紀錄)
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回搜尋結果紀錄之 2 維關聯式陣列, 失敗傳回 FALSE.
  一筆紀錄 : 只有 $RS[0] : $RS[0]["name"], $RS[0]["age"], ...
  多筆紀錄 : 有 $RS[0], $RS[1], ...
  不論幾筆紀錄, 都用 for 迴圈讀取二維關聯式陣列.
範例 : 
  $RS=search("users"); //多筆紀錄
  $RS=search("users", "id", "tony"); //單筆紀錄 (字串)
  $RS=search("users", "login_count", "2"); //單筆紀錄 (數值用 "2" 或 2 均可)
  for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
       echo $RS[$i]["name"].",".$RS[$i]["age"];
      }  
-----------------------------------------------------------------------------*/
function search($table, $f="", $v="", $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  if ($f=="") {$SQL="SELECT * FROM ".$table;}  //全部紀錄
  else { //有設條件 : 單筆紀錄
        $SQL="SELECT * FROM ".$table." WHERE ".$f."="."\"".$v."\"";
       } //end of else
  //echo $SQL."<br>";
  $result=mysql_query($SQL, $conn); //執行 SQL 指令, 傳回資源識別字
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL SELECT Error : ".mysql_error($conn)."<br>";
	  }
      return $result; //失敗傳回 FALSE
     } //end of if
  else { //從紀錄集資源識別字擷取紀錄為紀錄集陣列
     for ($i=0; $i<mysql_numrows($result); $i++) {
          $RS[$i]=mysql_fetch_array($result);
         } //end of for
     //若紀錄集陣列為一列 (單筆記錄), 則回傳單列紀錄 (即第一列索引 0)
     //if (sizeof($RS)==1) {$RS=$RS[0];}       
     return $RS; //傳回紀錄集陣列
     } //end of else
  }
/*-----------------------------------------------------------------------------
run_sql($SQL, $database=DATABASE)
功能 : 
  執行指定之 SQL 操作 (SELECT, INSERT, UPDATE, DELETE, ...)
參數 :
  SQL         : SQL 指令                                   
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  SELECT 操作成功傳回紀錄集關聯陣列, 其他操作成功傳回 TRUE, 失敗傳回 FALSE
範例 : 
  $result=run_sql("DELETE FROM users WHERE id='peter'"); //注意, DELETE 無 * 
  $SQL="UPDATE users SET login_count=5,name='彼得' WHERE id='peter'";
  $SQL="INSERT INTO users(id,name) VALUES('peter','彼得')";
  $result=run_sql($SQL);
  $RS=run_sql("SELECT * FROM tabs ORDER BY tab_order); //多筆紀錄
  for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
       echo $RS[$i]["tab_name"].",".$RS[$i]["age"];
      }
-----------------------------------------------------------------------------*/
function run_sql($SQL, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE   
  $result=mysql_query($SQL, $conn); //執行 SQL 指令
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL SELECT Error : ".mysql_error($conn)."<br>";
	  }
      return $result; //失敗傳回 FALSE
      } //end of if
  else { //判別是否為 SELECT 指令
     if (substr_count($SQL, "SELECT")==1) { //SELECT 指令
        //從紀錄集資源識別字擷取紀錄為紀錄集陣列
        for ($i=0; $i<mysql_numrows($result); $i++) {
             $RS[$i]=mysql_fetch_array($result);
            } //end of for
        //若紀錄集陣列為一列 (單筆記錄), 則回傳單列紀錄 (即第一列索引 0)
        //if (sizeof($RS)==1) {$RS=$RS[0];}       
        return $RS; //傳回紀錄集陣列
        } //end of else
     else {return $result;} //傳回 TRUE
     } //end of else
  }
/*-----------------------------------------------------------------------------
find_table($table, $database=DATABASE)
功能 : 
  查詢資料表是否已存在, 是傳回 TRUE, 否傳回 FALSE.			
參數 :                                   
  $table      : 資料表名稱 (字串) 
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  有找到傳回 TRUE, 沒找到傳回 FALSE.
範例 : 
  $result=find_table("users");    
-----------------------------------------------------------------------------*/
function find_table($table, $database=DATABASE) { 
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="SHOW TABLES;";
  $result=mysql_query($SQL, $conn); //顯示資料表
  while ($data=mysql_fetch_row($result)) {
	 if ($data[0]==$table) { 
	     mysql_free_result($result);
	     mysql_close($conn);
	     return TRUE;
	    } //end of if
	} //end of while
  mysql_free_result($result);
  mysql_close($conn);
  return FALSE;
  } 
/*-----------------------------------------------------------------------------
create_table($table, $field_array, $database=DATABASE)
功能 : 
  此函數根據傳入之名稱建立資料表.			
參數 :                                   
  $table       : 資料表名稱 (字串) 
  $field_array : 關聯式資料欄位陣列, key=欄位名稱為, value=欄位型態屬性 
                可用型態如下  :
                 VARCHAR(20)   : 可變長度字元 255 bytes (文字)
                 CHAR(4)       : 固定長度字元 255 bytes (文字)
            	 TINYTEXT      : 255 Bytes (文字)
                 TEXT          : 65535 bytes (文字)
                 MEDIUMTEXT    : 16777215 bytes (文字)
                 LONGTEXT      : 4294967295 bytes (文字)
                 TINYBLOB      : 255 bytes (文字)
                 BLOB          : 65535 bytes (文字,分大小寫)
                 MEDIUMBLOB    : 16777215 bytes (文字,分大小寫)
                 LONGBLOB      : 4294967295 bytes (文字,分大小寫)
                 TINYINT(M)    : 1 bytes (最大顯示寬度 M<=255)
                 SMALLINT(M)   : 2 bytes (最大顯示寬度 M<=255)
                 MEDIUMINT(M)  : 3 bytes (最大顯示寬度 M<=255)
                 INT,INTEGER(M): 4 bytes (最大顯示寬度 M<=255)
                 BIGINT(M)     : 8 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
                 FLOAT(M,D)    : 4 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
                 DOUBLE(M,D)   : 8 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
                 DECIMAL(M,D)  : ? bytes (總位數 M<=65, 小數位數 D<=30&M-2)
                 DATE          : 3 bytes (YY-MM-DD)
                 DATETIME      : 8 bytes (YY-MM-DD HH:MM::SS)
                 TIMESTAMP     : 4 bytes (1970-01-01 00:00:00)
                 TIME          : 3 bytes (HH:MM:SS)
                 YEAR(2|4)     : 1 byte (預設 4)
		 ENUM          : 1~2 bytes (儲存單選 radio)
                 SET           : 1~8 bytes (儲存多選 checkbox)
                可用屬性如下  : 
                 SIGNED,UNSIGNED : 是否有負值 (數值)
                 AUTO_INCREMENT  : 自動增量編號 (數值)
                 BINARY          : 字元有大小寫之分 (文字)
                 NULL,NOT NULL   : 是否允許不填入資料 (全部)
                 DEFAULT         : 預設值
                 PRIMARY KEY     : 資料表之唯一主鍵
  $database    : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回 TRUE, 失敗傳回 FALSE
範例 : 
  $field_array["id"]="VARCHAR(20)";
  $field_array["name"]="VARCHAR(255)";
  $field_array["login_counts"]="INT(2)";
  $field_array["serial_no"]="INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT".
                            " PRIMARY KEY";
  $result=create_table("users",$field_array);    
-----------------------------------------------------------------------------*/
function create_table($table, $field_array, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $fields_str=""; //欄位字串
  for ($i=0; $i<count($field_array); $i++) {
       list($key,$value)=each($field_array);
       $fields_str.="`".$key."` ".$value;
       if ($i!=count($field_array)-1) {$fields_str .= ",";}
      }
  $SQL="CREATE TABLE IF NOT EXISTS `".$table."` (".$fields_str.")";
  //echo $SQL;
  $result=mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL CREATE TABLE Error : ".mysql_error($conn)."<br>";
	  }
     }
  return $result;
  } 
/*-----------------------------------------------------------------------------
drop_table($table, $database=DATABASE)
功能 : 
  此函數根據傳入之名稱刪除資料表.			
參數 :                                   
  $table      : 資料表名稱 (字串) 
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回 TRUE, 失敗傳回 FALSE
範例 : 
  $result=drop_table("users");    
-----------------------------------------------------------------------------*/
function drop_table($table, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="DROP TABLE IF EXISTS `".$table."`";
  //echo $SQL;
  $result=mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL DROP TABLE Error : ".mysql_error($conn);
	  }
     }
  return $result;
  } 
/*-----------------------------------------------------------------------------
get_tables($database=DATABASE)
功能 : 
  取得資料庫內所有資料表名稱.			
參數 :   
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回資料表名稱陣列, 失敗傳回 FALSE.
範例 : 
  $tables=get_tables();    
-----------------------------------------------------------------------------*/
function get_tables($database=DATABASE) { 
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="SHOW TABLES FROM ".DATABASE;
  $result=mysql_query($SQL, $conn); //顯示資料表
  while ($data=mysql_fetch_row($result)) {
         $tables[]=$data[0]; //資料表名稱存入陣列
        } //end of while
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL SHOW TABLES Error : ".mysql_error($conn)."<br>";
	  }
      return FALSE;
     }
  return $tables;
  } 
/*-----------------------------------------------------------------------------
create_fields($table, $field_array, $database=DATABASE)
功能 : 
  此函數根據傳入之欄位陣列建立新欄位 (可以一次新增多個欄位).			
參數 :                                   
  $table       : 資料表名稱 (字串) 
  $field_array : 關聯式資料欄位陣列, key=欄位名稱為, value=欄位型態屬性 
                 可用型態與屬性參考 create_table()
  $database    : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回 TRUE, 失敗傳回 FALSE
範例 : 
  $field_array["id"]="VARCHAR(20)";
  $field_array["name"]="VARCHAR(255)";
  $field_array["login_counts"]="INT(2)";
  $field_array["serial_no"]="INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT".
                            " PRIMARY KEY";
  $result=create_fields("users",$field_array);  
-----------------------------------------------------------------------------*/
function create_fields($table, $field_array, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $fields_str=""; //欄位字串
  for ($i=0; $i<count($field_array); $i++) {
       list($key,$value)=each($field_array);
       $fields_str.="ADD `".$key."` ".$value;
       if ($i!=count($field_array)-1) {$fields_str .= ",";}
      }
  $SQL="ALTER TABLE `".$table."` ".$fields_str;
  //echo $SQL;
  $result=mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL ALTER TABLE Error : ".mysql_error($conn)."<br>";
	  }
     }
  return $result;
  } 
/*-----------------------------------------------------------------------------
drop_field($table, $field, $database=DATABASE)
功能 : 
  此函數根據傳入之欄位名稱刪除資料表之欄位 (一次只能刪除一個欄位).			
參數 :                                   
  $table      : 資料表名稱 (字串) 
  $field      : 欄位名稱 (字串) 
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回 TRUE, 失敗傳回 FALSE
範例 : 
  $result=drop_field("users", "age");    
-----------------------------------------------------------------------------*/
function drop_field($table, $field, $database=DATABASE) {
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="ALTER TABLE `".$table."` DROP ".$field;
  //echo $SQL;
  $result=mysql_query($SQL, $conn);
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL ALTER TABLE Error : ".mysql_error($conn)."<br>";
	  }
     }
  return $result;
  } 
/*-----------------------------------------------------------------------------
find_field($table, $field, $database=DATABASE)
功能 : 
  查詢資料表之欄位是否已存在, 是傳回 TRUE, 否傳回 FALSE.			
參數 :                                   
  $table      : 資料表名稱 (字串) 
  $field      : 欄位名稱 (字串)
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  有找到傳回 TRUE, 沒找到傳回 FALSE.
範例 : 
  $result=find_field("users","name");    
-----------------------------------------------------------------------------*/
function find_field($table, $field, $database=DATABASE) { 
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="SHOW FIELDS FROM ".$table;
  $result=mysql_query($SQL, $conn); //顯示資料表
  while ($data=mysql_fetch_row($result)) {
         if ($data[0]==$field) {return TRUE;} 
        } //end of while
  return FALSE;
  } 
/*-----------------------------------------------------------------------------
get_fields($table, $database=DATABASE)
功能 : 
  傳回資料表之所有欄位名稱陣列.			
參數 :                                   
  $table      : 資料表名稱 (字串)
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回資料表欄位名稱陣列, 失敗傳回 FALSE.
範例 : 
  $result=get_fields("users");    
-----------------------------------------------------------------------------*/
function get_fields($table, $database=DATABASE) { 
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="SHOW FIELDS FROM ".$table;
  $result=mysql_query($SQL, $conn); //顯示資料表
  while ($data=mysql_fetch_row($result)) {
         $fields[]=$data[0]; //欄位名稱放入陣列
        } //end of while
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL SHOW FIELDS Error : ".mysql_error($conn)."<br>";
	  }
      return FALSE;
     }
  return $fields;
  } 
/*-----------------------------------------------------------------------------
get_fieldtypes($table, $database=DATABASE)
功能 : 
  傳回資料表之所有欄位名稱, 類型, 與最大長度之陣列.			
參數 :                                   
  $table      : 資料表名稱 (字串)
  $database   : 資料庫名稱 (字串, 預設為 dbsettings 中的常數 DATABASE)
傳回值 :
  成功傳回一維陣列, 內容為欄位名稱, 類型, 最大長度, 以逗號隔開, 例如 :
  name,string,50
  失敗傳回 FALSE
範例 : 
  $result=get_fieldtypes("users");  
  for ($i=0; $i<count($result); $i++) { //走訪紀錄集陣列
       echo $result[$i]."<br>";
      }
-----------------------------------------------------------------------------*/
function get_fieldtypes($table, $database=DATABASE) { 
  $conn=get_connection(); //取得 MySQL 資料庫連線
  if (!$conn) {return FALSE;} //無法取得連線傳回 FALSE
  $result=mysql_select_db($database, $conn); //開啟資料庫
  if (!$result) {return FALSE;} //選擇資料庫失敗傳回 FALSE
  $SQL="SELECT * FROM ".$table." LIMIT 0,1";
  $result=mysql_query($SQL, $conn); //顯示資料表
  $fieldtypes=Array();
  while ($i<mysql_num_fields($result)) {
         $meta=mysql_fetch_field($result, $i); //取得欄位的 meta
         $fieldtypes[]=$meta->name.",".$meta->type.",".$meta->max_length;
         $i++; 
        } //end of while
  if (mysql_error($conn)) { //若失敗取得資料庫伺服器錯誤敘述
      if (SHOW_ERROR) {
          echo "MySQL SHOW FIELDS Error : ".mysql_error($conn)."<br>";
	  }
      return FALSE;
     }
  return $fieldtypes;
  } 
?>