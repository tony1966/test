import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JLabel3 {
  JFrame f;
  public static void main(String argv[]) {
    new JLabel3();  
    }
  public JLabel3() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JLabel3");
    f.setSize(400,300); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(null);
    ImageIcon icon=new ImageIcon("icon.jpg");
    JLabel label1=new JLabel("標籤1",icon,SwingConstants.LEFT);
    label1.setBounds(20,20,100,50);
    cp.add(label1);
    JLabel label2=new JLabel("標籤2",icon,SwingConstants.RIGHT);
    label2.setBounds(20,80,100,50);
    cp.add(label2);
    JLabel label3=new JLabel("標籤3",icon,SwingConstants.CENTER);
    label3.setBounds(20,140,100,50);
    cp.add(label3);
    JLabel label4=new JLabel("標籤4",icon,SwingConstants.CENTER);
    label4.setHorizontalTextPosition(SwingConstants.LEFT);
    label4.setBounds(20,200,100,50);
    cp.add(label4);
    JLabel label5=new JLabel("標籤5",icon,SwingConstants.RIGHT);
    label5.setVerticalTextPosition(SwingConstants.TOP);
    label5.setBounds(200,20,100,50);
    cp.add(label5);
    JLabel label6=new JLabel("標籤6",icon,SwingConstants.RIGHT);
    label6.setVerticalTextPosition(SwingConstants.CENTER);
    label6.setBounds(200,80,100,50);
    cp.add(label6);
    JLabel label7=new JLabel("標籤7",icon,SwingConstants.RIGHT);
    label7.setVerticalTextPosition(SwingConstants.BOTTOM);
    label7.setBounds(200,140,100,50);
    cp.add(label7);
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