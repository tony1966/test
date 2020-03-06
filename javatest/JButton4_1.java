import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton4_1 {
  JFrame f;
  public static void main(String argv[]) {
    new JButton4_1();  
    }
  public JButton4_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton4_1");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    ImageIcon icon=new ImageIcon("icon.jpg");
    JButton b1=new JButton();
    b1.setIcon(icon);
    b1.setBounds(20,20,50,50);
    cp.add(b1);
    f.setDefaultCloseOperation(WindowConstants.DO_NOTHING_ON_CLOSE);
    f.addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent e) {
        int result=JOptionPane.showConfirmDialog(f,
                   "確定要結束程式嗎?",
                   "確認訊息",
                   JOptionPane.YES_NO_OPTION,
                   JOptionPane.WARNING_MESSAGE);
        if (result==JOptionPane.YES_OPTION) {System.exit(0);}
        }    
      });
    }
  }