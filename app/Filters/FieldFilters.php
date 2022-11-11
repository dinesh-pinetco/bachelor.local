<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class FieldFilters extends Filter
{
    protected $filters = ['search', 'sort_by', 'question'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('label', 'like', "%$keyword%")
                ->orWhere('type', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
