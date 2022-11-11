<textarea
    wire:model.lazy="fieldValue"
    {{ $isEdit ? '' : 'disabled' }}
    class="w-full text-sm md:text-base border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-gray placeholder-gray shadow-sm {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
    placeholder="{{ $field->placeholder }}"
    rows="8"
    required="{{ $field->required() }}">
</textarea>
