import numpy as np
import matplotlib.pyplot as plt 
votes=[608590, 5522119, 8170231]           #2020總統大選得票數
candidates=['James Soong', 'Korean Fish', 'Tsai Ing-Wen']  #X 軸刻度
x=np.arange(len(candidates))               #產生 X 軸座標序列
y=np.arange(0, 9000000, 1000000)           #產生 Y 軸座標序列
plt.bar(x, votes)                          #繪製長條圖
plt.xticks(x, candidates)                  #設定 X 軸刻度標籤
y_ticks=np.arange(0,900,100)               #Y軸刻度陣列
plt.yticks(y, y_ticks)                     #設定 Y 軸刻度標籤
plt.title('2020 Presidential Election')    #設定圖形標題
plt.xlabel('Candidates')                   #設定 X 軸標籤
plt.ylabel('Votes(million)')               #設定 Y 軸標籤
plt.show()