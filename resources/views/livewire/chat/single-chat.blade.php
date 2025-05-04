<div class="max-w-xl mx-auto mt-6 p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Chat with {{ \App\Models\User::find($to_id)?->name ?? 'Unknown User' }}</h2>

    <div class="h-96 overflow-y-auto border rounded-lg p-4 space-y-2 bg-gray-50">
        @foreach ($conversations as $chat)
            <div class="@if($chat['username'] === auth()->user()->name) text-right @endif">
                <div class="inline-block px-3 py-2 rounded-lg 
                    @if($chat['username'] === auth()->user()->name) bg-blue-500 text-white 
                    @else bg-gray-200 text-gray-800 @endif">
                    <span class="block text-sm font-semibold">{{ $chat['username'] }}</span>
                    <span class="block">{{ $chat['message'] }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="submit" class="mt-4 flex gap-2">
        <input type="text" wire:model="message" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Type a message..." />
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Send</button>
    </form>
</div>