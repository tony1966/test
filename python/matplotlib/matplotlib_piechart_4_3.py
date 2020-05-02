import numpy as np
import matplotlib.pyplot as plt 
def myautopct(data):
   def inner_myautopct(pct):
       total=sum(data)
       val=int(round(pct*total/100.0))
       return '{p:.0f}% ({v:d})'.format(p=pct,v=val)
   return inner_myautopct
data=[600, 200, 100, 50, 50]                             #資產配置 (百萬元)
labels=['Stock', 'Bond', 'Cash', 'Gold', 'Real estate']  #資產標籤
colors=['#1f77b4', 'yellow', 'green', 'red', 'cyan']     #資產顏色 
plt.pie(data, labels=labels, autopct=myautopct(data), 
        colors=colors)                                   #繪製圓餅圖
print(myautopct(data))
plt.title('Asset Allocation')                            #設定圖形標題
plt.show()