<?php

namespace App\Http\Livewire;

use App\Enums\FieldType;
use App\Models\Course;
use App\Models\FieldValue;
use App\Models\Option;
use App\Services\DesiredBeginningFilter;
use App\Services\Hubspot\Contact;
use App\Services\ModelHelper;
use App\Services\SyncUserValue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Field extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public $value;

    public $groupKey;

    public $field;

    public $courseOptions = [];

    public $desiredBeginningOptions = [];

    public $applicant = null;

    public array $validation_errors = [];

    public $fieldValue;

    public bool $isEdit = false;

    protected $listeners
        = [
            'date-updated' => 'updateDate',
        ];

    public function validationAttributes(): array
    {
        return [
            'fieldValue' => $this->field->label,
        ];
    }

    protected function rules(): array
    {
        $validation['fieldValue'] = [];

        if ($this->field->is_required) {
            $validation['fieldValue'][] = 'required';
        }

        if ($this->field->type == 'file' && $this->field->key == 'avatar') {
            // array_push($validation['fieldValue'], 'image');
            $validation['fieldValue'][] = 'mimes:jpeg,png,jpg';
            $validation['fieldValue'][] = 'file';
            $validation['fieldValue'][] = 'max:512';
        }

        if ($this->field->type == 'email') {
            $validation['fieldValue'][] = 'email';
        }

        return $validation;
    }

    protected function messages(): array
    {
        return [];
    }

    public function mount()
    {
        if ($this->field) {
            $this->fieldValue = null;
        } else {
            $this->fieldValue = $this->value->value;
            $this->field = $this->value->fields()->first();
        }

        if ($this->fieldValue && $this->field->type == FieldType::FIELD_FILE()) {
            $this->fieldValue = Storage::url($this->fieldValue);
        }

        if ($this->field && $this->field->type === FieldType::FIELD_MULTI_SELECT()) {
            $selectedValues = Option::whereIn('key', json_decode($this->value->value))->where('field_id', $this->field->id)->get()->pluck('key')->toArray();
            $this->fieldValue = $this->value ? $selectedValues : [];
        }

        if ($this->field->related_option_table == 'courses'
            || $this->field->related_option_table == 'desired_beginnings'
        ) {
            $this->attachOptions();

            if ($this->field->related_option_table == 'desired_beginnings') {
                foreach ($this->desiredBeginningOptions as $key => $desiredBeginningOption) {
                    if ($desiredBeginningOption->date == $this->applicant->course->first()->course_start_date) {
                        $this->fieldValue = $key;
                    }
                }
            }
        }

        try {
            if ($this->value && $this->authorizeForUser($this->applicant, 'update', $this->value)) {
                $this->isEdit = true;
            } elseif ($this->authorizeForUser($this->applicant, 'create', FieldValue::class)) {
                $this->isEdit = true;
            }
        } catch (Throwable $th) {
            $this->isEdit = false;
        }
    }

    public function updateDate($date)
    {
        $this->fieldValue = $date;
        $this->save();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if ($this->field->key == 'desired_beginning_id' && $this->field->related_option_table == 'desired_beginnings') {
            $this->desiredBeginningUpdate();
        } else {
            $this->save();
        }
    }

    public function save()
    {
        $this->validate();

        $fileUploaded = $this->fieldValue instanceof UploadedFile;

        if ($fileUploaded) {
            $path = $this->fieldValue->store('profile');
            $this->fieldValue = $path;
        }

        if ($this->value && $this->value->deleted_at == null) {
            if ($this->fieldValue) {
                $this->authorizeForUser($this->applicant, 'update', $this->value);

                $this->value->value = $this->fieldValue;
                $this->value->save();
                if ($this->field->key !== null) {
                    $syncUser = new SyncUserValue($this->applicant);
                    $syncUser->updateUserValue($this->field->key, $this->fieldValue);
                }
            } else {
                $this->value->delete();
            }
        } else {
            $this->authorizeForUser($this->applicant, 'create', FieldValue::class);
            $this->value = $this->applicant->values()->create([
                'field_id' => $this->field->id,
                'value' => is_array($this->fieldValue) ? json_encode($this->fieldValue) : $this->fieldValue,
                'group_key' => $this->groupKey,
            ]);
        }

        $keyForHubspotSync = $this->field->key ?? $this->field->label;
        if (in_array($keyForHubspotSync, Contact::getUserInformationKeys())) {
            $this->applicant->hubspotConfigurationUpdated();
        }

        if ($fileUploaded) {
            $this->fieldValue = Storage::url($this->fieldValue);
        }

        $this->emit('progressUpdated');

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);

        if ($this->field->key == 'course_id' && $this->field->related_option_table == 'courses') {
            $this->courseDesiredBeginningUpdate();
        }
    }

    public function delete()
    {
        $fieldValue = $this->applicant->values()->where('field_id', $this->field->id)->first();
        if ($fieldValue) {
            $fieldValue->delete();
        }

        $this->fieldValue = null;

        $this->toastNotify(__('File deleted successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function getOptionsByModel($table)
    {
        $model = ModelHelper::getModelByName(str::singular(str_replace(' ', '',
            ucwords(str_replace('_', ' ', $table)))));

        return $model->get();
    }

    private function courseDesiredBeginningUpdate()
    {
        $desiredBeginningOptions = (new DesiredBeginningFilter(Course::find($this->fieldValue)))->filter(true)->first();

        $fieldValue = $this->applicant->getValueByField('desired_beginning_id');

        if ($fieldValue) {
            $fieldValue->value = $desiredBeginningOptions->id;
            $fieldValue->save();
        }

        $this->applicant->attachCourseWithDesiredBeginning($this->fieldValue, $desiredBeginningOptions->id,
            $desiredBeginningOptions->date->toDateString());

        return redirect(request()->header('Referer'));
    }

    private function desiredBeginningUpdate()
    {
        $course = $this->applicant->course->first()->course;
        $desiredBeginningOptions = (new DesiredBeginningFilter($course))->filter(true)[$this->fieldValue];

        $fieldValue = $this->applicant->getValueByField('desired_beginning_id');
        if ($fieldValue) {
            $fieldValue->value = $desiredBeginningOptions->id;
            $fieldValue->save();
        }

        $this->applicant->attachCourseWithDesiredBeginning($course->id, $desiredBeginningOptions->id,
            $desiredBeginningOptions->date->toDateString());

        return redirect(request()->header('Referer'));
    }

    private function attachOptions()
    {
        if ($this->field->related_option_table == 'courses') {
            $this->courseOptions = Course::active()
                ->where(fn ($q) => $q->whereNull('last_start')->orWhere('last_start', '>', today()))
                ->get()
                ->filter(function ($course) {
                    $filteredDesiredBeginning = (new DesiredBeginningFilter($course))->filter(true);
                    if ($filteredDesiredBeginning->count()) {
                        return true;
                    } else {
                        return false;
                    }
                });
        }
        if ($this->field->related_option_table == 'desired_beginnings') {
            $course = $this->applicant->course->first();
            $this->desiredBeginningOptions
                    = (new DesiredBeginningFilter(Course::find($course->course_id)))->filter(true);

            foreach ($this->desiredBeginningOptions as $key => $desiredBeginning) {
                if ($course->course_start_date == $desiredBeginning->date->format('Y-m-d')) {
                    $this->fieldValue = $key;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.field');
    }
}
