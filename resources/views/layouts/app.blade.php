<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('BrighterUs', 'BrighterUs') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Chatbot Container Styles */
            .chatbot-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 12px 20px;
    border-radius: 30px;
    background-color: #007BFF;
    color: white;
    font-size: 18px;
    border: none;
    cursor: pointer;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.chatbot-btn:hover {
    background-color: #0056b3;
}

/* Chatbot Popup */
.chatbot-popup {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 300px;
    height: 400px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    display: none;
    flex-direction: column;
    justify-content: space-between;
    z-index: 999;
    animation: fadeIn 0.3s ease-in-out;
}

.chatbot-header {
    background-color: #007BFF;
    color: white;
    padding: 15px;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px 10px 0 0;
}

.close-chat {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.chat-box {
    padding: 10px;
    overflow-y: auto;
    flex-grow: 1;
    max-height: 280px;
}

.user-message {
    width: calc(100% - 40px);
    padding: 10px;
    margin: 10px;
    border-radius: 20px;
    border: 1px solid #ddd;
}

.send-message {
    background-color: #007BFF;
    color: white;
    padding: 10px;
    border-radius: 20px;
    border: none;
    cursor: pointer;
    margin: 10px;
    width: 100%;
}

.send-message:hover {
    background-color: #0056b3;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <!-- Shared Background Image -->
            <div class="bg-image">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="{{ request()->routeIs('dashboard') ? 'dashboard-header' : 'other-header' }}">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

         <!-- Chatbot -->
         <!-- Chatbot Button -->
        <button id="chatbot-btn" class="chatbot-btn">💬 Chat with us</button>

        <!-- Chatbot Popup -->
        <div id="chatbot-popup" class="chatbot-popup">
            <div class="chatbot-header">
                <span>Chatbot</span>
                <button id="close-chat" class="close-chat">×</button>
            </div>
            <div id="chat-box" class="chat-box"></div>
            <input type="text" id="user-message" class="user-message" placeholder="Type a message..." />
            <button id="send-message" class="send-message">Send</button>
        </div>
        <script>
            // Get elements
const chatbotBtn = document.getElementById('chatbot-btn');
const chatbotPopup = document.getElementById('chatbot-popup');
const closeChat = document.getElementById('close-chat');
const sendMessageBtn = document.getElementById('send-message');
const chatBox = document.getElementById('chat-box');
const userMessageInput = document.getElementById('user-message');

// Open the chatbot popup
chatbotBtn.addEventListener('click', function() {
    chatbotPopup.style.display = 'flex';
});

// Close the chatbot popup
closeChat.addEventListener('click', function() {
    chatbotPopup.style.display = 'none';
});

// Function to add a message to the chatbox
function addMessage(message, sender = 'user') {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add(sender);
    messageDiv.textContent = message;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
}

// Send message to chatbot
sendMessageBtn.addEventListener('click', function() {
    const userMessage = userMessageInput.value;
    if (userMessage.trim() !== '') {
        addMessage(userMessage); // Add user message
        userMessageInput.value = ''; // Clear input

        // Call the backend to get the chatbot's response
        axios.post('/chat', {
            message: userMessage
        })
        .then(function(response) {
            const chatbotResponse = response.data.response;
            addMessage(chatbotResponse, 'chatbot'); // Add chatbot response
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    }
});

// Allow sending messages by pressing 'Enter'
userMessageInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessageBtn.click();
    }
});

        </script>


    </body>
</html>

