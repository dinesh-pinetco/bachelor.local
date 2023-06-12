<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractSent extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;

    public $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;

        $this->course = Course::where('id', $this->applicant->getEctsPointvalue('enroll_course'))->first();
    }

    public function build()
    {
        return $this->subject(__('Your contract is on the way').' | '.$this->course->name.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.contract-sent', [
                'name' => $this->applicant->full_name,
                'desiredBeginning' => $this->applicant->desiredBeginnings->course_start_date->format('Y-m-d'),
            ]);
    }
}
