<?php

namespace App\Listeners;

use App\Events\SendEmailEventRequest;
use App\Mail\EventRequestApprovalMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailEventRequestListener implements ShouldQueue
{
    use InteractsWithQueue;
    public $tries = 3; 

    public function handle(SendEmailEventRequest $event)
    {
        Log::info('SendEmailEventRequest started with details: ', ['eventRequest' => $event]);
        try {
            Mail::to($event->email)->send(new EventRequestApprovalMail($event->eventRequest));
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

