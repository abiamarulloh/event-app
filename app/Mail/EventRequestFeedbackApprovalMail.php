<?php

namespace App\Mail;

use App\Models\EventRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRequestFeedbackApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventRequestFeedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventRequestFeedback)
    {
        $this->eventRequestFeedback = $eventRequestFeedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.event_request_feedback_approval')
                    ->with('eventRequestFeedback', $this->eventRequestFeedback);
    }
}
