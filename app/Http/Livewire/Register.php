<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\DesiredBeginning;
use App\Services\CourseAvailability;
use Carbon\Carbon;
use Livewire\Component;

class Register extends Component
{
    public $courses = [];

    public $desiredBeginnings = [];

    public $course_ids = [];

    public $desired_beginning;

    public $courseStartDate = null;

    public $desiredBeginningId = null;

    public function mount()
    {
        $this->desiredBeginnings = DesiredBeginning::options(onlyFuture: true);

        $this->desired_beginning = old('desired_beginning');
        if ($this->desired_beginning) {
            $this->updatedDesiredBeginning($this->desired_beginning);
        }
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

        $this->course_ids = [];
    }

    public function render()
    {
        return view('livewire.register');
    }
}
