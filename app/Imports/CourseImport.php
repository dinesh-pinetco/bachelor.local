<?php

namespace App\Imports;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel, WithHeadingRow
{
    public Collection $desiredBeginnings;

    public function __construct(Collection $desiredBeginnings)
    {
        $this->desiredBeginnings = $desiredBeginnings;
    }

    public function model(array $row): Course
    {
        $course = new Course([
            'name'          => $row['name'],
            'sana_id'       => $row['sana_id'],
            'form_of_study' => $row['studienform'],
            'description'   => $row['description'],
            'first_start'   => Carbon::parse($row['first_start'])->format('Y-m-d'),
            'lead_time'     => $row['lead_time'],
            'dead_time'     => $row['dead_time'],
            'is_active'     => true,
        ]);

        $course->save();
        $course->desired_beginnings()->sync($this->desiredBeginnings);

        return $course;
    }
}
