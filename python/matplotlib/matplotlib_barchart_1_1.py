import numpy as np
import matplotlib.pyplot as plt 
votes=[608590, 5522119, 8170231]           #2020總統大選得票數
candidates=['James Soong', 'Korea Fish','Tsai Ing-Wen']  #X軸刻度
x=np.arange(len(candidates))               #產生X軸座標序列
plt.bar(x, votes, tick_label=candidates)   #繪製長條圖
plt.title('2020 Presidential Election')    #設定圖形標題
plt.xlabel('Candidates')                   #設定X軸標籤
plt.ylabel('Votes(million)')               #設定Y軸標籤
plt.show()