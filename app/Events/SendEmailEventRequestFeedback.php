<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SendEmailEventRequestFeedback
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventRequestFeedback, $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($eventRequestFeedback, $email)
    {
        $this->eventRequestFeedback = $eventRequestFeedback;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
