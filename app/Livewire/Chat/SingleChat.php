<?php
namespace App\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\SingleChatEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // tambahkan ini di atas


class SingleChat extends Component
{
    public $user_id;
    public $to_id;
    public $message = '';
    public $conversations = [];

    public function mount($id)
    {
        $this->to_id = $id;
        $this->loadConversation();
    }

    private function loadConversation()
    {
        $chats = Chat::with('user')
            ->where(function ($query) {
                $query->where('user_id', $this->user_id)
                      ->where('to_id', $this->to_id);
            })->orWhere(function ($query) {
                $query->where('user_id', $this->to_id)
                      ->where('to_id', $this->user_id);
            })->orderBy('created_at')->get();

        $this->conversations = [];
        foreach($chats as $msg){
            $this->conversations[] = [
                'username' => $msg->user->name,
                'message' => $msg->message,
            ];
        }
    }

    public function submit()
    {
        if (trim($this->message) === '') return;
        $this->user_id = Auth::user()->id;
        SingleChatEvent::dispatch($this->user_id, $this->message, $this->to_id);

        // Memanggil loadConversation agar data selaras dengan database 
        // (tidak perlu menambahkan pesan secara manual karena sudah disimpan di event)
        $this->loadConversation();
        $this->message = '';
    }

    //error disini gamau jalan
    #[On('echo:our-chat,SingleChatEvent')]
    public function handleIncomingMessage($event)
    {
        Log::info('✅ Event diterima di Livewire', $event);
    
        $this->loadConversation();
    }

    public function render()
    {
        return view('livewire.chat.single-chat');
    }
}