from openai import OpenAI, APIError   

# 設定 API Key
api_key='填入 API key'    
client=OpenAI(api_key=api_key)

def ask_gpt(messages, model='gpt-3.5-turbo'):
    try:
        # 啟用 stream=True 讓 GPT 逐步回應
        chunks=client.chat.completions.create(
            model=model,
            messages=messages,
            stream=True  # 啟用串流
            )
        reply=''  # 儲存完整回應
        print('GPT :', end=' ', flush=True)  # 立即輸出回應字元
        for chunk in chunks:
            if chunk.choices and chunk.choices[0].delta.content:
                text=chunk.choices[0].delta.content or ''  # 用 or 處理 None 回應 
                reply += text
                print(text, end='', flush=True)  # 即時輸出
        print()  # 換行
        return reply  # 回傳完整回應
    except APIError as e:
        return str(e)

# 設定 AI 角色
sys_role=input('設定 GPT 角色 : ').strip()
if not sys_role:
    sys_role='你是繁體中文AI助理'
print(f'系統角色：{sys_role}')

# 初始化記憶
memory=[{'role': 'system', 'content': sys_role}]

while True:
    prompt=input('You : ').strip()
    if not prompt:
        print('GPT : 再見。')
        break
    memory.append({'role': 'user', 'content': prompt})  # 記錄使用者輸入
    reply=ask_gpt(memory)  # 串流模式請求
    memory.append({'role': 'assistant', 'content': reply})  # 記錄 AI 回應
