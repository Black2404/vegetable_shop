<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chatbot</title>
    <style>
        /* Nút mở chatbot */
        #chatbot-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #6b6a4c; 
            color: white;
            font-size: 22px;
            padding: 12px 15px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: 0.3s;
            z-index: 999;
        }
        #chatbot-toggle:hover {
            background: #5a5940;
        }

        /* Hộp Chatbot */
        #chatbox {
            position: fixed;
            right: 20px;
            bottom: 80px;
            width: 320px;
            height: 420px;
            background: #f9f7f2; 
            border: 1px solid #ccc;
            border-radius: 12px;
            display: none; 
            flex-direction: column;
            box-shadow: 0 4px 10px rgba(0,0,0,.2);
            font-family: Arial, sans-serif;
            z-index: 1000;
        }

        /* Header */
        #chat-header {
            background: #6b6a4c; 
            color: #fff;
            padding: 10px;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #chat-header button {
            background: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Body */
        #chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            font-size: 14px;
        }
        .bot-msg, .user-msg {
            display: inline-block;       
            max-width: 80%;              
            word-wrap: break-word;       
            padding: 8px 12px;
            border-radius: 10px;
            margin: 6px 0;               
            clear: both;                 
        }

        .bot-msg {
            background: #e6e4da;
            float: left;                 
        }

        .user-msg {
            background: #d1f0d1;
            float: right;                
            text-align: left;
        }

        /* Footer */
        #chat-footer {
            display: flex;
            border-top: 1px solid #eee;
        }
        #chat-input {
            flex: 1;
            border: none;
            padding: 10px;
            font-size: 14px;
            outline: none;
        }
        #chat-send {
            border: none;
            background: #6b6a4c;
            color: #fff;
            padding: 0 14px;
            cursor: pointer;
        }
        #chat-send:hover {
            background: #5a5940;
        }
    </style>
</head>
<body>

<!-- Nút bật chatbot -->
<div id="chatbot-toggle">💬</div>

<!-- Chatbox -->
<div id="chatbox">
    <div id="chat-header">
        <span>Chatbot</span>
        <button onclick="closeChat()">✖</button>
    </div>
    <div id="chat-body">
        <div class="bot-msg">Xin chào! Tôi có thể giúp gì cho bạn?</div>
    </div>
    <div id="chat-footer">
        <input id="chat-input" placeholder="Nhập tin nhắn...">
        <button id="chat-send" onclick="sendMessage()">Gửi</button>
    </div>
</div>

<script>
    // Mở chat
    document.getElementById('chatbot-toggle').addEventListener('click', () => {
        document.getElementById('chatbox').style.display = 'flex';
    });

    // Đóng chat
    function closeChat() {
        document.getElementById('chatbox').style.display = 'none';
    }

    // Gửi tin nhắn
    async function sendMessage() {
        let input = document.getElementById('chat-input');
        let body = document.getElementById('chat-body');
        let msg = input.value.trim();

        if (msg !== "") {
            body.innerHTML += `<div class="user-msg">${msg}</div>`;
            input.value = "";
            body.scrollTop = body.scrollHeight;

            try {
                let response = await fetch("/chatbot", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ message: msg })
                });

                let data = await response.json();
                let reply = data.reply ?? "Bot chưa hiểu.";
                body.innerHTML += `<div class="bot-msg">${reply}</div>`;
                body.scrollTop = body.scrollHeight;

            } catch (e) {
                body.innerHTML += `<div class="bot-msg">Lỗi kết nối server.</div>`;
            }
        }
    }

    // Bấm Enter để gửi
    document.getElementById('chat-input').addEventListener("keypress", (e) => {
        if (e.key === "Enter") sendMessage();
    });
</script>

</body>
</html>
