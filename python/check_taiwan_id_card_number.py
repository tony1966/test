id=input('請輸入身分證字號:')
id=id.upper()   #轉成大寫
x1x2={'A':'10','B':'11','C':'12','D':'13','E':'14','F':'15','G':'16',
'H':'17','I':'34','J':'18','K':'19','L':'20','M':'21','N':'22','O':'35',
'P':'23','Q':'24','R':'25','S':'26','T':'27','U':'28','V':'29','W':'32',
'X':'30','Y':'31','Z':'33'}   #英文字母數值對應表
N=len(id)  #身分證字號長度
correct_format=(N==10) and (id[0].isalpha()) and (id[1:N].isdigit())
if correct_format:  #格式正確才進行驗證
    acode=x1x2.get(id[0])   #取得英文字母代碼
    x1=int(acode[0])        #取得字母代碼十位數
    x2=int(acode[1])        #取得字母代碼個位數
    i=1     #id[] 數字索引起始值 id[0] 為字母
    sum=0   #總和初始值=0
    for n in range(8, 0, -1):         #迭代 n=8,7,6,5,4,3,2,1
        sum=sum + int(id[i])* n       #計算 N1 到 N8 加權之和
        i += 1                        #索引增量
    sum=x1 + x2*9 + sum + int(id[i])  #驗證碼總和 (末項為 N9)
    print("總和=", sum)
    remainder=sum % 10
    if remainder==0:
        print("身分證字號正確")
    else:
        print("身分證字號不正確")
else:
    print("身分證字號格式 : 1個英文字母+9個阿拉伯數字")
