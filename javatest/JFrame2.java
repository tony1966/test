import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame2 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame2();
    }
  public JFrame2() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame 2");
    f.setBounds(0,0,400,300);
    f.setVisible(true);
    }
  }