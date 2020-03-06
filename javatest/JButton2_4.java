import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton2_4 {
  JFrame f;
  public static void main(String argv[]) {
    new JButton2_4();  
    }
  public JButton2_4() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton2_4");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
    Container cp=f.getContentPane();
    cp.setLayout(new BorderLayout(3,3));
    JButton center=new JButton("中");
    JButton east=new JButton("東");
    JButton west=new JButton("西");
    JButton south=new JButton("南");
    JButton north=new JButton("北");
    cp.add(center,BorderLayout.CENTER);
    cp.add(east,BorderLayout.EAST);
    cp.add(west,BorderLayout.WEST);
    cp.add(south,BorderLayout.SOUTH);
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