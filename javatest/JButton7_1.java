import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton7_1 {
  JFrame f;
  JButton b1,b2,b3,b4,b5;
  public static void main(String argv[]) {
    new JButton7_1();  
    }
  public JButton7_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton7_1");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(new FlowLayout(FlowLayout.LEFT));
    b1=new JButton("按鈕 1"); 
    b2=new JButton("按鈕 2"); 
    b3=new JButton("按鈕 3"); 
    b4=new JButton("按鈕 4"); 
    b5=new JButton("按鈕 5"); 
    cp.add(b1);
    cp.add(b2);
    cp.add(b3);
    cp.add(b4);
    cp.add(b5);
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