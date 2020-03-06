public class access1 {
  public static void main(String[] args) {
    JAccess.connect("test.mdb");
    String SQL="CREATE TABLE users(id autoincrement PRIMARY KEY," +
               "name VARCHAR(50),age SMALLINT,gender VARCHAR(5)," +
               "email VARCHAR(255),password VARCHAR(30))";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }