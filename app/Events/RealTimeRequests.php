<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RealTimeRequests implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public string $message;
    public string $receiver;
    public string $requester;
    public string $avatar;

    public function __construct(string $message,string $receiver,string $requester,string $avatar)
    {
        $this->message=$message;
        $this->receiver=$receiver;
        $this->requester=$requester;
        $this->avatar=$avatar;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn():Channel
    {
        return new PrivateChannel('requests.'.$this->receiver);
    }
}
