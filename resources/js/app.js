import './bootstrap';
import Alpine from 'alpinejs';
import { marked } from 'marked';
window.Alpine = Alpine;

Alpine.start();


//chatbot
const chatbotBtn = document.getElementById('chatbot-btn');
const chatbotPopup = document.getElementById('chatbot-popup');
const closeChat = document.getElementById('close-chat');
const sendMessageBtn = document.getElementById('send-message');
const chatBox = document.getElementById('chat-box');
const userMessageInput = document.getElementById('user-message');

// Open the chatbot popup
chatbotBtn.addEventListener('click', function () {
    if (chatbotPopup.style.display === 'none' || chatbotPopup.style.display === '') {
        chatbotPopup.style.display = 'flex';
        if (chatBox.children.length === 0) {
            addMessage("Hello! How can I assist you today?", "bot");
        }
    } else {
        chatbotPopup.style.display = 'none';
    }
});


// Close the chatbot popup
closeChat.addEventListener('click', function () {
    chatbotPopup.style.display = 'none';
});

// Function to add a message to the chatbox
function addMessage(message, sender = 'user') {
    const messageDiv = document.createElement('div');
        messageDiv.classList.add(sender); // Add 'user' or 'bot' class

        if (sender === 'bot') {
            // Convert Markdown to HTML first
            let formattedMessage = marked.parse(message);
            // Convert new lines into <br> tags to maintain spacing
            formattedMessage = formattedMessage.replace(/\n/g, '<br>');
            // Convert Markdown-style links to actual HTML links
            message = message.replace(/\[([^\]]+)\]\(("([^"]+)"|'([^']+)')\)/g, '<a href=$2 target="_blank">$1</a>');
            messageDiv.innerHTML = formattedMessage;
        } else {
            messageDiv.textContent = message;
        }
        chatBox.appendChild(messageDiv);
        // Smoothly scroll just enough to show the start of the new message
        chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: "smooth" });
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
        const response = await fetch('chatbot-query', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ query: message }),
        });

        // Check if the response was successful
        if (!response.ok) {
            throw new Error('Failed to fetch response from server');
        }

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

import './career.js';
import './mbtiData.js';
