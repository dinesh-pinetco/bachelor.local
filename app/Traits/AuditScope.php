<?php

namespace App\Traits;

use App\Models\ContactProfile;
use App\Models\Course;
use App\Models\Document;
use App\Models\Faq;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Group;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\DB;

trait AuditScope
{
    public function scopeSearchByKey($query, $class, $column, $keyword)
    {
        if ($column && $keyword) {
            return $query
                ->when($column == 'user', function ($q) use ($column, $keyword) {
                    $q->whereHasMorph($column, '*', function (Builder $query) use ($keyword) {
                        $query->where(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'like', "%$keyword%");
                    });
                }, function ($q) use ($class, $column, $keyword) {
                    $q->whereHasMorph($column, $class, function (Builder $query, $type) use ($keyword) {
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
    }

    public function scopeApplicant($query)
    {
        return $query
            ->with(['user', 'owner', 'auditable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    FieldValue::class => ['fields'],
                ]);
            }])
            ->whereHasMorph(
                'owner',
                [User::class],
                function (Builder $query) {
                    $query->role(ROLE_APPLICANT);
                }
            )
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeCourse($query)
    {
        return $query
            ->with(['user', 'owner'])
            ->whereIn('owner_type', [Course::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeDocument($query)
    {
        return $query
            ->with(['user', 'owner'])
            ->whereIn('owner_type', [Document::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeTest($query)
    {
        return $query
            ->with(['user', 'owner'])
            ->whereIn('owner_type', [Test::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeGroup($query)
    {
        return $query
            ->with(['user', 'owner' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    Field::class => ['tab'],
                ]);
            }])
            ->whereIn('owner_type', [Group::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeSetting($query)
    {
        return $query
            ->with(['user', 'owner' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    Field::class => ['tab'],
                ]);
            }])
            ->whereIn('owner_type', [Field::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeContactProfile($query)
    {
        return $query
            ->with(['user', 'owner'])
            ->whereIn('owner_type', [ContactProfile::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }

    public function scopeFaq($query)
    {
        return $query
            ->with(['user', 'owner'])
            ->whereIn('owner_type', [Faq::class])
            ->whereNotNull('old_values')->whereNotNull('new_values');
    }
}
