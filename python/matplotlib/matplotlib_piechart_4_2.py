import numpy as np
import matplotlib.pyplot as plt 
data=[600, 200, 100, 50, 50]                             #資產配置 (百萬)
labels=['Stock', 'Bond', 'Cash', 'Gold', 'Real estate']  #資產標籤
plt.pie(data, labels=labels, autopct='%.2f%%')           #繪製圓餅圖
plt.title('Asset Allocation')                            #設定圖形標題
plt.show()