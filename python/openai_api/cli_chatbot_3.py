from openai import OpenAI, APIError   

def ask_gpt(messages, model='gpt-3.5-turbo'):
    try:
        reply=client.chat.completions.create(
            model=model,
            messages=messages
            )
        return reply.choices[0].message.content
    except APIError as e:
        return e.message

# 建立 OpenAI 物件
api_key='填入 API key'    
client=OpenAI(api_key=api_key) 
# 設定 AI 系統扮演之角色
sys_role=input('設定 GPT 角色 : ')
if sys_role.strip() == '': 
    sys_role='你是繁體中文AI助理'
print(sys_role)
# 初始化記憶:存入系統角色字典
memory=[{'role': 'system', 'content': sys_role}]
retro=2  # 設定記憶前面幾回聊天次數

while True:  # 無窮迴圈
    prompt=input('You : ')  # 輸入提示詞
    if prompt.strip() == '':  # Enter 跳出迴圈
        print('GPT : 再見。')
        break
    memory.append({'role': 'user', 'content': prompt}) # 提示詞存入記憶
    reply=ask_gpt(memory)  # 將記憶資料傳給模型
    memory.append({'role': 'assistant', 'content': reply}) # 回應存入記憶
    memory=[memory[0]] + memory[-(retro * 2):]  # 取出系統角色串接前幾回聊天紀錄
    print(f'GPT : {reply}')  # 輸出 API 回應