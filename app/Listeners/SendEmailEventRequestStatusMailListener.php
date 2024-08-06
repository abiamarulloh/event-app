<?php

namespace App\Listeners;

use App\Events\SendEmailEventRequestStatusMail;
use App\Mail\EventRequestStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailEventRequestStatusMailListener implements ShouldQueue
{
    use InteractsWithQueue;
    public $tries = 3; 

    public function handle(SendEmailEventRequestStatusMail $event)
    {
        Log::info('SendEmailEventRequestStatusMail started with details: ', ['eventRequestStatusMail' => $event]);
        try {
            Mail::to($event->email)->send(new EventRequestStatusMail($event->eventRequestStatusMail));
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

