import java.sql.*;
public class access6 {
  public static void main(String[] args) {    
    String SQL;
    JAccess.connect("test.mdb");
    SQL="UPDATE users SET age='48',gender='男',email='tony@gmail.co'," +
		"password='abc' WHERE name='東尼'";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }