import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton8_1 {
  JFrame f;
  JButton b1,b2,b3,b4,b5,b6,b7;
  public static void main(String argv[]) {
    new JButton8_1();  
    }
  public JButton8_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton8_1");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(new GridLayout(2,3));
    b1=new JButton("按鈕 1"); 
    b2=new JButton("按鈕 2"); 
    b3=new JButton("按鈕 3"); 
    b4=new JButton("按鈕 4"); 
    b5=new JButton("按鈕 5"); 
    b6=new JButton("按鈕 6"); 
    b7=new JButton("按鈕 7"); 
    cp.add(b1);
    cp.add(b2);
    cp.add(b3);
    cp.add(b4);
    cp.add(b5);
    cp.add(b6);
    cp.add(b7);
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