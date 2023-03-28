<?php

namespace App\Http\Livewire\Employee\Faq;

use App\Models\Course;
use App\Models\Faq;
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
        'faq.name' => ['required', 'max:100'],
        'faq.question' => ['required'],
        'faq.answer' => ['required'],
    ];

    public function mount(Faq $faq)
    {
        if ($faq->exists) {
            $this->formMode = 'edit';
        }

        $this->faq = $faq;
        $this->selectedCourses = $this->faq->courses->pluck('id')->toArray();
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

        $this->toastNotify(__('Faq created successfully!'), __('Success'), TOAST_SUCCESS);

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

    public function render()
    {
        request()->merge([
            'search' => $this->search,
        ]);
        $this->courses = Course::filter()->get();

        return view('livewire.employee.faq.manage');
    }
}
