<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use Livewire\Component;
use App\Events\SingleChatEvent;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Event\MessageEvent;

class SingleChat extends Component
{
    public $user_id;
    public $to_id;
    public $message;
    public $chats = [];

    public function mount($id)
    {
        $this->to_id = $id;
        $this->user_id = Auth::id();
    }

    public function submit()
    {
        if(empty($this->message)) {
            return;
        }
        SingleChatEvent::dispatch($this->user_id, $this->message, $this->to_id);
        $this->message = '';
    }

    public function render()
    {
        $chats = Chat::with('user')->where(function ($query) {
            $query->where('user_id', $this->user_id)
                  ->where('to_id', $this->to_id);
        })->orWhere(function ($query) {
            $query->where('user_id', $this->to_id)
                  ->where('to_id', $this->user_id);
        })->orderBy('created_at')->get();
    
        
        dd($chats);
        return view('livewire.chat.single-chat');
    }
}
