<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class SemesterDate extends Component
{
    public $semester;

    public $year;

    public $type;

    public $value;

    public function mount()
    {
        if ($this->value) {
            $this->year = data_get(Str::of($this->value)->explode('-'), '0');
            $this->semester = data_get(Str::of($this->value)->explode('-'), '1') == '04' ? '1' : '2';
        }
    }

    public function updatedSemester()
    {
        $this->buildDate();
    }

    public function buildDate()
    {
        $date = null;
        if ($this->semester == 1) {
            $date = $this->year.'-04-01';
        } elseif ($this->semester == 2) {
            $date = $this->year.'-10-01';
        }
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
