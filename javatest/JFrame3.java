import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame3 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame3();
    }
  public JFrame3() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame 3");
    f.setSize(400,300);
    Dimension d=Toolkit.getDefaultToolkit().getScreenSize();
    Dimension s=f.getSize();
    f.setLocation((d.width-s.width)/2,(d.height-s.height)/2);
    f.setVisible(true);
    }
  }