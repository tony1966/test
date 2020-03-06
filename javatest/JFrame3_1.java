import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame3_1 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame3_1();
    }
  public JFrame3_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame3_1");
    f.setSize(400,300);
    f.setLocationRelativeTo(null);
    f.setVisible(true);
    }
  }