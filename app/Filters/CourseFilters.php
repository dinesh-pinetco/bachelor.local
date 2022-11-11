<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class CourseFilters extends Filter
{
    protected $filters = ['search', 'sort_by'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->orWhere('first_start', 'like', "%$keyword%")
                ->orWhere('last_start', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
