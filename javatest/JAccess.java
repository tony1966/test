import java.sql.*;
public class JAccess {
  static Connection conn;
  static Statement stat;
  public static void connect(String database) { 
    try {
      Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
      String dsn="jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};" +
                 "DBQ=" + database + ";DriverID=22;READONLY=false}"; 
      conn=DriverManager.getConnection(dsn, "", ""); 
      stat=conn.createStatement();
      }
    catch (Exception e) {System.out.println(e);} 
    }
  public static void disconnect() {
    try {conn.close();}
    catch (Exception e) {System.out.println(e);}
    conn=null;
    stat=null;
    }
  public static ResultSet run(String SQL) {
    ResultSet rs=null;
    try {
      boolean query=SQL.indexOf("SELECT")!=-1 || SQL.indexOf("SHOW")!=-1;   
		  if (query) {rs=stat.executeQuery(SQL);}
		  else {stat.executeUpdate(SQL);}
      }
    catch (Exception e) {System.out.println(e);}
    return rs;
    }
  }