import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame6 implements WindowListener {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame6("JFrame 6");  
    }
  public JFrame6(String title) {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("title");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
    f.addWindowListener(this);
    }
  public void windowClosing(WindowEvent e) {System.exit(0);}
  public void windowClosed(WindowEvent e) {}
  public void windowOpened(WindowEvent e) {}
  public void windowActivated(WindowEvent e) {}
  public void windowDeactivated(WindowEvent e) {}
  public void windowIconified(WindowEvent e) {}
  public void windowDeiconified(WindowEvent e) {}
  }