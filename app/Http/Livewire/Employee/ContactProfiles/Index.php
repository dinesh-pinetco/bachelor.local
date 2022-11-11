<?php

namespace App\Http\Livewire\Employee\ContactProfiles;

use App\Models\ContactProfile;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedContactProfile;

    public function openConfirmModal(ContactProfile $contactProfile)
    {
        $this->open();
        $this->deletedContactProfile = $contactProfile;
    }

    public function delete()
    {
        $this->deletedContactProfile->delete();
        $this->reset('show', 'deletedContactProfile');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search']));

        return view('livewire.employee.contact-profiles.index', [
            'contactProfiles' => ContactProfile::filter()->paginate($this->perPage),
        ]);
    }
}
