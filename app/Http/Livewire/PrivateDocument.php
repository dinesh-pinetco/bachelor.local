<?php

namespace App\Http\Livewire;

use App\Models\Extension;
use Livewire\Component;

class PrivateDocument extends Component
{
    public $isEdit = true;

    public $applicant;

    public $medias;

    public $extentions;

    public $privateDocuments;

    protected $listeners = ['refreshData' => '$refresh'];

    public function mount($applicant)
    {
        $this->applicant = $applicant;
        $this->extensions = Extension::all();
    }

    public function render()
    {
        $this->medias = $this->applicant->media_private_document;

        return view('livewire.private-document');
    }
}
