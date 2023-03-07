<?php

namespace App\Pdf;

use App\Models\Course;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\User;
use Rjchauhan\LaravelFiner\Pdf\Pdf;

class ManagementSheetPdf extends Pdf
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function data()
    {
        $enrollCourseId = Field::where('label', 'Enroll Course')->first()?->id;

        $applicantCourse = FieldValue::where('field_id', $enrollCourseId)
            ->where('user_id', $this->user->id)
            ->first()?->value;

        return [
            'user' => $this->user,
            'course' => Course::where('id', $applicantCourse)->first()?->name,
            'desiredBeginning' => $this->user->desiredBeginning->course_start_date->format('d.m.Y'),
            'date_of_birth' => date_create_from_format('Y-m-d', $this->user->values->where('fields.key', 'date_of_birth')->value('value'))->format('d.m.Y'),
            'profilePhoto' => $this->user->study_sheet?->studentIdCardPhotoUrl,
            'phone' => $this->user->study_sheet?->phone,
        ];
    }
}