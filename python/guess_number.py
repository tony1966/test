secret_number=87
n=int(input('輸入 1~100 的數字:'))
while not (n==secret_number):
    if n > secret_number:
        print('您猜的數字太大了!')
    else:
        print('您猜的數字太小了!')
    n=int(input('再輸入 1~100 的數字:'))
print('您猜對了')