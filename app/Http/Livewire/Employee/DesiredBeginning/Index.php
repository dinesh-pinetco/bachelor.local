<?php

namespace App\Http\Livewire\Employee\DesiredBeginning;

use App\Models\DesiredBeginning;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public array $columns = DesiredBeginning::SEARCHABLE_FIELDS;

    public $course_start_date;

    public $archive_at = false;

    public $column = null;

    public $desiredBeginning;

    public $deletedDesireBeginning;

    public $showForm = false;

    public $isEdit = false;

    public $month = 10;

    public $year;

    //    protected $messages = [
    //        'course_start_date.unique' => 'The Email Address cannot be empty.',
    //        'email.email' => 'The Email Address format is not valid.',
    //    ];

    protected $validationAttributes = [
        'course_start_date' => 'Desire Beginning',
    ];

    protected function rules()
    {
        $futureDate = now()->toDateString();

        return [
            'course_start_date' => [
                'required',
                'unique:desired_beginnings',
                'date',
                'after:'.$futureDate,
            ],
        ];
    }

    public function mount()
    {
        $this->year = now()->format('m') >= 10 ? now()->addYear()->format('Y') : now()->format('Y');
    }

    public function save()
    {
        if ($this->month && $this->year) {

            $this->course_start_date = $this->year.'-'.$this->month.'-'.'01';

            $this->validate();
            DesiredBeginning::create([
                'course_start_date' => $this->course_start_date,
                'archived_at' => ! $this->archive_at ? now() : null,
            ]);
            $this->reset('showForm');
            $this->toastNotify(__('Desired Beginning created successfully.'), __('Success'), TOAST_SUCCESS);
        }
    }

    public function update()
    {
        if ($this->month && $this->year) {
            $futureDate = now()->toDateString();
            $rules = $this->rules();
            $rules['course_start_date'] = [
                'required',
                'date',
                'after:'.$futureDate,
                Rule::unique('desired_beginnings')->ignore($this->desiredBeginning),
            ];
            $this->course_start_date = $this->year.'-'.$this->month.'-'.'01';
            $this->validate($rules);
            DesiredBeginning::where('id', $this->desiredBeginning->id)->update([
                'course_start_date' => $this->course_start_date,
                'archived_at' => ! $this->archive_at ? now() : null,
            ]);
            $this->reset('showForm');
            $this->toastNotify(__('Desired Beginning created successfully.'), __('Success'), TOAST_SUCCESS);
        }
    }

    public function edit(DesiredBeginning $desiredBeginning)
    {
        $this->year = $desiredBeginning->course_start_date->format('Y');
        $this->month = $desiredBeginning->course_start_date->format('m');
        $this->archive_at = is_null($desiredBeginning->archived_at);
        $this->showForm = true;
        $this->isEdit = true;
        $this->desiredBeginning = $desiredBeginning;
    }

    public function openConfirmModal(DesiredBeginning $desiredBeginning)
    {
        if ($desiredBeginning->courses->count()) {
            $this->toastNotify(__('Desire Beginning could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        } else {
            $this->deletedDesireBeginning = $desiredBeginning;
            $this->open();
        }
    }

    public function delete()
    {
        $this->deletedDesireBeginning->delete();
        $this->toastNotify(__('Desire Beginning deleted successfully.'), __('Success'), TOAST_SUCCESS);
        $this->close();
        $this->reset('deletedDesireBeginning');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.desired-beginning.index', [
            'desiredBeginnings' => DesiredBeginning::searchByKey($this->column, request('search'))->paginate($this->perPage),
        ]);
    }
}
