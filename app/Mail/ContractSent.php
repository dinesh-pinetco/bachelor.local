<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractSent extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    public function build()
    {
        return $this->subject(__('Your contract is on the way').' | '.$this->applicant->courses()->with('course')->first()->course->name.' | NORDAKADEMIE')
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->markdown('emails.contract-sent', [
            'name' => $this->applicant->full_name,
            'course' => $this->applicant->courses()->with('course')->first()->course->name,
            'desiredBeginning' => $this->applicant->desiredBeginning->course_start_date->format('Y-m-d'),
        ]);
    }
}
