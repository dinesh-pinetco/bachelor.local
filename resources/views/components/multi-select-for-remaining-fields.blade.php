@props(['name' => null, 'value' => 'id', 'label' => 'name', 'options' => [], 'searchable' => false, 'emptyOptionlabel' => __('No options Available'), 'summeryText' => null, 'placeholder'=>'Select '.Str::ucfirst(Str::replace('_', ' ', $name))])
<div
    class="relative focus-within:ring focus-within:ring-primary-light focus-within:ring-opacity-50 focus-within:shadow-sm outline-none"
    x-cloak x-data="{ open: false }" x-init="$watch('open', value => focusSearch(value))">
    <div @click="open = true" data-cy="multiple-dropdown-box"
         class="h-11 multiple-dropdown-box px-3 py-2.5 text-left bg-transparent border rounded-sm cursor-pointer border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none">
        <label class="block w-full text-sm md:text-base font-normal cursor-pointer text-primary">
            {{ !empty($summeryText) ? $summeryText : __($placeholder) }}
        </label>
        <span class="absolute top-0 flex items-center h-full right-3">
            <svg class="h-4 w-5 text-lightgray stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path
                    d="M360.5 217.5l-152 143.1C203.9 365.8 197.9 368 192 368s-11.88-2.188-16.5-6.562L23.5 217.5C13.87 208.3 13.47 193.1 22.56 183.5C31.69 173.8 46.94 173.5 56.5 182.6L192 310.9l135.5-128.4c9.562-9.094 24.75-8.75 33.94 .9375C370.5 193.1 370.1 208.3 360.5 217.5z"/>
            </svg>
        </span>
    </div>
    <div x-show.transition="open" @click.away="open = false"
         class="absolute left-0 z-40 w-full h-auto mt-2 bg-white border rounded-sm shadow-md border-gray top-full">
        @if ($searchable)
            <div class="relative w-full p-4">
                <span class="absolute top-0 flex items-center h-full text-gray-medium left-8"><i
                        class="fal fa-search"></i></span>
                <input type="text" id='search-input' wire:model.debounce.200ms='search'
                       placeholder="{{ __('Type to Search') }} ..."
                       class="pl-10 mt-0">
            </div>
        @endif
        <ul class="h-auto px-4 pb-4 overflow-y-auto divide-y max-h-60 divide-gray">
            <!-- Select All Checkbox Start -->
        {{-- <li class="flex items-center py-2 space-x-2">
            <input type="checkbox" id="select-all" class="rounded-sm border-gray-medium focus:ring-0">
            <label for="select-all" class="font-normal text-gray-medium truncate cursor-pointer">Select All</label>
        </li> --}}
        <!-- Select All Checkbox End -->
            @forelse ($options as $option)
                <li class="flex items-center py-2 space-x-2">
                    <input name="{{ $name }}" wire:model="{{ $name }}.{{ $option }}" type="checkbox"
                           id="{{ $option }}"
                           value="{{ $option }}"
                           class="rounded-sm w-4 h-4 text-primary focus:ring focus:ring-primary-light focus:ring-opacity-50">
                    <label for="{{ $option }}"
                           class="text-sm text-darkgray font-normal truncate cursor-pointer">{{ __($option) }}</label>
                </li>
            @empty
                <li class="text-center pt-4">
                    <label class="text-sm font-normal text-primary truncate">{{ $emptyOptionlabel }}</label>
                </li>
            @endforelse
        </ul>
    </div>
    <script>
        function focusSearch(value) {
            if (value === true) {
                var interval = setInterval(function () {
                    if (document.getElementById('search-input') === document.activeElement) {
                        clearInterval(interval);
                    }
                }, 100);
            }
        }
    </script>
</div>
