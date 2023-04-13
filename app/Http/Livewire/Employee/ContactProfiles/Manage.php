<?php

namespace App\Http\Livewire\Employee\ContactProfiles;

use App\Models\ContactProfile;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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

    public array $rules = [
        'contactProfile.name' => ['required', 'max:100'],
        'contactProfile.email' => ['required', 'email:rfc,dns,spoof'],
        'contactProfile.phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9'],
        'photo' => ['required', 'image', 'mimes:jpg,jpeg,png'],
    ];

    public function mount(ContactProfile $contactProfile)
    {
        if ($contactProfile->exists) {
            $this->formMode = 'edit';
        }
        $this->contactProfile = $contactProfile;

        $this->selectedCourses = $this->contactProfile->courses->pluck('id')->toArray();

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
            $rules['photo'] = ['nullable', 'image', 'mimes:jpg,jpeg,png'];
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

        $this->toastNotify(__('Contact Profile created successfully!'), __('Success'), TOAST_SUCCESS);

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

    public function render()
    {
        request()->merge([
            'search' => $this->search,
        ]);

        return view('livewire.employee.contact-profiles.manage');
    }
}
