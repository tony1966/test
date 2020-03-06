import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JTextField6 implements ActionListener {
  JFrame f;
  JTextField text1,text2;
  JButton cut, copy, paste;
  public static void main(String argv[]) {
    new JTextField6();  
    }
  public JTextField6() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JTextField6");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    text1=new JTextField();
    text1.setBounds(20,20,200,25);
    cp.add(text1);
    cut=new JButton("剪下");
    cut.setBounds(20,70,60,25);
    cut.addActionListener(this);
    cp.add(cut);
    copy=new JButton("複製");
    copy.setBounds(90,70,60,25);
    copy.addActionListener(this);
    cp.add(copy);
    paste=new JButton("貼上");
    paste.setBounds(160,70,60,25);
    paste.addActionListener(this);
    cp.add(paste);
    text2=new JTextField();
    text2.setBounds(20,120,200,25);
    cp.add(text2);
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
    if (e.getSource()==cut) {text1.cut();}
    else if (e.getSource()==copy) {text1.copy();}
    else if (e.getSource()==paste) {text2.paste();}
    }
  }