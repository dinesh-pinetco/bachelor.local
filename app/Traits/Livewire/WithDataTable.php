<?php

namespace App\Traits\Livewire;

trait WithDataTable
{
    public int $perPage = 10;

    public string $search = '';

    public $sort_by;

    public $sort_type;

    public function mountWithSorting(): void
    {
        $this->sort_by = null;
        $this->sort_type = null;
    }

    public function hydrateWithSorting(): void
    {
        $this->queryString = array_merge($this->queryString, [
            'sort_by', 'sort_type',
        ]);
    }

    public function sort($sort_by): void
    {
        $this->sort_by = $sort_by;
        $this->sort_type = $this->sort_type === 'asc' ? 'desc' : 'asc';
    }
}
