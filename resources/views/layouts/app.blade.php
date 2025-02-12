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

    </body>
</html>

