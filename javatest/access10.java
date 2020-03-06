import java.sql.*;
public class access10 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="ALTER TABLE users ALTER name VARCHAR(100)";
    JAccess.run(SQL);
    SQL="SELECT * FROM users";
    try {
      ResultSet rs=JAccess.run(SQL);
      ResultSetMetaData md=rs.getMetaData();
      int columns=md.getColumnCount();
      System.out.println("欄位名稱\t資料型態\t顯示大小\t自動增量\t可不填");
      for (int i=1; i<=columns; i++) {
           System.out.print(md.getColumnLabel(i) + "\t");     
           System.out.print(md.getColumnTypeName(i) + "\t"); 
           System.out.print(md.getColumnDisplaySize(i) + "\t");        
           System.out.print(md.isAutoIncrement(i) + "\t");          
           System.out.println(md.isNullable(i));                
           }
      }
    catch(Exception e) {System.out.println(e);}
    JAccess.disconnect();
    }
  }