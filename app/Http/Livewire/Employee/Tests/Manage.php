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

    protected array $rules = [
        'test.name' => ['required', 'max:50'],
        'test.description' => ['required'],
        'test.type' => ['required'],
        'test.duration' => ['required'],
        'test.is_required' => ['required'],
        'test.has_passing_limit' => ['required', 'boolean'],
        'test.passing_limit' => ['required_if:test.has_passing_limit,true', 'nullable', 'numeric'],
        'test.is_active' => ['required', 'boolean'],

    ];

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

        $this->types = Test::types();
        $this->selectedCourses = $this->test->courses->pluck('id')->toArray();
    }

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        if (! $this->test->has_passing_limit) {
            $this->test->passing_limit = null;
        }
        $this->test->save();

        $this->syncCourse($this->test);

        $this->toastNotify(__('Test created successfully!'), __('Success'), TOAST_SUCCESS);

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
    }

    public function render()
    {
        request()->merge([
            'search' => $this->search,
        ]);

        $this->courses = Course::filter()->get();

        return view('livewire.employee.tests.manage');
    }
}
