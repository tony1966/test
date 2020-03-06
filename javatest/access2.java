public class access2 {
  public static void main(String[] args) {
    String SQL;
    JAccess.connect("test.mdb");
    SQL="INSERT INTO users(name,age,gender,email,password) " +
        "VALUES('愛咪','12','女','amy@gmail.com','123')";
    JAccess.run(SQL);
    SQL="INSERT INTO users(name,age,gender,email,password) " +
        "VALUES('彼得',14,'男','peter@gmail.com','456')";
    JAccess.run(SQL);
    SQL="INSERT INTO users(name,age,gender,email,password) " +
        "VALUES('凱莉',16,'女','kelly@gmail.com','789')";
    JAccess.run(SQL);
    JAccess.disconnect();
    }
  }