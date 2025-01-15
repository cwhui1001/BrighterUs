<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];

use GuzzleHttp\Client;

class AzureChatbotService
{
    protected $client;
    protected $endpoint;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->endpoint = env('AZURE_OPENAI_ENDPOINT'); // Add endpoint to .env
        $this->apiKey = env('AZURE_OPENAI_API_KEY'); // Add API Key to .env
    }

    public function sendMessage($message)
    {
        $response = $this->client->post($this->endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 150,
                'temperature' => 0.7,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
