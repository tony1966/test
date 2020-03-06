import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame4_1 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame4_1();
    }
  public JFrame4_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JFrame4_1");
    f.setExtendedState(Frame.MAXIMIZED_BOTH);
    f.setVisible(true);
    }
  }