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
                       wire:keydown.enter="askAI" />  <!-- ✅ Livewire listens for Enter -->
            </div>
        </div>

        <!-- ⏳ Fancy Loading Spinner -->
        <div wire:loading class="mt-2 text-blue-500 flex items-center space-x-1">
            <span class="animate-spin">🔄</span>
            <span>Thinking...</span>
        </div>

        <!-- 📜 AI Answer Output -->
        @if ($answer)
            <div class="mt-4 p-4 bg-gray-100 border rounded-md max-h-60 overflow-auto relative">
                <strong>📢 Answer:</strong>
                <p class="mt-2">{{ $answer }}</p>
            </div>
        @endif
    </x-filament::card>
</x-filament-widgets::widget>
