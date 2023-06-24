<?php

namespace App\Http\Livewire;

use App\Enums\ApplicationStatus;
use App\Services\ProgressBar as ProgressInfo;
use Livewire\Component;

class ProgressBar extends Component
{
    public $overAllProgress = null;

    public $show;

    protected $listeners = ['progressUpdated' => 'mount'];

    public function mount()
    {
        if (auth()->user()->application_status->id() <= ApplicationStatus::APPLIED_TO_SELECTED_COMPANY->id()) {
            $this->overAllProgress = (new ProgressInfo())->firstCategoryPercentage();
        } else {
            $this->overAllProgress = (new ProgressInfo())->secondCategoryPercentage();
        }
    }

    public function submit()
    {
        auth()->user()->application_status = ApplicationStatus::PERSONAL_DATA_COMPLETED;
        auth()->user()->save();

        return to_route('companies.index');
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }
}
