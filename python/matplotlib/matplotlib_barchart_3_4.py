import numpy as np
import matplotlib.pyplot as plt 
scores=[20, 75, 45, 68, 92, 34, 65, 29, 88, 31,
        66, 94, 72, 55, 49, 59, 11, 85, 79, 84,
        69, 83, 96, 45, 73, 85, 69, 86, 100, 9]         #成績
bins_list=[0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]  #分布區域 (組距)
n, bins, patches=plt.hist(scores, bins=bins_list,
         color='cyan',
         linewidth=1,
         edgecolor='black', 
         label='Students')                        #繪製直方圖
plt.setp(patches[0:2], facecolor='red')           #設定物件屬性      
plt.setp(patches[8], facecolor='yellow')          #設定物件屬性      
plt.legend()                                      #加上圖例
plt.title('Score Distribution')                   #設定圖形標題
plt.xlabel('Scores')                              #設定 Y 軸標籤
plt.ylabel('Students')                            #設定 X 軸標籤
plt.xticks(bins_list)                             #設定 X 軸刻度
plt.show()