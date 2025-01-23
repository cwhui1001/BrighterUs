<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
    {
        // Define the URL
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

        // Define your API key
        $apiKey = 'AIzaSyDMnePLV-ZPAGPrmBDUpuQ_c3PvfgpQ7zY'; 

        // Get the user query from the request
        $userQuery = $request->input('query');
        // Check if the query is not empty
        if (empty($userQuery)) {
            return response()->json(['error' => 'Query is empty'], 400);
        }
        try {
            // Make the API request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url . '?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $userQuery],
                        ]
                    ]
                ]
            ]);

            // Check if the API response is successful
            if ($response->successful()) {
                // Get the chatbot's response
                $data = $response->json();
                $botResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I didn\'t get that.';

                return response()->json(['response' => $botResponse]);
            } else {
                return response()->json(['error' => 'Error from API', 'message' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network issues, API errors)
            return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
        }
    }
    
}

