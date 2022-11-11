<?php

namespace App\Http\Livewire\Employee\Documents;

use App\Models\Document;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedDocument;

    public $column = null;

    public array $columns = Document::SEARCHABLE_FIELDS;

    public function openConfirmModal(Document $document)
    {
        if ($document->medias->count() > 0) {
            $this->toastNotify(__('Document could not be deleted because it is still in use.'), __('Error'), TOAST_ERROR);
        } else {
            $this->open();
            $this->deletedDocument = $document;
        }
    }

    public function delete()
    {
        $this->deletedDocument->delete();
        $this->toastNotify(__('Document deleted successfully.'), __('Success'), TOAST_SUCCESS);
        $this->reset('show', 'deletedDocument');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.documents.index', [
            'documents' => Document::searchByKey($this->column, request('search'))->filter()->paginate($this->perPage),
        ]);
    }
}
