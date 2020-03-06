import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton9_1 {
  JFrame f;
  JButton b1,b2,b3;
  public static void main(String argv[]) {
    new JButton9_1();  
    }
  public JButton9_1() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton9_1");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    Container cp=f.getContentPane();
    GridBagLayout gbl=new GridBagLayout();
    cp.setLayout(gbl);
    GridBagConstraints gbc=new GridBagConstraints();
    gbc.fill=GridBagConstraints.BOTH;
    gbc.insets=new Insets(3,3,3,3);
    gbc.gridx=0;
    gbc.gridy=0;
    gbc.gridwidth=3;
    gbc.gridheight=3;
    gbc.weightx=1;
    gbc.weighty=1;
    b1=new JButton("按鈕 1");
    gbl.setConstraints(b1, gbc);
    cp.add(b1);
    gbc.gridx=3;
    gbc.gridy=0;
    gbc.gridwidth=1;
    gbc.gridheight=1;
    gbc.weightx=0;
    gbc.weighty=0;
    b2=new JButton("按鈕 2");
    gbl.setConstraints(b2, gbc);
    cp.add(b2);
    gbc.gridx=3;
    gbc.gridy=1;
    gbc.gridwidth=1;
    gbc.gridheight=2;
    b3=new JButton("按鈕 3");
    gbl.setConstraints(b3, gbc);
    cp.add(b3);
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