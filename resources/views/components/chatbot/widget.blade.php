<!-- Plant Hub Chatbot Widget -->
<div id="botman-widget-wrapper">
    <style>
        * {
            box-sizing: border-box;
        }

        #botman-widget-wrapper {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .botman-widget-toggle {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2b572f 0%, #4a7c4e 100%);
            color: white;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(43, 87, 47, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 99999;
            outline: none;
        }

        .botman-widget-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 24px rgba(43, 87, 47, 0.4);
        }

        .botman-widget-toggle:active {
            transform: scale(0.95);
        }

        .botman-widget-toggle.hidden {
            display: none;
        }

        .botman-widget-container {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 400px;
            height: 500px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 99998;
            animation: slideIn 0.3s ease-out forwards;
        }

        .botman-widget-container.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .botman-widget-header {
            background: linear-gradient(135deg, #2b572f 0%, #4a7c4e 100%);
            color: white;
            padding: 16px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .botman-widget-header-content h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .botman-widget-header-content p {
            margin: 4px 0 0 0;
            font-size: 12px;
            opacity: 0.9;
            font-weight: 400;
        }

        .botman-widget-header-controls {
            display: flex;
            gap: 8px;
            margin-left: 12px;
        }

        .botman-widget-header-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s;
            outline: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .botman-widget-header-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .botman-widget-header-btn:active {
            transform: scale(0.95);
        }

        .botman-widget-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
            background: #f8f9fa;
        }

        .botman-message {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .botman-message.user {
            align-items: flex-end;
        }

        .botman-message.bot {
            align-items: flex-start;
        }

        .botman-message-bubble {
            max-width: 85%;
            padding: 12px 14px;
            border-radius: 12px;
            word-wrap: break-word;
            line-height: 1.4;
            font-size: 14px;
        }

        .botman-message.user .botman-message-bubble {
            background: linear-gradient(135deg, #2b572f 0%, #4a7c4e 100%);
            color: white;
            border-radius: 12px 3px 12px 12px;
        }

        .botman-message.bot .botman-message-bubble {
            background: #e8f5e9;
            color: #1b5e20;
            border-radius: 3px 12px 12px 12px;
        }

        .botman-typing-dots {
            display: flex;
            gap: 4px;
            padding: 10px 14px;
        }

        .botman-typing-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #999;
            animation: typing 1.4s infinite;
        }

        .botman-typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .botman-typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% {
                opacity: 0.3;
                transform: translateY(0);
            }
            30% {
                opacity: 1;
                transform: translateY(-8px);
            }
        }

        .botman-widget-input-area {
            padding: 12px;
            border-top: 1px solid #e0e0e0;
            background: white;
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .botman-widget-input-area input {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 10px 14px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .botman-widget-input-area input:focus {
            border-color: #2b572f;
            box-shadow: 0 0 0 3px rgba(43, 87, 47, 0.1);
        }

        .botman-widget-input-area button {
            background: linear-gradient(135deg, #2b572f 0%, #4a7c4e 100%);
            color: white;
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s;
            outline: none;
            flex-shrink: 0;
        }

        .botman-widget-input-area button:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(43, 87, 47, 0.3);
        }

        .botman-widget-input-area button:active {
            transform: scale(0.95);
        }

        .botman-widget-input-area button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 600px) {
            .botman-widget-container {
                position: fixed;
                bottom: 0;
                right: 0;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                border-radius: 0;
                max-width: none;
            }

            .botman-widget-container.active {
                opacity: 1;
                visibility: visible;
            }

            .botman-widget-toggle {
                bottom: 20px;
                right: 20px;
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>

    <!-- Toggle Button -->
    <button class="botman-widget-toggle" id="botman-toggle" title="Open chat" aria-label="Open Plant Hub chat">
        🌱
    </button>

    <!-- Chat Container -->
    <div class="botman-widget-container" id="botman-container">
        <!-- Header -->
        <div class="botman-widget-header">
            <div class="botman-widget-header-content">
                <h3>🌿 Plant Hub TT</h3>
                <p>AI Plant Assistant</p>
            </div>
            <div class="botman-widget-header-controls">
                <button class="botman-widget-header-btn" id="botman-minimize" title="Minimize" aria-label="Minimize chat">−</button>
                <button class="botman-widget-header-btn" id="botman-close" title="Close" aria-label="Close chat">✕</button>
            </div>
        </div>

        <!-- Messages -->
        <div class="botman-widget-messages" id="botman-messages">
            <div class="botman-message bot">
                <div class="botman-message-bubble">
                    👋 Hi! I'm your Plant Assistant. How can I help you today?
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="botman-widget-input-area">
            <input
                type="text"
                id="botman-input"
                placeholder="Ask me about plants..."
                autocomplete="off"
                aria-label="Message input"
            />
            <button id="botman-send" type="button" title="Send message" aria-label="Send message">→</button>
        </div>
    </div>
</div>

<script>
    // Chat state
    const chatState = {
        isOpen: false,
        isTyping: false,
        messageBuffer: [],
    };

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Get DOM elements
    const elements = {
        toggle: document.getElementById('botman-toggle'),
        container: document.getElementById('botman-container'),
        messages: document.getElementById('botman-messages'),
        input: document.getElementById('botman-input'),
        send: document.getElementById('botman-send'),
        minimize: document.getElementById('botman-minimize'),
        close: document.getElementById('botman-close'),
    };

    // Event listeners
    elements.toggle.addEventListener('click', toggleChat);
    elements.minimize.addEventListener('click', minimizeChat);
    elements.close.addEventListener('click', closeChat);
    elements.send.addEventListener('click', sendMessage);
    elements.input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function toggleChat() {
        if (chatState.isOpen) {
            minimizeChat();
        } else {
            openChat();
        }
    }

    function openChat() {
        chatState.isOpen = true;
        elements.container.classList.add('active');
        elements.toggle.classList.add('hidden');
        elements.input.focus();
    }

    function minimizeChat() {
        chatState.isOpen = false;
        elements.container.classList.remove('active');
        elements.toggle.classList.remove('hidden');
    }

    function closeChat() {
        minimizeChat();
    }

    function addMessage(sender, text) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `botman-message ${sender}`;

        const bubble = document.createElement('div');
        bubble.className = 'botman-message-bubble';
        bubble.textContent = text;

        messageDiv.appendChild(bubble);
        elements.messages.appendChild(messageDiv);
        elements.messages.scrollTop = elements.messages.scrollHeight;
        chatState.isTyping = true;
    }

    function showTyping() {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'botman-message bot';
        messageDiv.id = 'typing-indicator';

        const dots = document.createElement('div');
        dots.className = 'botman-typing-dots';
        dots.innerHTML = '<div class="botman-typing-dot"></div><div class="botman-typing-dot"></div><div class="botman-typing-dot"></div>';

        messageDiv.appendChild(dots);
        elements.messages.appendChild(messageDiv);
        elements.messages.scrollTop = elements.messages.scrollHeight;
    }

    function removeTyping() {
        const indicator = document.getElementById('typing-indicator');
        if (indicator) {
            indicator.remove();
        }
        chatState.isTyping = false;
    }

    function sendMessage() {
        const messageText = elements.input.value.trim();

        if (!messageText) return;

        // Add user message
        addMessage('user', messageText);
        elements.input.value = '';

        // Show typing indicator
        showTyping();

        // Send message to backend
        const formData = new FormData();
        formData.append('message', messageText);

        fetch('/botman/chat', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            removeTyping();
            handleBotResponse(data);
        })
        .catch(error => {
            removeTyping();
            console.error('Error:', error);
            addMessage('bot', 'Sorry, I encountered an error. Please try again.');
        });
    }

    function handleBotResponse(data) {
        console.log('Raw response:', data);

        let message = '';

        try {
            const json = JSON.parse(data);
            console.log('Parsed JSON:', json);

            // Handle different response formats from BotMan
            if (json.messages && Array.isArray(json.messages)) {
                // Handle array of messages
                json.messages.forEach(msg => {
                    if (typeof msg === 'string') {
                        message += msg + '\n';
                    } else if (msg.text) {
                        message += msg.text + '\n';
                    } else if (msg.message) {
                        message += msg.message + '\n';
                    }
                });
            } else if (typeof json === 'string') {
                message = json;
            } else if (json.text) {
                message = json.text;
            } else if (json.message) {
                message = json.message;
            } else if (json.reply) {
                message = json.reply;
            } else if (Array.isArray(json)) {
                json.forEach(item => {
                    if (typeof item === 'string') {
                        message += item + '\n';
                    } else if (item.text) {
                        message += item.text + '\n';
                    }
                });
            } else if (json.data && typeof json.data === 'string') {
                message = json.data;
            }
        } catch (e) {
            // If JSON parsing fails, treat as plain text
            message = data;
        }

        if (message) {
            // Convert markdown-style links to clickable elements
            message = convertLinksInMessage(message.trim());
            addMessageWithHTML('bot', message);
        } else {
            addMessage('bot', 'I received your message but couldn\'t generate a response.');
        }
    }

    function convertLinksInMessage(message) {
        // Convert "🔗 URL" or "🛒 URL" pattern to clickable links
        message = message.replace(/🔗\s*(\S+)/g, '<a href="$1" target="_blank" style="color: #2b572f; text-decoration: underline;">View Product 🔗</a>');
        message = message.replace(/🛒\s*(\S+)/g, '<a href="$1" target="_blank" style="color: #2b572f; text-decoration: underline;">Shop Now 🛒</a>');
        return message;
    }

    function addMessageWithHTML(sender, htmlContent) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `botman-message ${sender}`;

        const bubble = document.createElement('div');
        bubble.className = 'botman-message-bubble';
        bubble.innerHTML = htmlContent;

        messageDiv.appendChild(bubble);
        elements.messages.appendChild(messageDiv);
        elements.messages.scrollTop = elements.messages.scrollHeight;
        chatState.isTyping = false;
    }
</script>
