<?php

namespace App\Mail;

use App\Models\Tab;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmit extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $applicant;

    public $employee;

    public function __construct($applicant, $employee)
    {
        $this->applicant = $applicant;
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $url = route('employee.applicants.edit', ['slug' => Tab::value('slug'), 'applicant' => $this->applicant]);

        $courseName = $this->applicant->courses->first()->name;

        $name = $this->applicant->full_name;

        return $this->subject(__('Your application was submitted').' | '.$courseName.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.submit-application', compact('name', 'url', 'courseName'));
    }
}
