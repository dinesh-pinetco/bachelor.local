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
        $profileTabProgress = (new \App\Services\ProgressBar(auth()->id()))->calculateProgressByTab('profile');

        if ($profileTabProgress == PER_STEP_PROGRESS){
            $this->emitTo('application.show','profileProgressComplete');
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
