<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class DesiredBeginningFilters extends Filter
{
    protected $filters = ['search', 'sort_by'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('course_start_date', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
