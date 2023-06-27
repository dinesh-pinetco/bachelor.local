<?php

namespace App\Mail;

use App\Models\Course;
use App\Services\Companies\GetCourse;
use App\Services\Companies\GetCourseFiles;
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
        $course = Course::find($this->courseId);
        $courseMaterialObject = (new GetCourse())->get($course);
        $courseMaterialFiles = data_get($courseMaterialObject, 'anhaenge');

        $this->subject(__('Your contract has arrived').' | '.$course->name.' | NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.applicant-enrolled', [
                'name' => $this->applicant->first_name,
                'studySheetUrl' => URL::signedRoute('study-sheet', ['user' => $this->applicant->id]),
                'governmentFormUrl' => URL::signedRoute('government-form', ['user' => $this->applicant->id]),
            ]);

        if ($courseMaterialFiles) {
            foreach ($courseMaterialFiles as $courseMaterialFile) {
                $file = (new GetCourseFiles())->getFile(data_get($courseMaterialFile, '@id'));
                $this->attachData(base64_decode(data_get($file, 'file')), data_get($courseMaterialFile, 'name').'.pdf', ['mime' => 'application/pdf']);
            }
        }

        return $this;
    }
}
