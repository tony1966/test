import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame1 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame1();
    }
  public JFrame1() {
    f=new JFrame("JFrame 1");
    f.setBounds(0,0,400,300);
    f.setVisible(true);
    }
  }