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

    /**
     * @var true
     */
    public bool $isMountRender = false;

    public function mount()
    {
        $this->isMountRender = true;
        $this->desiredBeginnings = DesiredBeginning::options();

        $this->desired_beginning = old('desired_beginning');
        $this->course_ids = old('course_ids', []);
        if ($this->desired_beginning) {
            $this->updatedDesiredBeginning($this->desired_beginning);
        }
    }

    public function updatedDesiredBeginning($year)
    {
        $this->courses = Course::query()
            ->active()
            ->where(fn ($q) => $q->where('first_start', '<=', Carbon::parse()->year($year))->orWhere('last_start', '>=', Carbon::parse()->year($year)))
            ->select('id', 'name', 'first_start', 'last_start', 'lead_time', 'dead_time')
            ->get()
            ->filter(function ($course) use ($year) {
                return CourseAvailability::make($course)
                    ->year(year: $year)
                    ->isAvailable();
            })->toArray();

        if (! $this->isMountRender) {
            $this->course_ids = [];
        } else {
            $this->isMountRender = false;
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}
