import numpy as np
import matplotlib.pyplot as plt 
height=0.25
y1=[2015, 2016, 2017, 2018, 2019]            #X 軸 (第一組)
x1=(4.33, 5.67, 3.78, 5.62, 6.7)             #Y 軸1=0056殖利率
y2=[p + height for p in y1]                  #X 軸 (第二組)
x2=(3.01, 1.28, 6.1, 7.1, 7.22)              #Y 軸2=0050殖利率
plt.barh(y1, x1, label='0056', height=0.25)  #繪製長條圖
plt.barh(y2, x2, label='0050', height=0.25)  #繪製長條圖
plt.yticks([p + height/2 for p in y1], y1)   #設定 X 軸刻度標籤
plt.legend()                                 #顯示圖例
plt.title('ETF Dividend Yield')              #設定圖形標題
plt.ylabel('Year')                           #設定 X 軸標籤
plt.xlabel('Dividend yield(NT$)')            #設定 Y 軸標籤
plt.show()