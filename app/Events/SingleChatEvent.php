<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SingleChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $message;
    public $username;
    public $user_id;
    public $to_id;

    public function __construct($user_id, $message, $to_id)
    {
        // Simpan pesan di database
        Chat::create([
            'user_id' => $user_id,
            'message' => $message,
            'to_id' => $to_id
        ]);

        $user = User::find($user_id);

        $this->message = $message;
        $this->username = $user?->name ?? 'Unknown';
        $this->user_id = $user_id;
        $this->to_id = $to_id;
    }

    public function broadcastOn(): Channel
    {
        // Broadcast ke kedua pengguna untuk memastikan keduanya menerima pembaruan
            return new Channel('our-chat');
    }

    public function broadcastAs(): string
    {
        return 'SingleChatEvent';
    }

    public function broadcastWith(): array
    {
        \Log::info('📡 Broadcasting SingleChatEvent', [
            'user_id' => $this->user_id,
            'to_id' => $this->to_id,
            'username' => $this->username,
            'message' => $this->message,
        ]);
    
        return [
            'message' => $this->message,
            'username' => $this->username,
            'user_id' => $this->user_id,
            'to_id' => $this->to_id,
            'timestamp' => now()->toIso8601String(),
        ];
    }
}