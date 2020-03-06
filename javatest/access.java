//http://tw.knowledge.yahoo.com/question/question?qid=1007022101275
import java.sql.*; 
import java.sql.SQLException;
import java.sql.ResultSet;

public class access {
  public static void main(String[] args) {
    try {
       ResultSet rs = null;
       Connection conn = null;
       Statement stat = null;
       String strSql = "";

       Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
       String db="jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};" +
                 "DBQ=test.mdb;DriverID=22;READONLY=false}"; 

       conn = DriverManager.getConnection(db ,"",""); 
       stat = conn.createStatement();

       try {
            strSql = "select top 10 * from users";
            rs = stat.executeQuery(strSql);
            while (rs.next()){ 
                   System.out.println(rs.getString("name")); 
                   }
            }
       catch (SQLException e) {System.out.println(e);}
       catch (NullPointerException e) {System.out.println(e); }
       catch (Exception e) {System.out.println(e);}
       }
    catch(Exception e) {System.out.println(e);}
    }
  }