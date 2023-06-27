<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ApplicantEnrolled extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $applicant;

    protected $courseId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant, $courseId)
    {
        $this->applicant = $applicant;
        $this->courseId = $courseId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $courseName = Course::find($this->applicant->getValueByField('enroll_course')?->value);

        return $this->subject(__('Your contract has arrived').' | '.$courseName->name.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.applicant-enrolled', [
                'name' => $this->applicant->first_name,
                'studySheetUrl' => URL::signedRoute('study-sheet', ['user' => $this->applicant->id]),
                'governmentFormUrl' => URL::signedRoute('government-form', ['user' => $this->applicant->id]),
            ]);
    }
}
