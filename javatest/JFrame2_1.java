import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame2_1 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame2_1();
    }
  public JFrame2_1() {
    f=new JFrame("JFrame 2_1");
    f.setUndecorated(true);
    f.getRootPane().setWindowDecorationStyle(JRootPane.FRAME);
    f.setSize(400,300);
    f.setVisible(true);
    }
  }