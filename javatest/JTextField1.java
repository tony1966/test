import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JTextField1 {
  JFrame f;
  public static void main(String argv[]) {
    new JTextField1();  
    }
  public JTextField1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JTextField1");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    JTextField text1=new JTextField(5);
    text1.setBounds(20,20,100,25);
    cp.add(text1);
    JTextField text2=new JTextField(15);
    text2.setBounds(20,60,100,25);
    cp.add(text2);
    JTextField text3=new JTextField("請輸入帳號");
    text3.setBounds(20,100,100,25);
    cp.add(text3);
    JTextField text4=new JTextField("請輸入密碼", 100);
    text4.setBounds(20,140,100,25);
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