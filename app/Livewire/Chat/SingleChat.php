<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\SingleChatEvent;
use Illuminate\Support\Facades\Auth;

class SingleChat extends Component
{
    public $user_id;
    public $to_id;
    public $message;
    public $chats = [];
    public $conversations = [];

    public function mount($id)
    {
        $this->to_id = $id;
        $this->user_id = Auth::id();
        $chats = Chat::with('user')->where(function ($query) {
            $query->where('user_id', $this->user_id)
                  ->where('to_id', $this->to_id);
        })->orWhere(function ($query) {
            $query->where('user_id', $this->to_id)
                  ->where('to_id', $this->user_id);
        })->orderBy('created_at')->get();

        foreach($chats as $msg){
            $this->conversations[] = [
                'username' => $msg->user->name,
                'message' => $msg->message
            ];
        }
    }

    public function submit()
    {
        if(empty($this->message)) {
            return;
        }
        
        // Get the username for the sender
        $user = User::find($this->user_id);
        $username = $user ? $user->name : 'Unknown User';
        
        // Add the message to the local conversations
        $this->conversations[] = [
            'username' => $username,
            'message' => $this->message
        ];
        
        // Dispatch the event
        SingleChatEvent::dispatch($this->user_id, $this->message, $this->to_id);
        
        // Reset message
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.chat.single-chat');
    }

    // Make sure this matches the broadcast channel and event name exactly
    #[On('our-chat.SingleChatEvent')]
    public function listenForMessage($event)
    {
        // Debug received event
        logger()->info('Received chat event', ['event' => $event]);
        
        // Only add the message if it's not from the current user (to avoid duplicates)
        if (isset($event['user_id']) && $event['user_id'] != $this->user_id) {
            $this->conversations[] = [
                'username' => $event['username'] ?? 'Unknown',
                'message' => $event['message'] ?? '',
            ];
        }
    }
}