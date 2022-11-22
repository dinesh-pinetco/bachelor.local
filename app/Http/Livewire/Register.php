<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\DesiredBeginning;
use App\Services\CourseAvailability;
use App\Services\DesiredBeginningFilter;
use Carbon\Carbon;
use Livewire\Component;

class Register extends Component
{
    public $courses = [];

    public $desiredBeginnings = [];

    public $course_ids = [];

    public $desiredBeginning;

    public $courseStartDate = null;

    public $desiredBeginningId = null;

    public function mount()
    {
        $this->desiredBeginnings = DesiredBeginning::options(onlyFuture: true);
    }

    public function updatedDesiredBeginning($year)
    {
        $this->courses = Course::query()
            ->active()
            ->where(fn ($q) => $q->whereNull('last_start')->orWhere('last_start', '>', Carbon::parse()->year($year)))
            ->select('id', 'name', 'first_start', 'last_start', 'lead_time', 'dead_time')
            ->get()
            ->filter(function ($course) use ($year) {
                return CourseAvailability::make($course)
                    ->year(year: $year)
                    ->isAvailable();
            })->toArray();
    }
//    public function updated($value)
//    {
//        // If desired beginning change
//        if ($value == 'desiredBeginning' && $this->desiredBeginning != null) {
//            $selectedCourse = $this->courses->where('id', $this->courseId)->first();
//            $this->desiredBeginnings = $this->getDesiredBeginningFilter($selectedCourse);
//            $data = $this->desiredBeginnings[$this->desiredBeginning];
//            $month = convertNumberToMonth($data->month);
//            $this->courseStartDate = (new Carbon('first day of '.$month.' '.$data->date->format('Y')))->toDateString();
//            $this->desiredBeginningId = $data->id;
//        }
//
//        // If desired beginning change
//        if ($this->courseId) {
//            $selectedCourse = $this->courses->where('id', $this->courseId)->first();
//            $this->desiredBeginnings = $this->getDesiredBeginningFilter($selectedCourse);
//        } else {
//            $this->desiredBeginnings = collect();
//            $this->courseStartDate = null;
//            $this->desiredBeginningId = null;
//        }
//    }

    private function getDesiredBeginningFilter($course)
    {
        return (new DesiredBeginningFilter($course))->filter();
    }

    public function render()
    {
        return view('livewire.register');
    }
}
