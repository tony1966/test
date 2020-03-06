import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton6_3 implements ActionListener{
  JFrame f;
  JButton ok,cancel,quit;
  public static void main(String argv[]) {
    new JButton6_3();  
    }
  public JButton6_3() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton6_3");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    ok=new JButton("確定(O)");    
    cancel=new JButton("取消(C)");    
    quit=new JButton("關閉(Q)");    
    ok.setBounds(20,20,100,40);
    cancel.setBounds(150,20,100,40);
    quit.setBounds(280,20,100,40);
    ok.setMnemonic('O');
    cancel.setMnemonic('C');
    quit.setMnemonic('Q');
    ok.addActionListener(this);
    cancel.addActionListener(this);
    quit.addActionListener(this);
    cp.add(ok);
    cp.add(cancel);
    cp.add(quit);
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
    if (e.getSource()==quit) {System.exit(0);}
    else if (e.getSource()==ok) {btn="確定";}
    else if (e.getSource()==cancel) {btn="取消";}
    JOptionPane.showMessageDialog(f,
      "您按了" + btn,
      "訊息",JOptionPane.INFORMATION_MESSAGE);
    }
  }