<?php

namespace App\Services;

use App\Models\ChatHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatMemoryService
{
    protected $cacheKey;

    public function __construct()
    {
        $this->cacheKey = 'chat_history_' . (Auth::id() ?? session()->getId());
    }

    public function storeMessage($message, $response)
    {
        $chatHistory = Cache::get($this->cacheKey, []);

        $chatHistory[] = [
            'user' => $message,
            'ai' => $response,
            'timestamp' => now()->timestamp
        ];

        $chatHistory = array_slice($chatHistory, -10);
        Cache::put($this->cacheKey, $chatHistory, now()->addMinutes(30));

        ChatHistory::create([
            'user_id' => Auth::id(),
            'session_id' => session()->getId(),
            'user_message' => $message,
            'ai_response' => $response
        ]);
    }

    public function getChatHistory()
    {
        $chatHistory = Cache::get($this->cacheKey);

        if (!$chatHistory) {
            $chatHistory = ChatHistory::where('user_id', Auth::id())
                ->orWhere('session_id', session()->getId())
                ->latest()
                ->take(10)
                ->get(['user_message as user', 'ai_response as ai'])
                ->toArray();

            Cache::put($this->cacheKey, $chatHistory, now()->addMinutes(30));
        }

        return $chatHistory;
    }

    public function clearChatHistory()
    {
        Cache::forget($this->cacheKey);

        ChatHistory::where('user_id', Auth::id())
            ->orWhere('session_id', session()->getId())
            ->delete();
    }
}
