<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generateResponse(Request $request)
    {
        $userQuestion = $request->input('question');

        // **Step 1: Retrieve relevant FAQs**
        $faqs = FAQ::where('question', 'like', "%$userQuestion%")->get();

        // **Step 2: Create the AI prompt**
        $prompt = "Use the following FAQs to answer the user's question:\n\n";
        foreach ($faqs as $faq) {
            $prompt .= "Q: {$faq->question}\nA: {$faq->answer}\n\n";
        }
        $prompt .= "User question: '$userQuestion'\nAnswer:";

        // **Step 3: Call Hugging Face API**
        $response = Http::post('https://api-inference.huggingface.co/models/facebook/blenderbot-400M-distill', [
            'inputs' => $prompt,
        ]);

        // **Step 4: Return AI-generated answer**
        return response()->json([
            'question' => $userQuestion,
            'answer' => $response->json()['generated_text'] ?? 'No response available',
        ]);
    }
}

