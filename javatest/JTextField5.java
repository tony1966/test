import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JTextField5 implements ActionListener {
  JFrame f;
  JTextField text1;
  JButton b1, b2;
  public static void main(String argv[]) {
    new JTextField5();  
    }
  public JTextField5() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JTextField5");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    text1=new JTextField("請輸入帳號");
    text1.setBounds(20,20,100,25);
    cp.add(text1);
    b1=new JButton("清除");
    b1.setBounds(140,20,80,25);
    b1.addActionListener(this);
    cp.add(b1);
    b2=new JButton("確定");
    b2.setBounds(230,20,80,25);
    b2.addActionListener(this);
    cp.add(b2);
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
  public void actionPerformed(ActionEvent e) {
    if (e.getSource()==b1) {
        text1.setText("");
        }
    else if (e.getSource()==b2) {
        JOptionPane.showMessageDialog(f,
          "您的帳號是 " + text1.getText(),
          "訊息",JOptionPane.INFORMATION_MESSAGE);      
        }
    }
  }