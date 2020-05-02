import numpy as np
import matplotlib.pyplot as plt 
width=0.25
x1=[2015, 2016, 2017, 2018, 2019]          #X 軸 (第一組)
y1=(4.33, 5.67, 3.78, 5.62, 6.7)           #Y 軸1=0056殖利率
x2=[p + width for p in x1]                 #X 軸 (第二組)
y2=(3.01, 1.28, 6.1, 7.1, 7.22)            #Y 軸2=0050殖利率
x3=[p + 2*width for p in x1]               #X 軸 (第二組)
y3=(0, 2.44, 1.41, 1.72, 1.05)             #Y 軸3=0052殖利率
plt.bar(x1, y1, label='0056', width=0.25)  #繪製長條圖
plt.bar(x2, y2, label='0050', width=0.25)  #繪製長條圖
plt.bar(x3, y3, label='0052', width=0.25)  #繪製長條圖
plt.xticks([p + width for p in x1], x1)    #設定 X 軸刻度標籤
plt.legend()                               #顯示圖例
plt.title('ETF Dividend Yield')            #設定圖形標題
plt.xlabel('Year')                         #設定 X 軸標籤
plt.ylabel('Dividend yield(NT$)')          #設定 Y 軸標籤
plt.show()