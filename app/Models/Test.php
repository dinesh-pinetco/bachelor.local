<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Filters\TestFilters;
use App\Services\SelectionTests\Cubia;
use App\Services\SelectionTests\Meteor;
use App\Services\SelectionTests\Moodle;
use App\Traits\HasCourses;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Test extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes, HasCourses;

    const SEARCHABLE_FIELDS = ['name', 'description', 'duration', 'link'];

    const TYPE_MOODLE = 'moodle';

    const TYPE_CUBIA = 'cubia';

    const TYPE_METEOR = 'meteor';

    protected $fillable = ['name', 'description', 'type', 'duration', 'link', 'is_required', 'is_active'];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function types(): array
    {
        return [
            self::TYPE_MOODLE,
            self::TYPE_CUBIA,
            self::TYPE_METEOR,
        ];
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }

    protected function isActiveLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['is_active'] ? __('Active') : __('InActive');
        });
    }

    protected function isRequiredLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['is_required'] ? __('Yes') : __('No');
        });
    }

    public function scopeFilter($query)
    {
        return resolve(TestFilters::class)->apply($query);
    }

    public function scopeMatchCourses($query, $courses)
    {
        return $query->whereHas('courses', function ($q) use ($courses) {
            $q->whereIn('courses.id', $courses);
        });
    }

    public function scopeSearchByKey($query, $key, $keyword)
    {
        if ($key && $keyword) {
            return $query->where($key, 'like', "%$keyword%");
        }
    }

    public function status($user): array|string|Translator|Application|null
    {
        return __(ucfirst(str_replace('_', ' ', $this->results()->myResults($user)->value('status'))));
    }

    public function isPassed($user): array|string|Translator|Application|null
    {
        $result = $this->results()->myResults($user)->first();

        return $result->status == Result::STATUS_NOT_STARTED ? '-' : ($result->is_passed ? __('Passed') : __('Failed'));
    }

    public function getResult($user)
    {
        return $this->results()->myResults($user);
    }

    public function getTestLink($user, $otherParameter = null)
    {
        if ($user->application_status == ApplicationStatus::PROFILE_INFORMATION_COMPLETED) {
            if ($this['type'] == self::TYPE_MOODLE) {
                $moodle = (new Moodle($user));

                return $moodle->generateTestUrl();
            } elseif ($this['type'] == self::TYPE_CUBIA) {
                $cubia = (new Cubia());

                return $cubia->generateTestUrl($user, $otherParameter ?? 'MIX');
            } elseif ($this['type'] == self::TYPE_METEOR) {
                $meteor = (new Meteor($user));

                return $meteor->generateTestUrl();
            }
        }

        return null;
    }
}
