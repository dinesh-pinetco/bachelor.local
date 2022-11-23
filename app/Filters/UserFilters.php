<?php

namespace App\Filters;

use Rjchauhan\LaravelFiner\Filter\Filter;

class UserFilters extends Filter
{
    protected $filters = ['search', 'sort_by', 'selectedStatuses', 'desiredBeginning', 'courses'];

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query->where('first_name', 'like', "%$keyword%")
                ->orWhere('last_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                // ->orWhere('status', 'like', "%$keyword%")
                ->orWhere('phone', 'like', "%$keyword%");
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }

    public function selectedStatuses($column)
    {
        $this->builder->whereIn('application_status', $column);
    }

    public function desiredBeginning($desiredBeginning)
    {
        $this->builder->whereHas('desiredBeginning', function ($query) use ($desiredBeginning) {
            $query->where('course_start_date', $desiredBeginning);
        });
    }

    public function courses($courses)
    {
        $this->builder->whereHas('desiredBeginning.courses', function ($query) use ($courses) {
            $query->whereIn('courses.id', $courses);
        });
    }
}
