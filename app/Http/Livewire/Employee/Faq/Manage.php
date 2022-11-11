<?php

namespace App\Http\Livewire\Employee\Faq;

use App\Models\Course;
use App\Models\Faq;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    public Faq $faq;

    public string $formMode = 'create';

    public $search;

    public array $selectedCourses = [];

    public $courses;

    public $selectedCoursesSummery;

    protected array $rules = [
        'faq.name'     => ['required'],
        'faq.question' => ['required'],
        'faq.answer'   => ['required'],
    ];

    public function mount(Faq $faq)
    {
        if ($faq->exists) {
            $this->formMode = 'edit';
        }

        $this->faq = $faq;
        $this->faq->courses->each(function ($course) {
            $this->selectedCourses[$course->id] = $course->id;
        });
    }

    public function submit()
    {
        $this->validate();

        $this->save();
    }

    private function save(): void
    {
        $this->faq->save();

        $this->syncCourse($this->faq);

        session()->flash('banner', __('Faq created successfully!'));

        redirect()->route('employee.faq.index');
    }

    private function syncCourse($faq)
    {
        $faq->auditEvent = $this->formMode == 'edit' ? 'updated' : $this->formMode;
        $faq->isCustomEvent = true;

        $isDirtyCourse = false;

        if (! $faq->courses->pluck('id')->diff($this->selectedCourses)->isEmpty() || ! collect($this->selectedCourses)->diff($faq->courses->pluck('id'))->isEmpty()) {
            $isDirtyCourse = true;
            $faq->auditCustomOld['course'] = $faq->courses->pluck('name')->implode(', ');
        }

        $faq->courses()->sync($this->selectedCourses);

        $faq->load('courses');

        if ($isDirtyCourse) {
            $faq->auditCustomNew['course'] = $faq->courses->pluck('name')->implode(', ');
        }

        if ($isDirtyCourse) {
            Event::dispatch(AuditCustom::class, [$faq]);
        }
    }

    public function updatedSelectedCourses()
    {
        $this->selectedCourses = Arr::where($this->selectedCourses, function ($value) {
            return $value !== false;
        });

        $this->syncSelectedOptions();
    }

    public function syncSelectedOptions()
    {
        if ($this->courses && $this->selectedCourses) {
            $this->selectedCoursesSummery = $this->courses->where('id', array_key_first($this->selectedCourses))->first()->name;

            if (count($this->selectedCourses) > 1) {
                $this->selectedCoursesSummery .= ' +'.(count($this->selectedCourses) - 1);
            }
        } else {
            $this->selectedCoursesSummery = null;
        }
    }

    public function render()
    {
        request()->merge([
            'search' => $this->search,
        ]);

        $this->courses = Course::filter()->get();

        $this->syncSelectedOptions();

        return view('livewire.employee.faq.manage');
    }
}
