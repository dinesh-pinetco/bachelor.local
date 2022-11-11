<?php

namespace App\Services;

use App\Models\Field;
use App\Models\User;

class SyncUserValue
{
    protected User $user;

    protected array $insertKeys = ['first_name', 'last_name', 'email', 'phone'];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(): void
    {
        foreach ($this->insertKeys as $key) {
            $this->fieldInsert($key, $this->user[$key]);
        }

        $this->fieldInsert('course_id', $this->user->course()->first()->course_id);

        $this->fieldInsert('desired_beginning_id', $this->user->course()->first()->desired_beginning_id);
    }

    protected function fieldInsert($key, $value): void
    {
        if ($field = Field::where('key', $key)->first()) {
            $this->user->values()->create([
                'field_id' => $field->id,
                'group_key' => $this->user->id.$field->group_id.'0',
                'value' => $value,
            ]);
        }
    }

    public function updateUserValue($key, $value): void
    {
        if (in_array($key, $this->insertKeys)) {
            $this->user[$key] = $value;
            $this->user->save();
        }
    }
}
