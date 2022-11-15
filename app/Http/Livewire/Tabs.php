<?php

namespace App\Http\Livewire;

use App\Models\Result;
use App\Models\Tab;
use App\Traits\Livewire\HasModal;
use Illuminate\Support\Collection;
use Livewire\Component;

class Tabs extends Component
{
    use HasModal;

    public Collection $tabs;

    public $applicant = null;

    public function mount()
    {
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            $this->tabs = Tab::where('slug', '<>', 'profile')->get();
        } else {
            $this->tabs = Tab::all();
        }
    }

    public function render()
    {
        return view('livewire.tabs');
    }

    public function createInitialResult($testId)
    {
        Result::updateOrCreate(
            ['user_id' => $this->applicant->id, 'test_id' => $testId],
            ['status' => Result::STATUS_NOT_STARTED]
        );
    }
}
