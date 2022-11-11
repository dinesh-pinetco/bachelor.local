<div class="flex flex-wrap gap-3 sm:gap-5">
    @foreach($field->options as $option)
    <div class="flex items-center">
        <input wire:model.lazy="fieldValue"
            {{ $isEdit ? '' : 'disabled' }}
            name="{{ $name?$name:"" }}"
            type="radio"
            id="radioButton{{ $option->key }}{{ $option->value }}"
            value="{{ $option->key }}"
            {{-- class="w-5 h-5 form-checkbox text-primary focus:ring-offset-0 focus:outline-none focus:ring-0" --}}
            class="border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-full {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
            placeholder="{{ $field->placeholder }}"
            required="{{ $field->required() }}">
        <label for="radioButton{{ $option->key }}{{ $option->value }}" class="text-xs ml-2 mb-0">{!! $option->value !!}</label>
    </div>
    @endforeach
</div>
