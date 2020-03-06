import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame7 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame7();  
    }
  public JFrame7() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame 7");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
    f.addWindowListener(new WindowHandler());
    }
  }

class WindowHandler extends WindowAdapter {
  public void windowClosing(WindowEvent e) {System.exit(0);}
  }