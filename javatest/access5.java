import java.sql.*;
public class access5 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="INSERT INTO users(name) VALUES('東尼')";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }