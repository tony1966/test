import java.sql.*;
public class access8 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="ALTER TABLE users ADD telephone VARCHAR(20),city VARCHAR(20)";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }