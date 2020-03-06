import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton6_2 implements ActionListener{
  JFrame f;
  JButton ok,cancel;
  public static void main(String argv[]) {
    new JButton6_2();  
    }
  public JButton6_2() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton6_2");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    ok=new JButton("確定");    
    cancel=new JButton("取消");    
    ok.setBounds(20,20,100,40);
    cancel.setBounds(150,20,100,40);
    ok.addActionListener(this);
    cancel.addActionListener(this);
    cp.add(ok);
    cp.add(cancel);
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
    String btn="";
    if (e.getSource()==ok) {btn="確定";}
    else if (e.getSource()==cancel) {btn="取消";}
    JOptionPane.showMessageDialog(f,
      "您按了" + btn,
      "訊息",JOptionPane.INFORMATION_MESSAGE);
    }
  }