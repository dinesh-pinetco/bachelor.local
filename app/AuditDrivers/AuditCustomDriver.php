<?php

namespace App\AuditDrivers;

use App\Models\Audit as AuditModel;
use App\Traits\AuditableFunctionKeyMap;
use App\Traits\AuditableGetValue;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\AuditDriver;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class AuditCustomDriver implements AuditDriver
{
    use AuditableFunctionKeyMap, AuditableGetValue;

    private array $filedKeys = [];

    private Collection $foreignKeyCollection;

    public function __construct()
    {
        $this->foreignKeyCollection = collect();
    }

    public function audit(Auditable $model): Audit
    {
        $auditField = $this->filter($model);
        $table = $model->getTable();
        $owner = match ($table) {
            'field_values' => $model->user,
            'contracts' => $model->user,
            'interviews' => $model->user,
            'government_forms' => $model->user,
            'study_sheets' => $model->user,
            'meteors' => $model->user,
            'moodles' => $model->user,
            'results' => $model->user,
            'media' => $model->user,
            'options' => $model->field,
            default => $model,
        };

        $auditField['owner_type'] = $owner->getMorphClass();
        $auditField['owner_id'] = $owner->getKey();

        if ($table == 'government_forms' || $table == 'study_sheets') {
            $auditField['user_type'] = $owner->getMorphClass();
            $auditField['user_id'] = $owner->getKey();
        }

        if ($table == 'results') {
            $auditField = $this->addResultCustomField($auditField, $model);
        }

        if ($auditField['old_values'] != $auditField['new_values']) {
            AuditModel::create($auditField);
        }

        return new ModelsAudit();
    }

    private function filter(Auditable $model): array
    {
        $fields = $this->filterDynamicField($model);

        $this->filedKeys = $this->filterOnlyForeignKey(array_merge_recursive($fields['old_values'], $fields['new_values']));

        $this->fetchData();

        return $this->setData($fields);
    }

    private function filterDynamicField(Auditable $model): array
    {
        if ($model->fields?->related_option_table) {
            $fields = $model->toAudit();
            $replaceKey = config('application.option_tables_key')[$model->fields->related_option_table] ?? 'value';
            $fields['old_values'] = key_replace($fields['old_values'], 'value', $replaceKey);
            $fields['new_values'] = key_replace($fields['new_values'], 'value', $replaceKey);

            return $fields;
        } else {
            return $model->toAudit();
        }
    }

    private function filterOnlyForeignKey(array $filedKeys): array
    {
        foreach ($filedKeys as $key => &$value) {
            if (! str_ends_with($key, '_id') || is_null($value)) {
                unset($filedKeys[$key]);
            } elseif (! is_array($value)) {
                $value = [$value];
            }
        }

        return $filedKeys;
    }

    private function fetchData()
    {
        if (! empty($this->filedKeys)) {
            $keys = array_keys($this->filedKeys);
            foreach ($keys as $key) {
                $this->matchFunction($key) != null ? $this->{$this->matchFunction($key)}($key, $this->filedKeys[$key]) : null;
            }
        }
    }

    private function setData(array $fields)
    {
        if (! empty($this->filedKeys)) {
            foreach ($fields as $key => &$field) {
                if ($key == 'old_values') {
                    foreach ($field as $oldKey => &$oldValue) {
                        $oldValue = $this->foreignKeyGetValue($oldKey, $oldValue);
                    }
                }
                if ($key == 'new_values') {
                    foreach ($field as $newKey => &$newValue) {
                        $newValue = $this->foreignKeyGetValue($newKey, $newValue);
                    }
                }
            }
        }

        return $fields;
    }

    private function foreignKeyGetValue($key, $value)
    {
        return isset($this->foreignKeyCollection->{$key}) ? ($this->foreignKeyCollection->{$key}->where('id', $value)->first()?->{$this->matchFunctionKey($key)} ?: $value) : $value;
    }

    private function addResultCustomField($auditField, Auditable $model)
    {
        $testArray = [
            'user'      => $model->user->fullName,
            'test'      => $model->test->name,
            'test_type' => $model->test->type,
        ];

        if (! empty($auditField['old_values'])) {
            $auditField['old_values'] = array_merge($auditField['old_values'], $testArray);
        }

        if (! empty($auditField['new_values'])) {
            $auditField['new_values'] = array_merge($auditField['new_values'], $testArray);
        }

        return $auditField;
    }

    public function prune(Auditable $model): bool
    {
        return false;
    }
}
