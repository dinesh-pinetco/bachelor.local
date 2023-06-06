<?php

namespace App\Http\Livewire;

use App\Enums\FieldType;
use App\Models\Course;
use App\Models\DesiredBeginning;
use App\Models\FieldValue;
use App\Models\School;
use App\Services\Hubspot\Contact;
use App\Services\ModelHelper;
use App\Services\SyncUserValue;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
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

    protected $listeners = ['date-updated' => 'updateDate', 'cityFieldValueChanged'];

    public function validationAttributes(): array
    {
        return [
            'fieldValue' => $this->field->label,
        ];
    }

    public function cityFieldValueChanged()
    {
        if ($this->field->related_option_table) {
            $this->getOptionsByModel($this->field->related_option_table);
        }
    }

    // Just for overwrite file attribute name :D
    public function uploadErrored($name, $errorsInJson, $isMultiple)
    {
        $name = $this->field->label;
        $this->emit('upload:errored', $name)->self();

        if (is_null($errorsInJson)) {
            // Handle any translations/custom names
            $translator = app()->make('translator');

            $attribute = $translator->get("validation.attributes.{$name}");
            if ($attribute === "validation.attributes.{$name}") {
                $attribute = $name;
            }

            $message = trans('validation.uploaded', ['attribute' => $attribute]);
            if ($message === 'validation.uploaded') {
                $message = "The {$name} failed to upload.";
            }

            throw ValidationException::withMessages([$name => $message]);
        }

        $errorsInJson = $isMultiple
            ? str_ireplace('files', $name, $errorsInJson)
            : str_ireplace('files.0', $name, $errorsInJson);

        $errors = json_decode($errorsInJson, true)['errors'];

        throw (ValidationException::withMessages($errors));
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
            $validation['fieldValue'][] = 'max:1024';
        }

        if ($this->field->type == 'email') {
            $validation['fieldValue'][] = 'email:rfc,dns,spoof';
        }

        //        if ($this->field->key == 'first_name') {
        //            $validation['fieldValue'][] = 'max:512';
        //            $validation['fieldValue'][] = 'string';
        //        }
        //
        //        if ($this->field->key == 'last_name') {
        //            $validation['fieldValue'][] = 'max:512';
        //            $validation['fieldValue'][] = 'string';
        //        }

        if ($this->field->type == FieldType::FIELD_TEXT()) {
            $validation['fieldValue'][] = $this->field->validation;
        }

        if ($this->field->key == 'phone') {
            //            $validation['fieldValue'][] = 'phone:DE';

            $validation['fieldValue'][] = VALIDATION_NUMBERS;
            $validation['fieldValue'][] = 'min:9';
            $validation['fieldValue'][] = 'max:20';
        }

        if ($this->field->key == 'street_house_number') {
            $validation['fieldValue'][] = 'string';
        }

        if ($this->field->key == 'date_of_birth') {
            $validation['fieldValue'][] = 'before:now';
        }

        if ($this->field->key == 'postal_code') {
            $validation['fieldValue'][] = 'numeric';
        }

        if ($this->field->key == 'location') {
            $validation['fieldValue'][] = 'string';
        }

        if ($this->field->key == 'country') {
            $validation['fieldValue'][] = 'alpha';
        }

        return $validation;
    }

    public function messages(): array
    {
        if ($this->field->key == 'phone') {
            return [
                'fieldValue.regex' => __('The Phone number field contains an invalid number'),
            ];
        }

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

        if ($this->field->key == 'avatar') {
            config()->set('livewire.temporary_file_upload.rules', ['required', 'file', 'max:125']);
        }

        if ($this->field && $this->field->type === FieldType::FIELD_MULTI_SELECT()) {
            $this->fieldValue = json_decode($this->fieldValue) ?? [];
        }

        if ($this->field && $this->field->type === FieldType::FIELD_CHECKBOX()) {
            $this->fieldValue = (array) json_decode($this->fieldValue) ?? [];
        }

        if (
            $this->field->related_option_table == 'courses'
            || $this->field->related_option_table == 'desired_beginnings'
        ) {
            $this->attachOptions();
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
            if ($this->field->key == 'characteristics' && (count($this->fieldValue) > 10)) {
                $this->fieldValue = array_slice($this->fieldValue, 0, -1);
                $this->toastNotify(__('Maximum of 10 characteristics allowed.'), '', TOAST_INFO);

                return;
            } elseif ($this->field->key == 'characteristics' && (count($this->fieldValue) == 0)) {
                $this->fieldValue = [];
            }
            $this->save();
        }

        if ($this->field->key == 'city') {
            $this->emit('cityFieldValueChanged');
        }

        if ($this->field->type == FieldType::FIELD_TEL()) {
            $this->dispatchBrowserEvent('livewire:tel-load');

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

        if ($this->value && is_null($this->value->deleted_at)) {
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
            $this->coursesUpdated();
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
        if ($this->field->key == 'school_qualification') {
            $cityId = $this->applicant->getValueByField('city');

            $model = School::where('city_id', $cityId?->value)->orderBy('name');

            return $model->get();
        }

        $model = ModelHelper::getModelByName(str::singular(str_replace(
            ' ',
            '',
            ucwords(str_replace('_', ' ', $table))
        )));

        return $model->get();
    }

    private function coursesUpdated()
    {
        $fieldValue = $this->applicant->getValueByField('course_id');

        if ($fieldValue) {
            $fieldValue->value = $this->fieldValue;
            $fieldValue->save();
        }

        $this->applicant->attachCourseWithDesiredBeginning(
            $this->applicant->desiredBeginning->course_start_date,
            $this->fieldValue
        );
    }

    private function desiredBeginningUpdate()
    {
        $fieldValue = $this->applicant->getValueByField('desired_beginning_id');

        if ($fieldValue) {
            $desiredBeginning = DesiredBeginning::where('id', $fieldValue->value)
                ->update(['course_start_date' => $this->fieldValue]);

            $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
            //TODO: must reset courses
        }
    }

    private function attachOptions()
    {
        if ($this->field->related_option_table == 'courses') {
            $this->courseOptions = Course::query()
                ->active()
                ->where(fn ($q) => $q->whereNull('last_start')->orWhere('last_start', '>', today()))
                ->get();
        }

        if ($this->field->related_option_table == 'desired_beginnings') {
            $this->desiredBeginningOptions = DesiredBeginning::options();
            $this->fieldValue = DesiredBeginning::find($this->fieldValue)?->course_start_date?->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.field');
    }
}
