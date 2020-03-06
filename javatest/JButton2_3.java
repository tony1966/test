import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton2_3 {
  JFrame f;
  public static void main(String argv[]) {
    new JButton2_3();  
    }
  public JButton2_3() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton2_3");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
    Container cp=f.getContentPane();
    JButton center=new JButton("中");
    JButton east=new JButton("東");
    JButton west=new JButton("西");
    JButton north=new JButton("北");
    cp.add(center,BorderLayout.CENTER);
    cp.add(east,BorderLayout.EAST);
    cp.add(west,BorderLayout.WEST);
    cp.add(north,BorderLayout.NORTH);
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