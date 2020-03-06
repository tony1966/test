import java.io.*;
public class file2 {
  public static void main(String[] args) {
    try {
      FileReader fr=new FileReader("test.txt");
      BufferedReader br=new BufferedReader(fr);
      int ch;
      while ((ch=br.read()) != -1) {
        System.out.print((char)ch);
        }
      }
    catch (IOException e) {System.out.println(e);}
    }
  }