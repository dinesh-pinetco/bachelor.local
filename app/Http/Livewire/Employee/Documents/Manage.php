<?php

namespace App\Http\Livewire\Employee\Documents;

use App\Models\Course;
use App\Models\Document;
use App\Models\Extension;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    public Document $document;

    public string $formMode = 'create';

    public $search;

    public $courses;

    public array $selectedCourses = [];

    public $selectedCoursesSummery;

    public $extensions;

    public array $selectedExtensions = [];

    public $selectedExtensionsSummery;

    protected array $rules = [
        'document.name' => ['required', 'unique:documents,name'],
        'document.description' => ['nullable'],
        'document.is_required' => ['required'],
        'document.is_active' => ['required'],
        'extensions' => ['array', 'min:1'],
    ];

    public function render()
    {
        request()->merge([
            'search' => $this->search,
        ]);

        $this->courses = Course::filter()->get();
        $this->extensions = Extension::get();

        $this->syncSelectedOptions();
        $this->syncDocumentExtensions();

        return view('livewire.employee.documents.manage');
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
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

    public function syncDocumentExtensions()
    {
        if ($this->extensions && $this->selectedExtensions) {
            $this->selectedExtensionsSummery = $this->extensions->whereIn('id', array_keys($this->selectedExtensions))->implode('name', ', ');
        } else {
            $this->selectedExtensionsSummery = null;
        }
    }

    public function validationAttributes(): array
    {
        return [
            'document.is_active' => __('Status'),
        ];
    }

    public function mount(Document $document)
    {
        if ($document->exists) {
            if (request()->routeIs('employee.documents.edit')) {
                $this->formMode = 'edit';
            } elseif (request()->routeIs('employee.documents.clone')) {
                $this->formMode = 'clone';
            }
        }
        $this->document = $document;
        $this->document->courses->each(function ($course) {
            $this->selectedCourses[$course->id] = $course->id;
        });
        $this->document->extensions->each(function ($extension) {
            $this->selectedExtensions[$extension->id] = $extension->id;
        });
    }

    public function submit()
    {
        $this->{$this->formMode}();
    }

    public function updatedSelectedCourses()
    {
        $this->selectedCourses = Arr::where($this->selectedCourses, function ($value) {
            return $value !== false;
        });

        $this->syncSelectedOptions();
    }

    public function updatedSelectedExtensions()
    {
        $this->selectedExtensions = Arr::where($this->selectedExtensions, function ($value) {
            return $value !== false;
        });

        $this->syncDocumentExtensions();
    }

    private function create()
    {
        $this->validate();

        $this->document->save();
        $this->syncCourseAndExtensions($this->document);
        session()->flash('banner', __('Document created successfully!'));

        $this->redirectToIndex();
    }

    private function syncCourseAndExtensions($document)
    {
        $document->auditEvent = $this->formMode == 'edit' ? 'updated' : $this->formMode;
        $document->isCustomEvent = true;

        $isDirtyCourse = $isDirtyExtensions = false;

        if (! $document->courses->pluck('id')->diff($this->selectedCourses)->isEmpty() || ! collect($this->selectedCourses)->diff($document->courses->pluck('id'))->isEmpty()) {
            $isDirtyCourse = true;
            $document->auditCustomOld['course'] = $document->courses->pluck('name')->implode(', ');
        }

        if (! $document->extensions->pluck('id')->diff($this->selectedExtensions)->isEmpty() || ! collect($this->selectedExtensions)->diff($document->extensions->pluck('id'))->isEmpty()) {
            $isDirtyExtensions = true;
            $document->auditCustomOld['extensions'] = $document->extensions->pluck('name')->implode(', ');
        }

        $document->courses()->sync($this->selectedCourses);
        $document->extensions()->sync($this->selectedExtensions);

        $document->load('courses', 'extensions');

        if ($isDirtyCourse) {
            $document->auditCustomNew['course'] = $document->courses->pluck('name')->implode(', ');
        }

        if ($isDirtyExtensions) {
            $document->auditCustomNew['extensions'] = $document->extensions->pluck('name')->implode(', ');
        }

        if ($isDirtyCourse || $isDirtyExtensions) {
            Event::dispatch(AuditCustom::class, [$document]);
        }
    }

    private function redirectToIndex(): void
    {
        redirect()->route('employee.documents.index');
    }

    private function edit()
    {
        $this->validate(array_merge($this->rules, ['document.name' => ['required', "unique:documents,name,{$this->document->id}"]]));

        $this->document->save();
        $this->syncCourseAndExtensions($this->document);

        session()->flash('banner', __('Document updated successfully!'));

        $this->redirectToIndex();
    }

    private function clone()
    {
        $this->validate();

        $clonedDocument = $this->document->replicate();

        $clonedDocument->push();
        $this->syncCourseAndExtensions($clonedDocument);

        session()->flash('banner', __('Document cloned successfully!'));

        $this->redirectToIndex();
    }
}
