import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JTextField3 {
  JFrame f;
  public static void main(String argv[]) {
    new JTextField3();  
    }
  public JTextField3() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JTextField3");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null); 
    Container cp=f.getContentPane();
    cp.setLayout(new GridLayout(0,1));
    JTextField text1=new JTextField(5);
    cp.add(text1);
    JTextField text2=new JTextField(15);
    cp.add(text2);
    JTextField text3=new JTextField("請輸入帳號");
    cp.add(text3);
    JTextField text4=new JTextField("請輸入密碼", 20);
    cp.add(text4);
    f.setDefaultCloseOperation(WindowConstants.DO_NOTHING_ON_CLOSE);     
    f.setVisible(true); 
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