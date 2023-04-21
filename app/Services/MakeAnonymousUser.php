<?php

namespace App\Services;

use App\Models\Field;
use App\Models\FieldValue;
use App\Models\User;
use App\Traits\Makeable;

class MakeAnonymousUser
{
    use Makeable;

    public function __construct(protected User $user)
    {
    }

    public function execute(): void
    {
        $this->user->update([
            'first_name' => null,
            'last_name' => null,
        ]);

        $fieldKeys = ['date_of_birth', 'first_name', 'last_name'];
        $fieldIds = Field::whereIn('key', $fieldKeys)->pluck('id', 'key');

        $fieldValues = collect([
            ['field_id' => $fieldIds['date_of_birth'], 'value' => null],
            ['field_id' => $fieldIds['first_name'], 'value' => null],
            ['field_id' => $fieldIds['last_name'], 'value' => null]
        ]);

        $fieldValues->each(function ($fieldValue) {
            FieldValue::updateOrCreate([
                'user_id' => $this->user->id,
                'field_id' => $fieldValue['field_id'],
            ], [
                'value' => $fieldValue['value'],
            ]);
        });
    }
}
