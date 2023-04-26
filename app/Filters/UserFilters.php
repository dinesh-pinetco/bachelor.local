<?php

namespace App\Filters;

use App\Models\Field;
use Rjchauhan\LaravelFiner\Filter\Filter;

class UserFilters extends Filter
{
    protected $filters = [
        'search',
        'vorname',
        'nachname',
        'sort_by',
        'selectedStatuses',
        'desiredBeginning',
        'bewerbungenJahr',
        'courses',
        'postalCode',
        'isAnonymisiert',
        'location',
        'listedmaketplace',
        'last_changed_gte',
        'last_changed_lte',
    ];

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

    public function isAnonymisiert($value)
    {
        $value = setBoolValueForAPI($value);

        $this->builder->whereHas('configuration', function ($query) use ($value) {
            $query->where('competency_catch_up', $value);
        });
    }

    public function listedmaketplace($value)
    {
        $value = setBoolValueForAPI($value);

        $this->builder->when($value, function ($q) {
            $q->whereNotNull('show_application_on_marketplace_at');
        })->when(! $value, function ($q) {
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

    public function last_changed_gte($timestamps)
    {
        $this->builder->where('last_data_updated_at', '>=', $timestamps);
    }

    public function last_changed_lte($timestamps)
    {
        $this->builder->where('last_data_updated_at', '<=', $timestamps);
    }

    public function sort_by($column)
    {
        $translatedColumn = translateColumnName($column);
        if ($translatedColumn) {
            $this->builder->orderBy($translatedColumn, request('sort_type', 'asc'));
        }
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
