<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class OpenAIController extends Controller
{
    public function getChatResponse(Request $request)
    {
        // Validate the user input
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $message = $validated['message'];

        // Path to the Python script
        $pythonScript = base_path('resources/python/openai_chat.py');

        // Execute the Python script
        $process = new Process(['python', $pythonScript, $message]);
        $process->run();

        // Check if the process was successful
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Get the output from the Python script
        $response = $process->getOutput();

        // Return the response
        return response()->json([
            'response' => json_decode($response, true),
        ]);
    }
}
