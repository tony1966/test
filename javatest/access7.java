import java.sql.*;
public class access7 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="DELETE * FROM users WHERE gender='男' AND age=14";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }