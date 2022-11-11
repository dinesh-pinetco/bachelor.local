<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class TestFilters extends Filter
{
    protected $filters = ['search', 'sort_by', 'duration'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->orWhere('duration', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }

    public function duration($duration)
    {
        $this->builder->where('duration', $duration);
    }
}
