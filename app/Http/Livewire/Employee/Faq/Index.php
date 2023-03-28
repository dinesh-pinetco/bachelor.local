<?php

namespace App\Http\Livewire\Employee\Faq;

use App\Models\Faq;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedFaq;

    public function openConfirmModal(Faq $faq)
    {
        $this->open();
        $this->deletedFaq = $faq;
    }

    public function delete()
    {
        $this->deletedFaq->delete();
        $this->toastNotify(__('Faq deleted successfully!'), __('Success'), TOAST_SUCCESS);
        $this->reset('show', 'deletedFaq');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.faq.index', [
            'faq' => Faq::filter()->orderBy('sort_order')->paginate($this->perPage),
        ]);
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            Faq::find($item['value'])->update(['sort_order' => ((($this->page - 1) * $this->perPage) + $item['order'])]);
        }
    }
}
