<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Livewire\Component;

class FileList extends Component
{
    public Media $media;

    public $isEdit;

    public $showCheckbox = true;

    protected array $rules = [
        'media.is_check' => 'required|boolean',
    ];

    public function render()
    {
        return view('livewire.file-list');
    }

    public function handleIsCheck()
    {
        $this->media->is_check = (bool) $this->media->is_check;

        if ($this->media->save()) {
            $this->toastNotify(__('Document status updated successfully.'), __('Success'), TOAST_SUCCESS);
        } else {
            $this->toastNotify(__("Document status can't updated successfully."), __('Error'), TOAST_ERROR);
        }
    }

    public function delete()
    {
        if ($this->media->delete()) {
            $this->emitUp('refreshData');
            $this->emit('progressUpdated');
            $this->toastNotify(__('Document deleted successfully.'), __('Success'), TOAST_SUCCESS);
        } else {
            $this->toastNotify(__("Document can't deleted successfully."), __('Error'), TOAST_ERROR);
        }
    }
}
