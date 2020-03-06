import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JLabel2 {
  JFrame f;
  public static void main(String argv[]) {
    new JLabel2();  
    }
  public JLabel2() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JLabel2");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    ImageIcon icon=new ImageIcon("icon.jpg");
    JLabel label1=new JLabel(icon);
    label1.setBounds(20,20,100,50);
    label1.setToolTipText("標籤1");
    cp.add(label1);
    JLabel label2=new JLabel();
    label2.setBounds(20,70,100,50);
    label2.setIcon(icon);
    label2.setToolTipText("標籤2");
    cp.add(label2);
    JLabel label3=new JLabel(icon, SwingConstants.RIGHT);
    label3.setBounds(20,120,100,50);
    label3.setIcon(icon);
    label3.setToolTipText("標籤3");
    cp.add(label3);
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