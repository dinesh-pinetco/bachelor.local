<input wire:model.lazy="fieldValue"
       wire:key="{{uuid()}}"
       {{ $isEdit ? '' : 'disabled' }}
       name="{{ $name?$name:"" }}"
       type="text"
       class="h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base placeholder-gray w-full {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
       placeholder="{{ $field->placeholder }}"
       required="{{ $field->required() }}">
