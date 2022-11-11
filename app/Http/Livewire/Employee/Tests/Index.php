<?php

namespace App\Http\Livewire\Employee\Tests;

use App\Models\Test;
use App\Traits\Livewire\HasModal;
use App\Traits\Livewire\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithDataTable, HasModal;

    public $deletedTest;

    public $column = null;

    public array $columns = Test::SEARCHABLE_FIELDS;

    public function openConfirmModal(Test $test)
    {
        $this->open();
        $this->deletedTest = $test;
    }

    public function delete()
    {
        $this->deletedTest->delete();
        $this->reset('show', 'deletedTest');
        $this->render();
    }

    public function render()
    {
        request()->merge($this->only(['sort_by', 'sort_type', 'search', 'status', 'column']));

        return view('livewire.employee.tests.index', [
            'tests' => Test::searchByKey($this->column, request('search'))->filter()->paginate($this->perPage),
        ]);
    }
}
