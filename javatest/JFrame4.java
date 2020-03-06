import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame4 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame4();
    }
  public JFrame4() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame 4");
    Dimension d=Toolkit.getDefaultToolkit().getScreenSize();
    f.setBounds(0,0,d.width,d.height);
    f.setVisible(true);
    }
  }