<?php

namespace App\Http\Livewire\Employee\Tests;

use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    public Test $test;

    public $search;

    public string $formMode = 'create';

    public array $types = [];

    public $courses;

    public array $selectedCourses = [];

    public $selectedCoursesSummery;

    protected array $rules = [
        'test.name' => ['required'],
        'test.description' => ['required'],
        'test.type' => ['required'],
        'test.duration' => ['required'],
        'test.is_active' => ['required'],
        'test.is_required' => ['required'],
        'test.link' => ['required', 'url'],
    ];

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function validationAttributes(): array
    {
        return [
            'test.is_active' => __('Status'),
        ];
    }

    public function mount(Test $test)
    {
        if ($test->exists && request()->routeIs('employee.tests.edit')) {
            $this->formMode = 'edit';
        }

        $this->test = $test;
        $this->test->courses->each(function ($course) {
            $this->selectedCourses[$course->id] = $course->id;
        });
        $this->types = Test::types();
    }

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->test->save();

        $this->syncCourse($this->test);

        session()->flash('banner', __('Test created successfully!'));

        return redirect()->route('employee.tests.index');
    }

    private function syncCourse($test)
    {
        $test->auditEvent = $this->formMode == 'edit' ? 'updated' : $this->formMode;
        $test->isCustomEvent = true;

        $isDirtyCourse = false;

        if (! $test->courses->pluck('id')->diff($this->selectedCourses)->isEmpty() || ! collect($this->selectedCourses)->diff($test->courses->pluck('id'))->isEmpty()) {
            $isDirtyCourse = true;
            $test->auditCustomOld['course'] = $test->courses->pluck('name')->implode(', ');
        }

        $test->courses()->sync($this->selectedCourses);

        $test->load('courses');

        if ($isDirtyCourse) {
            $test->auditCustomNew['course'] = $test->courses->pluck('name')->implode(', ');
        }

        if ($isDirtyCourse) {
            Event::dispatch(AuditCustom::class, [$test]);
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

        return view('livewire.employee.tests.manage');
    }
}
