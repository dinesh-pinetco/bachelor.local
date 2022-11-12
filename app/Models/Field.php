<?php

namespace App\Models;

use App\Filters\FieldFilters;
use App\Relations\HasManySyncable;
use App\Traits\Field\FieldRelations;
use App\Traits\HasManySync;
use App\Traits\SetLatestSortOrder;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Field extends Model implements ContractsAuditable
{
    use AuditingAuditable, FieldRelations, SetLatestSortOrder, HasManySync;

    public const FIELD_TEXT = 'text';

    public const FIELD_NUMBER = 'number';

    public const FIELD_EMAIL = 'email';

    public const FIELD_TEL = 'tel';

    public const FIELD_TEXTAREA = 'textarea';

    public const FIELD_SELECT = 'select';

    public const FIELD_RADIO = 'radio';

    public const FIELD_CHECKBOX = 'checkbox';

    public const FIELD_FILE = 'file';

    public const FIELD_DATE = 'date';

    public const FIELD_MONTH = 'month';

    public const FIELD_MONTH_YEAR = 'month_year';

    public const FIELD_DATE_PICKER = 'date_picker';

    protected $fillable = ['tab_id', 'group_id', 'type', 'related_option_table', 'label', 'key', 'placeholder', 'sort_order', 'is_active', 'meta_data'];

    protected $casts = [
        'meta_data' => 'array',
        'is_required' => 'boolean',
    ];

    public static function types(): array
    {
        return [
            self::FIELD_TEXT,
            self::FIELD_NUMBER,
            self::FIELD_EMAIL,
            self::FIELD_TEL,
            self::FIELD_TEXTAREA,
            self::FIELD_SELECT,
            self::FIELD_RADIO,
            self::FIELD_CHECKBOX,
            self::FIELD_FILE,
            self::FIELD_DATE,
            self::FIELD_MONTH,
            self::FIELD_MONTH_YEAR,
            self::FIELD_DATE_PICKER,
        ];
    }

    public function values(): HasManySyncable
    {
        return $this->hasMany(FieldValue::class);
    }

    public function scopeFilter($query)
    {
        return resolve(FieldFilters::class)->apply($query);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function required(): bool
    {
        return $this->is_required;
    }
}
