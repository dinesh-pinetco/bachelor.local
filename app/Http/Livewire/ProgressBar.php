<?php

namespace App\Http\Livewire;

use App\Services\ProgressBar as ProgressInfo;
use Livewire\Component;

class ProgressBar extends Component
{
    public $overAllProgress = null;

    protected $listeners = ['progressUpdated' => 'mount'];

    public function mount()
    {
        $this->overAllProgress = (new ProgressInfo())->overAllProgress();
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }
}
