<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Services\DesiredBeginningFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;

class Register extends Component
{
    public Collection $courses;

    public SupportCollection $desiredBeginnings;

    public $courseId;

    public $desiredBeginning;

    public $courseStartDate = null;

    public $desiredBeginningId = null;

    public function mount()
    {
        $this->desiredBeginnings = collect();
        $this->courses = Course::active()
            ->where(fn ($q) => $q->whereNull('last_start')->orWhere('last_start', '>', today()))
            ->get()
            ->filter(function ($course) {
                $filteredDesiredBeginning = $this->getDesiredBeginningFilter($course);
                if ($filteredDesiredBeginning->count()) {
                    return true;
                } else {
                    return false;
                }
            });

        if (old('course_id')) {
            $this->courseId = old('course_id');
            $this->desiredBeginnings = $this->getDesiredBeginningFilter(Course::find($this->courseId));
        }
    }

    public function updated($value)
    {
        // If desired beginning change
        if ($value == 'desiredBeginning' && $this->desiredBeginning != null) {
            $selectedCourse = $this->courses->where('id', $this->courseId)->first();
            $this->desiredBeginnings = $this->getDesiredBeginningFilter($selectedCourse);
            $data = $this->desiredBeginnings[$this->desiredBeginning];
            $month = $data->id == 1 ? 'April' : 'October';
            $this->courseStartDate = (new Carbon('first day of '.$month.' '.$data->date->format('Y')))->toDateString();
            $this->desiredBeginningId = $data->id;
        }

        // If desired beginning change
        if ($this->courseId) {
            $selectedCourse = $this->courses->where('id', $this->courseId)->first();
            $this->desiredBeginnings = $this->getDesiredBeginningFilter($selectedCourse);
        } else {
            $this->desiredBeginnings = collect();
            $this->courseStartDate = null;
            $this->desiredBeginningId = null;
        }
    }

    private function getDesiredBeginningFilter($course)
    {
        return (new DesiredBeginningFilter($course))->filter();
    }

    public function render()
    {
        return view('livewire.register');
    }
}
