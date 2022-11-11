<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractSent extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;

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
        return $this->subject(__('Your contract is on the way').' | '.$this->applicant->courses->first()->name.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.contract-sent', [
                'name' => $this->applicant->full_name,
                'course' => $this->applicant->courses->first()->name,
                'desiredBeginning' => $this->applicant->course->first()->desired_beginning_id == 1 ? __('Summer semester') : __('Winter semester'),
            ]);
    }
}
