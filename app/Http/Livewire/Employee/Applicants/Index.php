<?php

namespace App\Http\Livewire\Employee\Applicants;

use App\Models\ApplicationStatus;
use App\Models\ModelHasCourse;
use App\Models\User;
use App\Models\UserPreference;
use App\Services\Statistics;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $filteredBy;

    public $queryString = [
        'search' => ['except' => ''],
        'selectedStatuses' => ['except' => ''],
        'perPage',
        'sort_by',
        'sort_type',
        'filteredBy',
        'column',
    ];

    public $deletedApplicant;

    public $column = null;

    public array $columns = User::SEARCHABLE_FIELDS;

    public $statuses;

    public array $selectedStatuses = [];

    public $selectedStatusesSummery;

    public $authPreferencesFields;

    public $applicantsTableFields;

    public $selectedShowFields;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->statuses = ApplicationStatus::select(['id', 'name'])->get();

        $this->authPreferencesFields = $this->getUserPreferenceFields();
        $this->applicantsTableFields = config('application.applicants_fields');

        $this->selectedFieldsDropdownTitle();
        $this->syncSelectedOptions();
    }

    public function updatedAuthPreferencesFields($value, $key)
    {
        if (! $value) {
            $this->authPreferencesFields = Arr::where($this->authPreferencesFields, function ($value) {
                return $value !== false;
            });
        }

        $this->updateSettingsList(array_values($this->authPreferencesFields));
        $this->selectedFieldsDropdownTitle();
    }

    public function selectedFieldsDropdownTitle()
    {
        if ($this->authPreferencesFields) {
            $firstValue = key($this->authPreferencesFields);
            $this->selectedShowFields = __($firstValue);

            if (count($this->authPreferencesFields) > 1) {
                $this->selectedShowFields .= ' +'.(count($this->authPreferencesFields) - 1);
            }
        } else {
            $this->selectedShowFields = null;
        }
    }

    public function updateSettingsList($fieldsList)
    {
        UserPreference::updateOrCreate(
            ['user_id' => auth()->id(), 'type' => 'application_table'],
            ['settings' => $fieldsList]
        );
    }

    protected function getUserPreferenceFields()
    {
        $collections = UserPreference::where('user_id', auth()->id())->value('settings');
        $options = [];

        foreach ($collections ?? [] as $field) {
            $options[$field] = $field;
        }

        return $options;
    }

    public function updatedSelectedStatuses()
    {
        $this->selectedStatuses = Arr::where($this->selectedStatuses, function ($value) {
            return $value !== false;
        });

        $this->syncSelectedOptions();
    }

    public function syncSelectedOptions()
    {
        if ($this->statuses && $this->selectedStatuses) {
            $this->selectedStatusesSummery = $this->statuses->where('id', array_key_first($this->selectedStatuses))->first()->translated_name;

            if (count($this->selectedStatuses) > 1) {
                $this->selectedStatusesSummery .= ' +'.(count($this->selectedStatuses) - 1);
            }
        } else {
            $this->selectedStatusesSummery = null;
        }
    }

    public function openConfirmModal(User $applicant)
    {
        if (ModelHasCourse::whereCourseId($applicant->id)->exists()) {
            $this->toastNotify(
                __('Applicant could not be deleted because it is still in use.'),
                __('Error'),
                TOAST_ERROR
            );
        } else {
            $this->open();
            $this->deletedApplicant = $applicant;
        }
    }

    public function delete()
    {
        $this->deletedApplicant->delete();
        $this->reset('show', 'deletedApplicant');
        $this->render();
    }

    public function fetchApplicants()
    {
        $this->filteredBy = request('filteredBy');

        if ($this->filteredBy) {
            $applicants = (new Statistics())->getApplicantsByFilter($this->filteredBy, 'paginate', $this->perPage);
        } else {
            $applicants = User::role(ROLE_APPLICANT)
                ->searchByKey($this->column, request('search'))
                ->filter()
                ->orderBy('id', 'DESC')
                ->paginate($this->perPage);
        }

        return $applicants;
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'selectedStatuses', 'filteredBy']));

        return view('livewire.employee.applicants.index', [
            'applicants' => $this->fetchApplicants(),
        ]);
    }
}
