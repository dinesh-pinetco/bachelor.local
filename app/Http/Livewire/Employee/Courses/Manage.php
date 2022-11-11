<?php

namespace App\Http\Livewire\Employee\Courses;

use App\Models\Course;
use App\Models\DesiredBeginning;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    public Course $course;

    public $desiredBeginnings;

    public array $selectedDesiredBeginnings = [];

    public $selectedDesiredBeginningsSummary;

    public string $formMode = 'create';

    protected array $rules = [
        'course.sana_id'       => ['nullable'],
        'course.name'          => ['required', 'unique:courses,name', 'min:5', 'max:50'],
        'course.form_of_study' => ['required'],
        'course.description'   => ['required'],
        'course.is_active'     => ['required'],
        'course.first_start'   => ['required', 'date'],
        'course.last_start'    => ['nullable', 'date', 'after_or_equal:course.first_start'],
        'course.lead_time'     => ['required', 'numeric', 'gt:course.dead_time'],
        'course.dead_time'     => ['required', 'numeric', 'lt:course.lead_time'],
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

        $this->desiredBeginnings = DesiredBeginning::get();
        $this->course = $course;

        $this->course->desired_beginnings->each(function ($desiredBeginning) {
            $this->selectedDesiredBeginnings[$desiredBeginning->id] = $desiredBeginning->id;
        });
    }

    public function render()
    {
        $this->desiredBeginnings = DesiredBeginning::get();
        $this->syncSelectedOptions();

        return view('livewire.employee.courses.manage');
    }

    public function syncSelectedOptions()
    {
        if ($this->desiredBeginnings && $this->selectedDesiredBeginnings) {
            $this->selectedDesiredBeginningsSummary = $this->desiredBeginnings->where('id', array_key_first($this->selectedDesiredBeginnings))->first()->name;

            if (count($this->selectedDesiredBeginnings) > 1) {
                $this->selectedDesiredBeginningsSummary .= ' +'.(count($this->selectedDesiredBeginnings) - 1);
            }
        } else {
            $this->selectedDesiredBeginningsSummary = null;
        }
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    public function updatedSelectedDesiredBeginnings()
    {
        $this->selectedDesiredBeginnings = Arr::where($this->selectedDesiredBeginnings, fn ($value) => $value !== false);

        $this->syncSelectedOptions();
    }

    public function updateDate($date, $type)
    {
        $this->course[$type] = $date;
    }

    private function create()
    {
        $this->validate();

        $this->course->save();

        $this->syncDesiredBeginnings($this->course);

        session()->flash('banner', __('Course created successfully!'));

        $this->redirectToIndex();
    }

    private function syncDesiredBeginnings($course)
    {
        $course->auditEvent = $this->formMode == 'edit' ? 'updated' : $this->formMode;
        $course->isCustomEvent = true;

        $isDirtyDesiredBeginnings = false;

        if (! $course->desired_beginnings->pluck('id')->diff($this->selectedDesiredBeginnings)->isEmpty() || ! collect($this->selectedDesiredBeginnings)->diff($course->desired_beginnings->pluck('id'))->isEmpty()) {
            $isDirtyDesiredBeginnings = true;
            $course->auditCustomOld['desired_beginning'] = $course->desired_beginnings->pluck('name')->implode(', ');
        }

        $course->desired_beginnings()->sync($this->selectedDesiredBeginnings);

        $course->load('desired_beginnings');

        if ($isDirtyDesiredBeginnings) {
            $course->auditCustomNew['desired_beginning'] = $course->desired_beginnings->pluck('name')->implode(', ');
        }

        if ($isDirtyDesiredBeginnings) {
            Event::dispatch(AuditCustom::class, [$course]);
        }
    }

    private function redirectToIndex(): void
    {
        redirect()->route('employee.courses.index');
    }

    private function edit()
    {
        $this->validate(array_merge($this->rules, ['course.name' => ['required', "unique:courses,name,{$this->course->id}"]]));

        $this->course->save();

        $this->syncDesiredBeginnings($this->course);

        session()->flash('banner', __('Course updated successfully!'));

        $this->redirectToIndex();
    }

    private function clone()
    {
        $this->validate();

        $clonedCourse = $this->course->replicate();

        $clonedCourse->push();

        $this->syncDesiredBeginnings($clonedCourse);

        session()->flash('banner', __('Course cloned successfully!'));

        $this->redirectToIndex();
    }
}
