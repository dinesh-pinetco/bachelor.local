<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class SemesterDate extends Component
{
    public $year;

    public $type;

    public $value;

    public function mount()
    {
        if ($this->value) {
            $this->year = data_get(Str::of($this->value)->explode('-'), '0');
        }
    }

    public function updatedSemester()
    {
        $this->buildDate();
    }

    public function buildDate()
    {
        //October start date
        $date = $this->year.'-10-01';
        $this->emitUp('date-updated', $date, $this->type);
    }

    public function updatedYear()
    {
        $this->buildDate();
    }

    public function render()
    {
        return view('livewire.semester-date');
    }
}
