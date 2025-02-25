import gradio as gr
from openai import OpenAI

def ask_gpt(api_key, prompt):
    global chat_history
    chat_history.append({'role': 'user', 'content': prompt})
    client=OpenAI(api_key=api_key)    
    chat_completion=client.chat.completions.create(
        messages=chat_history,
        model='gpt-3.5-turbo'
        )
    reply=chat_completion.choices[0].message.content
    chat_history.append({'role': 'assistant', 'content': reply})
    return chat_history

chat_history=[]  # 儲存對話歷史
api_key=gr.Textbox(label='輸入 OpenAI 金鑰', type='password') 
prompt=gr.Textbox(label='您的詢問: ')
reply=gr.Textbox(label='OpenAI 回答: ')
chatbot=gr.Chatbot(type='messages', height=400, placeholder='我們的對話')
iface=gr.Interface(
    fn=ask_gpt,
    inputs=[api_key, prompt],  
    outputs=chatbot,
    title='OpenAI API 聊天機器人',
    flagging_mode='never',
    )
iface.launch()