<x-filament-widgets::widget>
    <x-filament::card>
        <!-- 🎯 Title -->
        <h2 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
            <span>🤖 AI FAQ Assistant</span>
            <span wire:loading class="animate-pulse text-blue-500">💭</span>
        </h2>

        <!-- 🎤 Question Input -->
        <div class="mt-4">
            <label for="question" class="block text-sm font-medium text-gray-700">Ask a Question:</label>
            <div class="flex items-center space-x-2">
                <input type="text" wire:model.defer="question" id="question"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Type your question here..."
                       wire:keydown.enter="askAI"/>

                <button wire:click="askAI"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    🚀 Ask
                </button>
            </div>
        </div>

        <!-- ⏳ Loading Spinner -->
        <div wire:loading class="mt-2 text-blue-500 flex items-center space-x-1">
            <span class="animate-spin">🔄</span>
            <span>Thinking...</span>
        </div>

        <!-- 📜 AI Answer Output -->
        @if ($answer)
            <div class="mt-4 p-4 bg-gray-100 border rounded-md">
                <strong>📢 Answer:</strong>
                <p class="mt-2">{{ $answer }}</p>
            </div>
        @endif

        <!-- 📜 Chat History -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold flex justify-between">
                <span>📜 Chat History</span>
                @if ($chatHistory)
                    <button wire:click="clearChat"
                            class="text-red-600 text-sm hover:underline">
                        🗑️ Clear History
                    </button>
                @endif
            </h3>

            <div class="mt-2 max-h-64 overflow-y-auto border p-3 bg-gray-50 rounded">
                @forelse ($chatHistory as $chat)
                    <div class="border-b pb-2 mb-2">
                        <p class="text-gray-700"><strong>Q:</strong> {{ $chat['user'] }}</p>
                        <p class="text-gray-800"><strong>A:</strong> {{ $chat['ai'] }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 italic">No chat history available.</p>
                @endforelse
            </div>
        </div>
    </x-filament::card>
</x-filament-widgets::widget>
