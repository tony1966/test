import java.sql.*;
public class access3 {
  public static void main(String[] args) {
    String SQL;
    JAccess.connect("test.mdb");
    SQL="SELECT * FROM users";
    try {
      ResultSet rs=JAccess.run(SQL);
      ResultSetMetaData md=rs.getMetaData();
      int columns=md.getColumnCount();
      for (int i=1; i<=columns; i++) {
           System.out.print(md.getColumnLabel(i) + "\t");
           } 
      System.out.println("");
      while (rs.next()) {
             for (int i=1; i<=columns; i++) {
                  System.out.print(rs.getString(i) + "\t");
                  } 
             System.out.println("");
             }
      }
    catch(Exception e) {System.out.println(e);}
    JAccess.disconnect();
    }
  }