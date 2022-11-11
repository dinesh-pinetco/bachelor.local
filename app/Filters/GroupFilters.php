<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class GroupFilters extends Filter
{
    protected $filters = ['search', 'sort_by', 'question'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('internal_name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
