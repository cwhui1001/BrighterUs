<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Storage;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
    {
        $userQuery = $request->input('query');
        if (empty($userQuery)) {
            return response()->json(['error' => 'Query is empty'], 400);
        }

        // Load and parse PDF files
        $parser = new Parser();
        $pdfs = [
            'B1_Platform_Support_Matrix.pdf',
            'B1_HANA_Platform_Support_Matrix.pdf',
            'B1_Hardware_Requirements_Guide.pdf',
        ];

        $combinedChunks = [];
        foreach ($pdfs as $pdf) {
            $path = storage_path("app/public/{$pdf}");
            if (!file_exists($path)) continue;
        
            $text = $parser->parseFile($path)->getText();
            $chunks = $this->splitText($text);
            foreach ($chunks as $chunk) {
                $combinedChunks[] = [
                    'text' => $chunk,
                    'source' => $pdf
                ];
            }
        }
        

        // (Simple Matching) Select relevant chunks for user query
        $relevantChunks = $this->getRelevantChunks($combinedChunks, $userQuery);

        // Build prompt with SAP B1 context + extracted PDF info
        $prompt = [
            ["text" => "You are an expert SAP B1 System Consultant in Fast Track SBOi, working with businesses to streamline operations using SAP Business One.\n\nHere is some SAP documentation that might be helpful: \n\n Point to the documentation after answering, either 'B1_Platform_Support_Matrix.pdf',
            'B1_HANA_Platform_Support_Matrix.pdf', or
            'B1_Hardware_Requirements_Guide.pdf'\n\n" . implode("\n\n", array_map(function ($chunkData) {
                $link = url("storage/{$chunkData['source']}");
                return $chunkData['text'] . "\n\nView Source: <a href=\"$link\" target=\"_blank\">$chunkData[source]</a>";
            }, $relevantChunks))
        ],
        
            ["text" => "Now answer the following query in a clear and structured manner:\n" . $userQuery],
        ];

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
        $apiKey = env('GEMINI_API_KEY');

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url . '?key=' . $apiKey, [
                'contents' => [ [ 'parts' => $prompt ] ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $botResponse = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response generated.';
                return response()->json(['response' => $botResponse]);
            } else {
                return response()->json(['error' => 'API error', 'details' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Request failed', 'message' => $e->getMessage()], 500);
        }
    }

    private function splitText($text, $maxWords = 150)
    {
        $words = preg_split('/\s+/', $text);
        $chunks = array_chunk($words, $maxWords);
        return array_map(fn($chunk) => implode(' ', $chunk), $chunks);
    }

    private function getRelevantChunks($chunks, $query)
    {
        $matches = [];
        foreach ($chunks as $chunkData) {
            $chunkText = $chunkData['text'];
            similar_text(strtolower($chunkText), strtolower($query), $percent);
            if ($percent > 5) {
                $matches[] = $chunkData;
            }
        }
        return array_slice($matches, 0, 3);
    }

    public function downloadSAPDocs()
    {
        $pdfLinks = [
            'B1_HANA_Platform_Support_Matrix.pdf' => 'https://help.sap.com/doc/011000358700000239412011e/9.3/en-US/B1_HANA_Platform_Support_Matrix.pdf',
            'B1_Platform_Support_Matrix.pdf' => 'https://help.sap.com/doc/011000358700000032462013e/9.3/en-US/B1_Platform_Support_Matrix.pdf',
            'B1_Hardware_Requirements_Guide.pdf' => 'https://help.sap.com/doc/bfa9770d12284cce8509956dcd4c5fcb/9.3/en-US/B1_Hardware_Requirements_Guide.pdf',
        ];

        foreach ($pdfLinks as $filename => $url) {
            try {
                $response = Http::get($url);
                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());
                } else {
                    return response()->json(['error' => "Failed to download $filename"]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => "Download failed for $filename", 'message' => $e->getMessage()]);
            }
        }

        return response()->json(['message' => 'All PDFs downloaded successfully.']);
    }


}

