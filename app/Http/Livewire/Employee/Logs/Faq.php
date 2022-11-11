<?php

namespace App\Http\Livewire\Employee\Logs;

use App\Models\Audit;
use App\Models\Faq as FaqModel;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Faq extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $tab;

    public $deletedField;

    public $column = null;

    public array $columns = Audit::SEARCHABLE_FIELDS;

    public $selectedAudit;

    public $selectedAuditKey;

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status']));

        return view('livewire.employee.logs.faq', [
            'audits' => Audit::searchByKey([FaqModel::class], $this->column, request('search'))
                ->faq()
                ->filter()
                ->latest()
                ->paginate($this->perPage),
        ]);
    }

    public function openConfirmModal(Audit $audit)
    {
        $this->selectedAudit = $audit;
        [$keys, $values] = Arr::divide(array_merge($this->selectedAudit->old_values, $this->selectedAudit->new_values));
        $this->selectedAuditKey = $keys;
        $this->open();
    }
}
