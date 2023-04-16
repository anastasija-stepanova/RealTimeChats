<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreated implements ShouldBroadcast
{
    public function __construct(public Message $message)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('messages');
    }
}
