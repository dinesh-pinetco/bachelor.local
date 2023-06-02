<x-input-tel  wire:model="fieldValue"
              value="{{ $fieldValue }}"
              required="{{ $field->required() }}"
              class="block w-full"
              placeholder="{{ __('Enter phone number') }}"
              :disabled="!$isEdit"
/>
