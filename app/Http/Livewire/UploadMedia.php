<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Media;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadMedia extends Component
{
    use WithFileUploads;

    public $model;

    public $extensions;

    public $applicant = null;

    public $tag;

    public array $files = [];

    public bool $isEdit = true;

    public function render()
    {
        $this->applicant = $this->applicant ?: auth()->user();

        return view('livewire.upload-media');
    }

    public function mount($tag, $id = null, $model = null)
    {
        $this->tag = $tag;

        if ($model == 'document' && $id != null) {
            $this->model = Document::find($id);
        } else {
            $this->model = User::find(auth()->id());
        }
    }

    public function updatedFiles()
    {
        $rules = [];
        $extensionsString = implode(',', array_map(function ($v) {
            return ltrim($v, '.');
        }, $this->extensions->pluck('extension')->toArray()));
        $rules = array_merge($rules, [
            'files.*' => ['required', 'file', 'max:13360', 'mimes:'.$extensionsString],
        ]);

        try {
            $this->validate($rules,[
                'files.*.required' => __('The file is required'),
                'files.*.max' => __('The file size must not be greater than :max'),
            ], [
                    'files.*' => __('Files'),
                ]);

            foreach ($this->files as $file) {
                $media = Media::make('documents', $this->applicant, $this->tag)
                    ->model($this->model)
                    ->upload($file);

                $media->push();
            }
        } catch (ValidationException $e) {
            $this->toastNotify($e->getMessage(), __('Error'), TOAST_ERROR);
        }

        $this->reset(['files']);

        $this->emitUp('refreshData');
        $this->emit('progressUpdated');
    }
}
