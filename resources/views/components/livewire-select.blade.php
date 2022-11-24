@props([
    'name' => null,
    'model' => null,
    'value' => null,
    'dataCy' => null,
    'shouldSave' => false,
    'isEdit' => true,
    'isTab' => false,
    'isMultiselect' => false
    ])
<select @if ($name!=null) name="{{ $name }}" @endif @if ($model!=null) wire:model.lazy="{{ $model }}" @endif @if ($dataCy!=null) data-cy="{{ $dataCy }}" @endif
{{ $isEdit ? '' : 'disabled' }}
{{ $isMultiselect ? 'multiple' : '' }}
    @if ($isTab) onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" @endif
    class=" h-11 py-2.5 text-sm md:text-base pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm w-full placeholder-gray  {{ $isEdit ? 'cursor-pointer text-primary' : 'text-gray cursor-not-allowed' }}">
    {{ $slot }}
</select>
