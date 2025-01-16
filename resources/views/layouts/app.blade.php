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
    background-color:rgb(255, 123, 0);
    color: white;
    font-size: 18px;
    border: none;
    cursor: pointer;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.chatbot-btn:hover {
    background-color:rgb(179, 101, 0);
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
    background-color:rgb(255, 145, 0);
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
    width: 93%;
    padding: 10px;
    margin: 10px;
    border-radius: 20px;
    border: 1px solid orange;
}
.user,.bot {
    background-color: #f0f0f0; /* Soft light grey background */
    border-radius: 8px; /* Rounded corners */
    padding: 10px; /* Padding for spacing */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    color: #333; /* Dark text color for contrast */
    font-family: 'Arial', sans-serif; /* Clean, modern font */
    font-size: 16px; /* Easy-to-read font size */
    max-width: 280px; /* Limit the width for a neat look */
    margin: 20px auto; /* Centered horizontally with margin */
}
.user{
    background-color: rgb(253, 195, 80);
}
.send-message {
    background-color:rgb(255, 140, 0);
    color: white;
    padding: 10px;
    border-radius: 20px;
    border: none;
    cursor: pointer;
    margin: 10px;
    width: 93%;
}

.send-message:hover {
    background-color:rgb(179, 98, 0);
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
<div id="chatbot-popup" class="chatbot-popup" style="display: none;">
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
    chatbotBtn.addEventListener('click', function () {
        chatbotPopup.style.display = 'flex';
    });

    // Close the chatbot popup
    closeChat.addEventListener('click', function () {
        chatbotPopup.style.display = 'none';
    });

    // Function to add a message to the chatbox
    function addMessage(message, sender = 'user') {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add(sender); // Add 'user' or 'bot' class
        messageDiv.textContent = message;
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
    }

    // Send message to chatbot
    async function sendMessage() {
        const message = userMessageInput.value.trim(); // Get and trim user input
        if (!message) return;

        // Add user's message to chatbox
        addMessage(message, 'user');
        userMessageInput.value = ''; // Clear input field

        try {
            // Send user message to Laravel API
            const response = await fetch('/chatbot-query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ query: message }),
            });
            // Log the raw response before parsing it
            console.log(await response.text());

            // Parse response from server
            const data = await response.json();
            const botResponse = data.response || 'Sorry, I did not understand that.';
            addMessage(botResponse, 'bot');
        } catch (error) {
            addMessage('Error connecting to the server.', 'bot');
        }
    }

    // Allow sending messages by pressing 'Enter'
    userMessageInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Send message on button click
    sendMessageBtn.addEventListener('click', sendMessage);
</script>



    </body>
</html>

