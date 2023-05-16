<div wire:ignore>
    <x-input-tel :disabled="!$isEdit"
           wire:model="fieldValue"
           value="{{ $fieldValue }}"
           name="fieldValue"
           required="{{ $field->required() }}"></x-input-tel>
</div>
