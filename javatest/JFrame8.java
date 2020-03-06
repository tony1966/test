import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JFrame8 {
  JFrame f;
  public static void main(String argv[]) {
    new JFrame8();
    }
  public JFrame8() {
    String laf="javax.swing.plaf.nimbus.NimbusLookAndFeel";
    try {UIManager.setLookAndFeel(laf);} 
    catch(Exception e) {e.printStackTrace();}
    //JFrame.setDefaultLookAndFeelDecorated(true);
    //JDialog.setDefaultLookAndFeelDecorated(true); 
    f=new JFrame("JFrame 8");
    f.setBounds(0,0,400,300); 
    f.setVisible(true); 
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