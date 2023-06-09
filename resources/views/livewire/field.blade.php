<div>
    @if ($field->label)
        <label for="">{{ $field->label }}
            @if ($field->is_required)
                <span class="text-red font-bold"> &nbsp;*</span>
            @endif
            @if (! $field->is_required)
                <span class="text-xs text-darkgray">{{ __("(Optional)") }}</span>
            @endif
        </label>
    @endif

    @if ($field->type === App\Enums\FieldType::FIELD_DATE())
        <livewire:date :isEdit="$isEdit" :groupKey="$groupKey" :field="$field" :key="time() . $field->id" :applicant="$applicant" />
        @include('inputs.error-message', [
            'field' => $field,
            'validation_errors' => $validation_errors,
        ])
        <x-jet-input-error for="fieldValue" />
    @elseif($field->type === App\Enums\FieldType::FIELD_MONTH())
        <livewire:date :isEdit="$isEdit" :groupKey="$groupKey" :field="$field" :key="time() . $field->id" hiddenFields="day,year"
            :applicant="$applicant" />
        @include('inputs.error-message', [
            'field' => $field,
            'validation_errors' => $validation_errors,
        ])
    @elseif($field->type === App\Enums\FieldType::FIELD_MONTH_YEAR())
        <livewire:date :isEdit="$isEdit" :groupKey="$groupKey" :field="$field" :key="time() . $field->id" hiddenFields="day"
            :applicant="$applicant" />
        @include('inputs.error-message', [
            'field' => $field,
            'validation_errors' => $validation_errors,
        ])
    @else
        @if (view()->exists("inputs.{$field->type}"))
            @include("inputs.{$field->type}", [
                'field' => $field,
                'isEdit' => $isEdit,
                'name' => $field->key,
            ])
            <x-jet-input-error for="fieldValue" />
        @else
            <span class="font-medium text-sm text-red-500">
                INPUT TYPE {{ $field->type }} NOT FOUND
            </span>
        @endif
    @endif
</div>
