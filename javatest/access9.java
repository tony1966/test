import java.sql.*;
public class access9 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="ALTER TABLE users DROP telephone,city";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }