<?php

namespace App\Http\Livewire\Employee\Documents;

use App\Models\Course;
use App\Models\Document;
use App\Models\Extension;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    public Document $document;

    public string $formMode = 'create';

    public $search;

    public $courses;

    public $extensions;

    public array $course_ids = [];

    public array $selectedExtensions = [];

    public bool $test = true;

    protected array $rules = [
        'document.name' => ['required', 'unique:documents,name','max:100'],
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

        return view('livewire.employee.documents.manage');
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
        $this->course_ids = $this->document->courses->pluck('id')->toArray();
        $this->selectedExtensions = $this->document->extensions->pluck('id')->toArray();
    }

    public function submit()
    {
        $this->{$this->formMode}();
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

        if (! $document->courses->pluck('id')->diff($this->course_ids)->isEmpty() || ! collect($this->course_ids)->diff($document->courses->pluck('id'))->isEmpty()) {
            $isDirtyCourse = true;
            $document->auditCustomOld['course'] = $document->courses->pluck('name')->implode(', ');
        }

        if (! $document->extensions->pluck('id')->diff($this->selectedExtensions)->isEmpty() || ! collect($this->selectedExtensions)->diff($document->extensions->pluck('id'))->isEmpty()) {
            $isDirtyExtensions = true;
            $document->auditCustomOld['extensions'] = $document->extensions->pluck('name')->implode(', ');
        }

        $document->courses()->sync($this->course_ids);
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
        $this->validate(array_merge($this->rules, ['document.name' => ['required','max:100', "unique:documents,name,{$this->document->id}"]]));

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
