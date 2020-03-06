import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton6_1 implements ActionListener{
  JFrame f;
  public static void main(String argv[]) {
    new JButton6_1();  
    }
  public JButton6_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton6_1");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    JButton ok1=new JButton("確定");    
    JButton ok2=new JButton("確定"); 
    JButton ok3=new JButton("確定"); 
    ok3.setEnabled(false);
    ok1.setBounds(20,20,100,40);
    ok2.setBounds(150,20,100,40);
    ok3.setBounds(280,20,100,40);
    ok1.setActionCommand("ok1");
    ok2.setActionCommand("ok2");
    ok3.setActionCommand("ok3");
    ok1.addActionListener(this);
    ok2.addActionListener(this);
    ok3.addActionListener(this);
    cp.add(ok1);
    cp.add(ok2);
    cp.add(ok3);
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
  public void actionPerformed(ActionEvent e) {
    JOptionPane.showMessageDialog(f,
      "您按了" + e.getActionCommand(),
      "訊息",JOptionPane.INFORMATION_MESSAGE);
    }
  }