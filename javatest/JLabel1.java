import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JLabel1 {
  JFrame f;
  public static void main(String argv[]) {
    new JLabel1();  
    }
  public JLabel1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JLabel1");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    JLabel label1=new JLabel("標籤 1");
    label1.setBounds(20,20,100,40);
    cp.add(label1);
    JLabel label2=new JLabel();
    label2.setText("標籤 2");
    label2.setBounds(20,50,100,40);
    cp.add(label2);
    JLabel label3=new JLabel("標籤 3",SwingConstants.RIGHT);
    label3.setBounds(20,80,100,40);
    cp.add(label3);
    JLabel label4=new JLabel("標籤 4",SwingConstants.CENTER);
    label4.setBounds(20,110,100,40);
    cp.add(label4);
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