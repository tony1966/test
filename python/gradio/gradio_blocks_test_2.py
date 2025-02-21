import gradio as gr

def handler(text):
    return text.upper()

with gr.Blocks() as blocks:
    with gr.Row():
        in1=gr.Textbox(label="輸入文字")
        btn=gr.Button("送出")
        out1=gr.Textbox(label="輸出結果")
    btn.click(fn=handler , inputs=in1, outputs=out1)
     
blocks.launch()