import gradio as gr

def handler(in1):
    global chat_history
    chat_history.append({'role': 'user', 'content': in1})
    bot_response=in1  # 鸚鵡回應
    chat_history.append({'role': 'assistant', 'content': bot_response})
    return chat_history

chat_history=[]  # 儲存對話歷史
in1=gr.Textbox(placeholder='輸入你的訊息 ...')
out1=gr.Chatbot(type='messages', height=400, placeholder='我們的對話')
iface=gr.Interface(
    fn=handler,
    inputs=in1,
    outputs=out1,
    title='鸚鵡聊天機器人',
    flagging_mode='never'  
    )
iface.launch()