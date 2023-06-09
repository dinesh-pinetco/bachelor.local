<?php

namespace App\Http\Livewire\Employee\Applicants;

use App\Enums\ApplicationStatus;
use App\Exports\ApplicantsExport;
use App\Models\Course;
use App\Models\DesiredBeginning;
use App\Models\User;
use App\Models\UserPreference;
use App\Services\Statistics;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal, AuthorizesRequests;

    public $filteredBy;

    public $deletedApplicant;

    public $forcePassedApplicant = [];

    public $column = null;

    public array $columns = User::SEARCHABLE_FIELDS;

    public $statuses;

    public array $selectedStatuses = [];

    public array $authPreferencesFields = [];

    public $selectedShowFields;

    public $applicantsTableFields;

    public $desiredBeginnings = [];

    public $desiredBeginning = null;

    public $courses = [];

    public $courseOptions = [];

    public $queryString = [
        'search' => ['except' => ''],
        'selectedStatuses' => ['except' => ''],
        'perPage',
        'sort_by',
        'sort_type',
        'filteredBy',
        'column' => ['except' => ''],
        'desiredBeginning' => ['except' => ''],
        'courses' => ['except' => ''],
    ];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->desiredBeginnings = DesiredBeginning::all()->unique('course_start_date');

        $this->courseOptions = Course::all();

        $this->statuses = ApplicationStatus::selectionOptions();

        $this->authPreferencesFields = $this->getUserPreferenceFields();

        collect(config('application.applicants_fields'))->each(function ($applicantsTableField) {
            $this->applicantsTableFields[] = [
                'key' => $applicantsTableField,
                'label' => __($applicantsTableField),
            ];
        });
    }

    public function updateSettingsList($fieldsList)
    {
        UserPreference::updateOrCreate(
            ['user_id' => auth()->id(), 'type' => 'application_table'],
            ['settings' => $fieldsList]
        );
    }

    public function updatedAuthPreferencesFields()
    {
        $this->updateSettingsList(array_values($this->authPreferencesFields));
    }

    protected function getUserPreferenceFields()
    {
        $collections = UserPreference::where('user_id', auth()->id())->value('settings');
        $options = [];

        foreach ($collections ?? [] as $field) {
            $options[] = $field;
        }

        return $options;
    }

    public function openConfirmModal(User $applicant, $action)
    {
        ($action === 'delete') ? $this->openConfirmDeleteModal($applicant) : $this->openConfirmPassModal($applicant);
    }

    public function openConfirmDeleteModal($applicant)
    {
        $this->open();
        $this->deletedApplicant = $applicant;
    }

    public function delete()
    {
        $this->deletedApplicant->delete();
        $this->reset('show', 'deletedApplicant');
        $this->toastNotify(__('Applicant deleted successfully.'), __('Success'), TOAST_SUCCESS);
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
                ->with(['configuration', 'values.fields', 'desiredBeginning.courses', 'courses'])
                ->paginate($this->perPage);
        }

        return $applicants;
    }

    public function exportApplicants()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'selectedStatuses', 'filteredBy']));

        $user_ids = $this->filteredBy
            ? (new Statistics())->getApplicantsByFilter($this->filteredBy, 'get', '*')->pluck('id')->toArray()
            : User::role(ROLE_APPLICANT)
                ->searchByKey($this->column, request('search'))
                ->filter()
                ->orderBy('id', 'DESC')
                ->pluck('id')
                ->toArray();

        return Excel::download(new ApplicantsExport($user_ids), 'applicants.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'selectedStatuses', 'filteredBy', 'desiredBeginning', 'courses']));

        return view('livewire.employee.applicants.index', [
            'applicants' => $this->fetchApplicants(),
        ]);
    }
}
