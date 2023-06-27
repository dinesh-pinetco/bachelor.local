<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\User;
use App\Services\Companies\GetCourse;
use App\Services\Companies\GetCourseFiles;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractPdfSend extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $courseId = $this->user->getValueByField('enroll_course');

       // Get applicant->enroll course sanna id
        // Applicant desired beginning

        $courseMaterialObject = (new GetCourse())->get($courseSannaId, $desiredBeginningDate);
        $courseMaterialFiles = data_get($courseMaterialObject, 'anhaenge');

        $this->subject(__('Contract PDF') . '| NORDAKADEMIE')
            ->markdown('emails.contract-pdf', [
                'name' => $this->user->full_name,
                'applicant_id' => $this->user->id,
            ])
            ->attach(storage_path('app/' . $this->user->configuration->contract_pdf_path))
            ->attach(storage_path('app/' . $this->user->configuration->study_contract_pdf_path));

        if ($courseMaterialFiles) {
            foreach ($courseMaterialFiles as $courseMaterialFile) {
                $file = (new GetCourseFiles())->getFile(data_get($courseMaterialFile, '@id'));
                $this->attachData(base64_decode(data_get($file, 'file')), data_get($courseMaterialFile, 'name') . '.pdf', ['mime' => 'application/pdf']);
            }
        }

        return $this;
    }
}
