import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton5 implements ActionListener{
  JFrame f;
  public static void main(String argv[]) {
    new JButton5();  
    }
  public JButton5() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton5");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    JButton b1=new JButton("確定");    
    b1.setBounds(20,20,100,40);
    b1.addActionListener(this);
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
  public void actionPerformed(ActionEvent e) {
    JOptionPane.showMessageDialog(f,
      "您按了" + e.getActionCommand(),
      "訊息",JOptionPane.INFORMATION_MESSAGE);
    }
  }