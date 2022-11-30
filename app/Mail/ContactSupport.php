<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSupport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $message;

    public $applicant;

    public function __construct($message)
    {
        $this->message = $message;
        $this->applicant = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->subject('Support Kontakt')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.contact-support-mail', [
                'name' => $this->applicant->full_name,
                'email' => $this->applicant->email,
            ]);
    }
}
