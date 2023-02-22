<?php

namespace App\Http\Livewire;

use App\Models\Field;
use App\Models\User;
use Livewire\Component;

class Contract extends Component
{
    public $companies;

    public User $applicant;

    public $contactCompany;

    public $partnerCompanyFieldId;

    protected $listeners = ['refreshData'];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->partnerCompanyFieldId = Field::where('related_option_table', 'companies')->first()?->id;
        $this->contactCompany = $this->partnerCompanyFieldId;
        // dd($this->contactCompany);
    }

    public function render()
    {
        return view('livewire.contract');
    }
}
