<ul @class([
        'flex flex-wrap items-start -mx-4' => count($field->options) <= 1,
        'grid grid-cols-2 gap-4 -mx-4' => count($field->options) > 1
])>
    @foreach($field->options as $option)
        <li class="px-4">
            <div class="relative">
                <label
                    class="block w-full text-sm {{ $isEdit ? 'text-primary cursor-pointer' : 'cursor-not-allowed' }}">
                    <div class="flex items-start space-x-2">
                        <input type="checkbox"
                               id="{{ data_get($option, 'key') }}"
                               value="{{ data_get($option, 'key') }}"
                               wire:model="fieldValue"
                               name="fieldValue"
                               {{ in_array(data_get($option,'key'), $fieldValue) ? 'checked' : '' }}
                               class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}">
                        <span
                            class="checkbox-label flex-grow {{ ($field->is_required && !$field->label) ? 'required': '' }}">{!! $option->value !!}</span>
                    </div>

                </label>
            </div>
        </li>
    @endforeach
</ul>
