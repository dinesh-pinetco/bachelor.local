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
    }

    public function submit()
    {
        auth()->user()->application_status = ApplicationStatus::CONSENT_TO_COMPANY_PORTAL_BULLETIN_BOARD;
        auth()->user()->save();

        return to_route('companies.index');
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }
}
