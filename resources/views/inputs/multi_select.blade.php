<ul class="flex flex-wrap items-start">
    @if(!is_null($field->related_option_table))
        @if ($field->related_option_table == 'courses')
            <x-multi-select
                :value="$fieldValue"
                :key="time() . 'courseMultiSelect'"
                wire:model="fieldValue"
                :placeholder="!is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)))"
                :options="$courseOptions"
                keyBy="id"
                labelBy="name"
                :disabled="!$isEdit"
            />
        @elseif ($field->related_option_table == 'desired_beginnings')
            <x-multi-select
                :value="$fieldValue"
                :key="time() . 'desiredBeginningMultiSelect'"
                wire:model="fieldValue"
                :placeholder="!is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)))"
                :options="$desiredBeginningOptions"
                keyBy="id"
                labelBy="name"
                :disabled="!$isEdit"
            />
        @else
            @php
            $placeholder = !is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)));
            @endphp
            <x-multi-select
                :value="$fieldValue"
                :key="time()"
                wire:model="fieldValue"
                :placeholder="$placeholder"
                :options="$this->getOptionsByModel($field->related_option_table)"
                keyBy="id"
                labelBy="name"
                :disabled="!$isEdit"
            />
        @endif
    @else
        <x-multi-select
            :value="$fieldValue"
            :key="time()"
            wire:model="fieldValue"
            :placeholder="!is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)))"
            :options="$field->options->toArray()"
            keyBy="key"
            labelBy="value"
            :disabled="!$isEdit"
        />
    @endif
</ul>
