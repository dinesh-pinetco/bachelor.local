<?php

namespace App\Pdf;

use App\Models\Course;
use App\Models\User;
use Rjchauhan\LaravelFiner\Pdf\Pdf;

class StudyContractPdf extends Pdf
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function data()
    {
        return [
            'user' => $this->user,
            'desiredBeginning' => $this->user->desiredBeginning->course_start_date,
            'street_no' => $this->user->study_sheet?->street,
            'zip' => $this->user->study_sheet?->zip,
            'city' => $this->user->study_sheet?->place,
            'course' => Course::where('id', $this->user->getValueByField('enroll_course')->value)->first()?->name,
        ];
    }
}
