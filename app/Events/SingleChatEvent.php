<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SingleChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $username;
    public $user_id;
    public $to_id;

    public function __construct($user_id, $message, $to_id)
    {   
        // Save the chat to database
        Chat::create([
            'user_id' => $user_id,
            'message' => $message,
            'to_id' => $to_id
        ]);

        // Get the username for the sender
        $user = User::find($user_id);
        
        $this->message = $message;
        $this->username = $user ? $user->name : 'Unknown User';
        $this->user_id = $user_id;
        $this->to_id = $to_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('our-chat');
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'SingleChatEvent';
    }
    
    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'username' => $this->username,
            'user_id' => $this->user_id,
            'to_id' => $this->to_id,
            'timestamp' => now()->toIso8601String(),
        ];
    }
}