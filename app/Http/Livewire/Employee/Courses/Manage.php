<?php

namespace App\Http\Livewire\Employee\Courses;

use App\Models\Course;
use App\Models\DesiredBeginning;
use Livewire\Component;

class Manage extends Component
{
    public Course $course;

    public $desireBeginnings;

    public array $selectedDesiredBeginning = [];

    public string $formMode = 'create';

    protected array $rules = [
        'course.sana_id' => ['nullable', 'numeric', 'max_digits:10'],
        'course.name' => ['required', 'unique:courses,name', 'min:5', 'max:50'],
        'course.form_of_study' => ['required', 'max:50'],
        'course.description' => ['required'],
        'course.is_active' => ['required'],
        //        'course.first_start' => ['required', 'date'],
        //        'course.last_start' => ['nullable', 'date', 'after_or_equal:course.first_start'],
        //        'course.lead_time' => ['required', 'numeric', 'gt:course.dead_time', 'max_digits:10'],
        //        'course.dead_time' => ['required', 'numeric', 'lt:course.lead_time'],
    ];

    protected $listeners = [
        'date-updated' => 'updateDate',
    ];

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function validationAttributes(): array
    {
        return [
            'course.is_active' => __('Status'),
        ];
    }

    public function mount(Course $course)
    {
        if ($course->exists) {
            if (request()->routeIs('employee.courses.edit')) {
                $this->formMode = 'edit';
            } elseif (request()->routeIs('employee.courses.clone')) {
                $this->formMode = 'clone';
            }
        }

        $this->selectedDesiredBeginning = $this->course->desiredBeginnings()->pluck('model_id')->toArray();

        $this->course = $course;
        $this->desireBeginnings = DesiredBeginning::options();
    }

    public function render()
    {
        return view('livewire.employee.courses.manage');
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    public function updateDate($date, $type)
    {
        $this->course[$type] = $date;
    }

    private function create()
    {

        $this->validate();

        $this->course->save();

        $this->course->attachDesiredBeginnings($this->selectedDesiredBeginning);

        $this->toastNotify(__('Course created successfully!'), __('Success'), TOAST_SUCCESS);

        $this->redirectToIndex();
    }

    private function redirectToIndex(): void
    {
        redirect()->route('employee.courses.index');
    }

    private function edit()
    {
        $this->validate(array_merge($this->rules,
            ['course.name' => ['required', 'max:100', "unique:courses,name,{$this->course->id}"]]));

        $this->course->save();
        $this->course->attachDesiredBeginnings($this->selectedDesiredBeginning);
        $this->toastNotify(__('Course updated successfully!'), __('Success'), TOAST_SUCCESS);

        $this->course->syncOnHubspot();
        $this->redirectToIndex();
    }

    private function clone()
    {
        $this->validate();

        $clonedCourse = $this->course->replicate();

        $clonedCourse->push();

        $this->toastNotify(__('Course cloned successfully!'), __('Success'), TOAST_SUCCESS);

        $this->redirectToIndex();
    }
}
