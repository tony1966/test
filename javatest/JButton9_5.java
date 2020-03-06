import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;

public class JButton9_5 {
  JFrame f;
  JButton b1,b2,b3;
  Container cp;
  GridBagConstraints gbc;
  public static void main(String argv[]) {
    new JButton9_5();  
    }
  public JButton9_5() {
    JFrame.setDefaultLookAndFeelDecorated(true);
    JDialog.setDefaultLookAndFeelDecorated(true);
    f=new JFrame("JButton9_5");
    f.setSize(300,200); 
    f.setLocationRelativeTo(null);  
    f.setVisible(true); 
    cp=f.getContentPane();
    GridBagLayout gbl=new GridBagLayout();
    cp.setLayout(gbl);
    gbc=new GridBagConstraints();
    gbc.fill=GridBagConstraints.BOTH;
    gbc.insets=new Insets(3,3,3,3);
    gbc.weightx=1;
    gbc.weighty=0;
    b1=new JButton("按鈕 1");
    addComponent(b1,0,0,3,3);
    gbc.weightx=0;
    gbc.weighty=0;
    b2=new JButton("按鈕 2");
    addComponent(b2,3,0,1,1);
    b3=new JButton("按鈕 3");
    addComponent(b3,3,1,1,2);
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
  public void addComponent(Component c, int row, int column, 
                           int width, int height) {
    gbc.gridx=row;
    gbc.gridy=column;
    gbc.gridwidth=width;
    gbc.gridheight=height;
    cp.add(c,gbc);
    }
  }