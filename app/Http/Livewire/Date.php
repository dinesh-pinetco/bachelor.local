<?php

namespace App\Http\Livewire;

use App\Models\Field;
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

    public function mount()
    {
        $this->applicant = $this->applicant ?: auth()->user();

        $this->hiddenFields = explode(',', $this->hiddenFields);

        $fieldValue = $this->applicant->values()->where('group_key', $this->groupKey)->where('field_id', $this->field->id)->first();

        if ($fieldValue && $this->field->type != Field::FIELD_MONTH) {
            $this->year = data_get(Str::of($fieldValue->value)->explode('-'), '0');
            $this->month = data_get(Str::of($fieldValue->value)->explode('-'), '1');
            $this->day = data_get(Str::of($fieldValue->value)->explode('-'), '2');
        } elseif ($fieldValue && $this->field->type === Field::FIELD_MONTH) {
            $this->month = data_get($fieldValue, 'value');
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

            $this->emitUp('date-updated', $this->date);
        } elseif ($this->field->type === Field::FIELD_MONTH_YEAR && $this->month && $this->year) {
            $this->date = $this->year.'-'.$this->month;

            $this->emitUp('date-updated', $this->date);
        } elseif ($this->field->type === Field::FIELD_MONTH && $this->month) {
            $this->date = $this->month;

            $this->emitUp('date-updated', $this->date);
        }
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
