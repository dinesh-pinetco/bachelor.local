<?php

namespace App\Filters;

use App\Models\Field;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rjchauhan\LaravelFiner\Filter\Filter;

class AuditFilters extends Filter
{
    protected $filters = ['search', 'sort_by'];

    // protected static $ownerClass = '*';

    // public static function setOwnerClass($class) {
    //     self::$ownerClass = $class;
    // }

    public function search($keyword)
    {
        $this->builder->where(function ($query) use ($keyword) {
            $query
                ->whereHasMorph('user', '*', function (Builder $query) use ($keyword) {
                    $query->where(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'like', "%$keyword%");
                })
                // ->orWhereHasMorph('owner', $this->ownerClass, function (Builder $query, $type) use ($keyword) {
                ->orWhereHasMorph('owner', '*', function (Builder $query, $type) use ($keyword) {
                    $key = match ($type) {
                        User::class => DB::raw('CONCAT_WS(" ", first_name, last_name)'),
                        Group::class => 'title',
                        Field::class => 'label',
                        default => 'name',
                    };
                    $query->where($key, 'like', "%$keyword%");
                });
        });
    }

    public function sort_by($column)
    {
        $this->builder->orderBy($column, request('sort_type', 'asc'));
    }
}
