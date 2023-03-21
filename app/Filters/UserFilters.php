<?php

namespace App\Filters;

use App\Models\Field;
use Rjchauhan\LaravelFiner\Filter\Filter;

class UserFilters extends Filter
{
    protected $filters = ['search', 'vorname', 'sort_by', 'selectedStatuses', 'desiredBeginning',
        'bewerbungenJahr', 'courses', 'postalCode',
        'isAnonymisiert',
        'location', 'listedmaketplace', 'lastChangedBefore', 'lastChangedAfter', ];

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

    public function vorname($keyword)
    {
        $this->builder->where('first_name', 'like', "%$keyword%");
    }

    public function nachname($keyword)
    {
        $this->builder->where('last_name', 'like', "%$keyword%");
    }

    public function postalCode($keyword)
    {
        $postalKey = Field::where('key', 'postal_code')->value('id');
        $this->builder->whereHas('values', function (\Illuminate\Database\Eloquent\Builder $query) use ($postalKey, $keyword) {
            $query->where('field_id', $postalKey)->where('value', 'like', "%$keyword%");
        });
    }

    public function isAnonymisiert($data)
    {
        $value = ($data == API_PARAM_FOR_TRUE) ? true : (($data == API_PARAM_FOR_FALSE) ? false : null);

        $anonymousKeyId = Field::where('key', 'is_anonymous')->value('id');
        $this->builder->whereHas('values', function (\Illuminate\Database\Eloquent\Builder $query) use ($anonymousKeyId, $value) {
            $query->where('field_id', $anonymousKeyId)
                ->where('value', $value);
        });
    }

    public function listedmaketplace($value)
    {
        $this->builder->when($value == API_PARAM_FOR_TRUE, function ($q) {
            $q->whereNotNull('show_application_on_marketplace_at');
        })->when($value == API_PARAM_FOR_FALSE, function ($q) {
            $q->whereNotNull('reject_marketplace_application_at');
        });
    }

    public function location($keyword)
    {
        $locationKey = Field::where('key', 'location')->value('id');
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

    public function bewerbungenJahr($desiredBeginning)
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
