<?php

namespace App\Http\Livewire\Employee\Settings\Groups;

use App\Models\Tab as TabModel;
use Livewire\Component;

class Tab extends Component
{
    public $tab;

    public $tabs;

    public function mount()
    {
        $this->tabs = TabModel::orderBy('sort_order', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.employee.settings.groups.tab');
    }
}
