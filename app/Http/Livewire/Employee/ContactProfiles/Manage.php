<?php

namespace App\Http\Livewire\Employee\ContactProfiles;

use App\Models\ContactProfile;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use OwenIt\Auditing\Events\AuditCustom;

class Manage extends Component
{
    use WithFileUploads;

    public ContactProfile $contactProfile;

    public $photo;

    public string $formMode = 'create';

    public $search;

    public $courses;

    public array $selectedCourses = [];

    public $selectedCoursesSummery;

    public array $rules = [
        'contactProfile.name' => ['required'],
        'contactProfile.email' => ['required'],
        'contactProfile.phone' => ['required'],
        'photo' => ['required', 'image'],
    ];

    public function mount(ContactProfile $contactProfile)
    {
        if ($contactProfile->exists) {
            $this->formMode = 'edit';
        }
        $this->contactProfile = $contactProfile;

        $this->contactProfile->courses->each(function ($course) {
            $this->selectedCourses[$course->id] = $course->id;
        });

        $this->courses = Course::filter()->get();

        // For change validation attribute
        $this->validationAttributes = [
            'contactProfile.profile_photo_path' => __('Profile photo'),
        ];
    }

    public function submit()
    {
        $rules = $this->rules;
        if ($this->formMode == 'edit') {
            $rules['photo'] = ['nullable', 'image'];
        }

        $this->validate($rules);

        $this->save();
    }

    private function save(): Redirector|RedirectResponse
    {
        $this->contactProfile->save();
        $this->syncCourse($this->contactProfile);

        if (isset($this->photo)) {
            $this->contactProfile->updateProfilePhoto($this->photo);
        }

        session()->flash('banner', __('Contact Profile created successfully!'));

        return redirect()->route('employee.contact-profiles.index');
    }

    private function syncCourse($contactProfile)
    {
        $contactProfile->auditEvent = $this->formMode == 'edit' ? 'updated' : $this->formMode;
        $contactProfile->isCustomEvent = true;

        $isDirtyCourse = false;

        if (! $contactProfile->courses->pluck('id')->diff($this->selectedCourses)->isEmpty() || ! collect($this->selectedCourses)->diff($contactProfile->courses->pluck('id'))->isEmpty()) {
            $isDirtyCourse = true;
            $contactProfile->auditCustomOld['course'] = $contactProfile->courses->pluck('name')->implode(', ');
        }

        $contactProfile->courses()->sync($this->selectedCourses);

        $contactProfile->load('courses');

        if ($isDirtyCourse) {
            $contactProfile->auditCustomNew['course'] = $contactProfile->courses->pluck('name')->implode(', ');
        }

        if ($isDirtyCourse) {
            Event::dispatch(AuditCustom::class, [$contactProfile]);
        }
    }

    public function deletePhoto()
    {
        $this->contactProfile->deleteProfilePhoto();
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

        $this->syncSelectedOptions();

        return view('livewire.employee.contact-profiles.manage');
    }
}
