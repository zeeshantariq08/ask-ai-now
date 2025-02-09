<?php

namespace App\Filament\Widgets;

use App\Models\Faq as FAQ;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIAssistant extends Widget
{
    protected static string $view = 'filament.widgets.ai-assistant';

    public ?string $question = null;
    public ?string $answer = null;



    public function askAI()
    {
        if (!$this->question) {
            $this->answer = "Please enter a question.";
            return;
        }

        $faqs = FAQ::where('question', 'like', "%$this->question%")->get();

        $prompt = "";

        foreach ($faqs as $faq) {
            $prompt .= "{$faq->question}\n{$faq->answer}\n\n";
        }

        $prompt .= "{$this->question}";
        
        $apiKey = env('GEMINI_API_KEY');
        $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}";

        $response = Http::post($endpoint, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        $data = $response->json();
        Log::info('Gemini API Response:', $data);

        if ($response->failed()) {
            Log::error("Gemini API error: " . $response->body());
            $this->answer = "API error! Check logs.";
            return;
        }
        if (!empty($data['candidates'][0]['content']['parts'][0]['text'])) {
            $this->answer = trim($data['candidates'][0]['content']['parts'][0]['text']);
        } else {
            Log::warning('Unexpected API response structure', $data);
            $this->answer = "No response available.";
        }
    }


    protected function getViewData(): array
    {
        return [
            'question' => $this->question,
            'answer'   => $this->answer,
        ];
    }
}
