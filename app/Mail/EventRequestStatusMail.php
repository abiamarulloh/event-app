<?php

namespace App\Mail;

use App\Models\EventRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventRequestStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EventRequest $eventRequestStatus)
    {
        $this->eventRequestStatus = $eventRequestStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.event_request_status')
                    ->with('eventRequestStatus', $this->eventRequestStatus);
    }
}
