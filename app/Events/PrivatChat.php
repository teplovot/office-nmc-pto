<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivatChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $fromId;
    public $fromLastName;
    public $to;
    public $message;

    public function __construct($fromId, $fromLastName, $to, $message)
    {
        $this->fromId = $fromId;                // Id відправника
        $this->fromLastName = $fromLastName;    // Прізвище відправника
        $this->to = $to;                        // id отримувача
        $this->message = $message;              // Зміст сповіщення
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private-messages.' . $this->to),
            new PrivateChannel('private-messages.' . $this->fromId), // канал відправника
        ];
    }
}
