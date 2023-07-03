<?php

namespace App\Http\Livewire;

use App\Enums\FieldType;
use Illuminate\Support\Str;
use Livewire\Component;

class Date extends Component
{
    public $groupKey;

    public $field;

    public $date;

    public $applicant = null;

    public $hiddenFields;

    public $day;

    public $month;

    public $year = null;

    public bool $isEdit = false;

    public $fieldValue;

    public function mount()
    {
        $this->applicant = $this->applicant ?: auth()->user();

        $this->hiddenFields = explode(',', $this->hiddenFields);

        $this->fieldValue = $this->applicant->values()->where('group_key', $this->groupKey)->where('field_id', $this->field->id)->first();

        if ($this->fieldValue && $this->field->type != FieldType::FIELD_MONTH->value) {
            $this->year = data_get(Str::of($this->fieldValue->value)->explode('-'), '0');
            $this->month = data_get(Str::of($this->fieldValue->value)->explode('-'), '1');
            $this->day = data_get(Str::of($this->fieldValue->value)->explode('-'), '2');
        } elseif ($this->fieldValue && $this->field->type === FieldType::FIELD_MONTH()) {
            $this->month = data_get($this->fieldValue, 'value');
        }
    }

    public function render()
    {
        return view('livewire.date');
    }

    public function updatedDay()
    {
        $this->buildDate();
    }

    public function buildDate()
    {
        if (($this->day && $this->month && $this->year)) {
            $this->date = $this->year.'-'.$this->month.'-'.$this->day;
        } elseif ($this->field->type === FieldType::FIELD_MONTH_YEAR() && $this->month && $this->year) {
            $this->date = $this->year.'-'.$this->month;
        } elseif ($this->field->type === FieldType::FIELD_MONTH() && $this->month) {
            $this->date = $this->month;
        }

        $this->fieldValue->value = $this->date;
        $this->fieldValue->save();

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);

    }

    public function updatedMonth()
    {
        $this->buildDate();
    }

    public function updatedYear()
    {
        $this->buildDate();
    }
}
