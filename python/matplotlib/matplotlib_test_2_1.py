import matplotlib.pyplot as plt 
temperature=[25.4, 23.7, 28.6, 29.2, 24.8, 22.5, 21.9] 
week=['Sun','Mon','Tue','Wen','Thu','Fri','Sat']   #X 軸資料
plt.plot(week,temperature,'ro')                    #指定紅色圓點樣式
plt.show()