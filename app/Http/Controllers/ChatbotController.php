<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
{
    // Define the URL
    $url = 'https://ai-23096183aibrighterus800207146867.openai.azure.com/openai/deployments/text-davinci-003/completions?api-version=2023-03-15-preview';

    // Define your API key
    $apiKey = 'C3Uf9eG71t3YJ6RuUBMRMDewPAsV2HakZFTLVvg6xpeMJs7TxYnmJQQJ99BAACYeBjFXJ3w3AAAAACOGJ9Ec'; // Replace with your actual API key

    // Check if the URL or API key is null or invalid
    if ($url === null || $apiKey === null) {
        // Handle the error (e.g., return a response or throw an exception)
        return response()->json(['error' => 'URL or API key not set'], 500);
    }

    // Proceed with the API request if the URL and API key are valid
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'prompt' => 'What is the capital of France?',
            'max_tokens' => 50,
            'temperature' => 0.7,
        ]);

        // Handle the response
        return response()->json($response->json());
    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
    }
}



    
}
