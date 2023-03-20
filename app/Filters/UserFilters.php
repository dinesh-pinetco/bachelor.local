<?php

namespace App\Filters;

use App\Models\Field;
use Rjchauhan\LaravelFiner\Filter\Filter;

class UserFilters extends Filter
{
    protected $filters = ['search', 'sort_by', 'selectedStatuses', 'desiredBeginning', 'courses', 'postalCode', 'location', 'listedmaketplace', 'lastChangedBefore', 'lastChangedAfter'];

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

    public function postalCode($keyword)
    {
        $postalKey = Field::where('key', 'postal_code')->first()?->id;
        $this->builder->whereHas('values', function (\Illuminate\Database\Eloquent\Builder $query) use ($postalKey, $keyword) {
            $query->where('field_id', $postalKey)->where('value', 'like', "%$keyword%");
        });
    }

    public function listedmaketplace($value)
    {
        if ($value == 'yes') {
            logger('true martket place ', ['value' => $value]);
            $this->builder->whereNotNull('show_application_on_marketplace_at');
        } elseif ($value == 'no') {
            logger('false martket place ');
            $this->builder->whereNotNull('reject_marketplace_application_at');
        }
    }

    public function location($keyword)
    {
        $locationKey = Field::where('key', 'location')->first()?->id;
        $this->builder->whereHas('values', function (\Illuminate\Database\Eloquent\Builder $query) use ($locationKey, $keyword) {
            $query->where('field_id', $locationKey)->where('value', 'like', "%$keyword%");
        });
    }

    public function lastChangedBefore($timestamps)
    {
        $this->builder->where('last_data_updated_at', '>=', $timestamps);
    }

    public function lastChangedAfter($timestamps)
    {
        $this->builder->where('last_data_updated_at', '<=', $timestamps);
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
        $this->builder->whereHas('courses', function ($query) use ($courses) {
            $query->whereIn('course_id', $courses);
        });
    }
}
