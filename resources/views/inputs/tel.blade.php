<div wire:ignore>
    <x-tel :disabled="!$isEdit"
           wire:model="fieldValue"
           value="{{ $fieldValue }}"
           name="fieldValue"
           required="{{ $field->required() }}"></x-tel>
</div>
