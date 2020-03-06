import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame1_1 extends JFrame {
  public static void main(String argv[]) {    
    new JFrame1_1("JFrame 1_1");
    }
  public JFrame1_1(String title) {
    this.setBounds(0,0,400,300);
    this.setTitle(title);
    this.setVisible(true);
    }
  }