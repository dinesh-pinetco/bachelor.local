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
        $this->overAllProgress = (new ProgressInfo())->overAllProgress();
        //        if ($profileTabProgress == PER_STEP_PROGRESS && $this->overAllProgress != 100) {
        //            $this->emitTo('application.show', 'profileProgressComplete');
        //        }
    }

    public function submit()
    {
        auth()->user()->application_status = ApplicationStatus::APPLIED_ON_MARKETPLACE;
        auth()->user()->save();

        return to_route('companies.index');
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }
}
