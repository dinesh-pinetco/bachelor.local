<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class ContactProfileFilters extends Filter
{
    protected $filters = ['search', 'sort_by'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('phone', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
