<?php

namespace App\Filament\Widgets;

use App\Models\Faq as FAQ;
use App\Services\ChatMemoryService;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIAssistant extends Widget
{
    protected static string $view = 'filament.widgets.ai-assistant';

    public ?string $question = null;
    public ?string $answer = null;
    public array $chatHistory = [];
    protected ChatMemoryService $chatMemoryService; // Declare the property

    public function __construct()
    {
        $this->chatMemoryService = new ChatMemoryService(); // ✅ Initialize property
        $this->loadChatHistory();
    }

    public function loadChatHistory()
    {
        $this->chatHistory = $this->chatMemoryService->getChatHistory();
    }

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

        $this->chatMemoryService->storeMessage($this->question, $this->answer);

        $this->loadChatHistory();
        $this->question = "";
    }

    public function clearChat()
    {
        $this->chatMemoryService->clearChatHistory();
        $this->chatHistory = [];
    }

    protected function getViewData(): array
    {
        return [
            'question' => $this->question,
            'answer'   => $this->answer,
            'chatHistory' => $this->chatHistory,
        ];
    }


}
