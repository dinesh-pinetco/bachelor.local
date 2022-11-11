<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ContractReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->subject(__('Your contract has arrived').' | '.$this->applicant->courses->first()->name.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.contract-received', [
                'name' => $this->applicant->full_name,
                'studySheetUrl' => URL::signedRoute('study-sheet', ['user' => $this->applicant->id]),
                'governmentFormUrl' => URL::signedRoute('government-form', ['user' => $this->applicant->id]),
            ]);
    }
}
