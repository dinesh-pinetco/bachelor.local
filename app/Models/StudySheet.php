<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class StudySheet extends Model implements ContractsAuditable
{
    use AuditingAuditable;

    const PAYMENT_INSTALLMENT = 1;

    const PAYMENT_TOTAL = 2;

    const ADDRESS_MAIN_ADDRESS = 1;

    const ADDRESS_CUSTOM_ADDRESS = 2;

    const HEALTH_INSURANCE_LEGAL = 1;

    const HEALTH_INSURANCE_PRIVATE = 2;

    const HEALTH_INSURANCE_OTHER = 1;

    protected $casts = [
        'custom_billing_address' => 'array',
        'custom_delivery_address' => 'array',
        'is_authorize' => 'boolean',
        'is_submit' => 'boolean',
    ];

    public static function payments(): array
    {
        return [
            self::PAYMENT_INSTALLMENT,
            self::PAYMENT_TOTAL,
        ];
    }

    public static function healthInsuranceTypes(): array
    {
        return [
            self::HEALTH_INSURANCE_LEGAL,
            self::HEALTH_INSURANCE_PRIVATE,
        ];
    }

    public static function address(): array
    {
        return [
            self::ADDRESS_MAIN_ADDRESS,
            self::ADDRESS_CUSTOM_ADDRESS,
        ];
    }

    protected function studentIdCardPhotoUrl(): Attribute
    {
        return Attribute::get(function ($value,$attribute) {
            return !is_null($attribute['student_id_card_photo']) ? Storage::url($attribute['student_id_card_photo']) : null;
        });
    }

    public function health_insurance_companies(): BelongsTo
    {
        return $this->belongsTo(HealthInsuranceCompany::class, 'health_insurance_company_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
