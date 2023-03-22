<?php

namespace App\Models;

use App\Traits\UserDataUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Result extends Model implements ContractsAuditable
{
    use AuditingAuditable, UserDataUpdate, HasFactory;

    const STATUS_NOT_STARTED = 'not_started';

    const STATUS_STARTED = 'started';

    const STATUS_FAILED = 'failed';

    const STATUS_COMPLETED = 'completed';

    protected $guarded = [];

    protected $casts = [
        'is_passed' => 'boolean',
        'passed_by_nak' => 'boolean',
        'is_passed_mix' => 'boolean',
        'is_passed_iqt' => 'boolean',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMyResults($query, User $user = null)
    {
        $user = $user ?? auth()->user();

        return $query->where('user_id', $user->id);
    }

    public function updateTestResult($grade, $result, $meta)
    {
        if ($this->test->has_passing_limit) {
            $is_passed = $grade >= $this->test->passing_limit;

            $this->update([
                'status' => $is_passed ? self::STATUS_COMPLETED : self::STATUS_FAILED,
                'is_passed' => $is_passed,
                'result' => $result,
                'meta' => $meta,
                'completed_at' => now(),
            ]);
        } else {
            $this->update([
                'status' => $grade ? self::STATUS_COMPLETED : self::STATUS_FAILED,
                'is_passed' => $grade,
                'completed_at' => now(),
            ]);
        }

        $this->user->saveApplicationStatus();
    }

    public function isMoodleTest(): bool
    {
        return $this->test->type == Test::TYPE_MOODLE;
    }

    public function isCubiaTest(): bool
    {
        return $this->test->type == Test::TYPE_CUBIA;
    }

    public function isMeteoTest(): bool
    {
        return $this->test->type == Test::TYPE_METEOR;
    }
}
