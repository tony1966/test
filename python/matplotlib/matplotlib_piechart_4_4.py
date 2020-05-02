import numpy as np
import matplotlib.pyplot as plt 
data=[600, 200, 100, 50, 50]                             #資產配置 (百萬元)
labels=['Stock', 'Bond', 'Cash', 'Gold', 'Real estate']  #資產標籤
colors=['#1f77b4', 'yellow', 'green', 'red', 'cyan']     #資產顏色 
plt.pie(data, labels=labels, 
        autopct=lambda p:f'{p:.0f}% ({p*sum(data)/100 :.0f})', 
        colors=colors)                                   #繪製圓餅圖
plt.title('Asset Allocation')                            #設定圖形標題
plt.show()