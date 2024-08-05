<?php

namespace App\Listeners;

use App\Events\SendEmailEventRequestFeedback;
use App\Mail\EventRequestFeedbackApprovalMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailEventRequestFeedbackListener implements ShouldQueue
{
    use InteractsWithQueue;
    public $tries = 3; 

    public function handle(SendEmailEventRequestFeedback $event)
    {
        Log::info('SendEmailEventRequestFeedback started with details: ', ['eventRequestFeedback' => $event]);
        
        try {
            Mail::to($event->email)->send(new EventRequestFeedbackApprovalMail($event->eventRequestFeedback));
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            if ($this->attempts() > 3) {
                // Menandai job sebagai gagal setelah 3 percobaan
                return $this->fail($e);
            }
            $this->release(60); // Ulangi setelah 60 detik
        }
    }
}

