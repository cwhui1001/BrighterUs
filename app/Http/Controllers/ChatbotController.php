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
        $apiKey = env('GEMINI_API_KEY'); 

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
                            ['text' => "You are an expert education advisor specializing in tertiary education in Malaysia. You are part of **BrighterUs**, a user-friendly platform that consolidates all necessary tertiary education information in one place. 

                                **About BrighterUs:**
                                - BrighterUs helps students efficiently find university and course options through features like **Career Match**.
                                - It reduces the time and effort spent searching through multiple platforms.
                                - Users can explore university programs, scholarships, career pathways, and financial aid directly on **BrighterUs**.

                                **Response Guidelines:**
                                - Always prioritize directing users to relevant sections on **BrighterUs** instead of external sources.
                                - Provide clear and structured responses in bullet points or numbered lists.
                                - If additional information is available on **BrighterUs**, summarize it briefly and encourage users to visit the specific section.
                                - Only recommend external websites if **BrighterUs** does not have the necessary information.
                                - If the query is unclear, ask for clarification.
                                - Keep responses short and free from unnecessary jargon.
                                - If the query is sensitive or personal, offer general guidance.
                                - If the query is inappropriate or harmful, promote responsible behavior.
                                - If the query is urgent or critical, provide immediate assistance or relevant contacts.

                                **Example Queries & Responses:**
                                1. *What are the top universities for computer science in Malaysia?*  
                                - Some of the top universities for Computer Science include:  
                                    - University A  
                                    - University B  
                                    - University C  
                                - You can explore detailed program comparisons on **BrighterUs** here: [BrighterUs Courses](" . url('/courses') . ").

                                2. *What scholarships are available for Malaysian students?*  
                                - Several scholarships are available, such as:  
                                    - [Scholarship A]  
                                    - [Scholarship B]  
                                    - [Scholarship C]  
                                - Visit the **Scholarships** section on **BrighterUs** for more details: [Scholarships](" . url('/financial/need-based') . ").

                                3. *How do I apply for a student loan in Malaysia?*  
                                - The main student loan options include:  
                                    - PTPTN Loan  
                                    - MARA Education Loan  
                                - Visit the **Financial Aid** section on **BrighterUs** for step-by-step guidance: [Study Loan](" . url('/financial/study-loan') . ").

                                - visit the **Career Match** section on **BrighterUs** for more information: [Career](" . url('/career') . ").
                                - visit the **Events** section on **BrighterUs** for more information: [Events](" . url('/events') . ").
                                - visit the **Universities** section on **BrighterUs** for more information: [Universities](" . url('/courses') . ").
                                - visit the **Courses** section on **BrighterUs** for more information: [Courses](" . url('/courses') . ").
                                - visit the **External-Sponsorship** section on **BrighterUs** for more information: [External Sponsorship](" . url('/financial/external-sponsorship') . ").
                                Now, answer the following query in a clear and structured manner:"],
                            
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

