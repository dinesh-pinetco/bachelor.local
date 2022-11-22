@props([
    'options' => [],
    'keyBy' => null,
    'labelBy' => null,
    'placeholder' => null,
    'value' => [],
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
    'disabled'=> false
])

@php
    if ($value && count($value)) {
           $placeholder = data_get(collect($options)->whereIn($keyBy, $value)->first(), $labelBy);
           $totalSelected = count($value);

           if ($totalSelected > 1) {
               $placeholder = __(':label + :number more', ['label' => $placeholder, 'number' => $totalSelected - 1]);
           }
     }else{
        $placeholder = $placeholder ?? __('--Select--');
       }
@endphp

<div x-cloak
     x-data="{
        open: false,
        toggle() {
            if (this.open) {
                return this.close()
            }

            this.$refs.button.focus()

            this.open = true
        },
        close(focusAfter) {
            if (! this.open) return

            this.open = false

            focusAfter && focusAfter.focus()
        },
    }"
     x-on:keydown.escape.prevent.stop="close($refs.button)"
     x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
     x-id="['multiselect']"
>
    <div class="relative">
        <button
            :disabled="{{ $disabled }}"
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('multiselect')"
            aria-haspopup="listbox"
            aria-labelledby="listbox-label"
            type="button"
            @class([
                "text-gray cursor-not-allowed" => $disabled,
                "text-primary cursor-pointer" => !$disabled,
                "relative w-full text-left h-11 py-2.5 px-4 border border-gray bg-white py-2 pl-3 pr-10 focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base placeholder-gray"
                ])>
            <span class="block truncate">
                {{ $placeholder }}
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <!-- Heroicon name: mini/chevron-up-down -->
                <svg class="h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </span>
        </button>

        <!--
          Select popover, show/hide based on select state.

          Entering: ""
            From: ""
            To: ""
          Leaving: "transition ease-in duration-100"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <ul x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('multiselect')"
            tabindex="-1"
            role="listbox"
            aria-labelledby="listbox-label"
            aria-activedescendant="listbox-option-3"
            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
            <!--
              Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

              Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
            -->
            @forelse($options as $option)
                <li class="text-primary relative cursor-default select-none py-2 pl-8 pr-4" id="listbox-option-0"
                    role="option">
                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                    <label for="{{ data_get($option,$keyBy) }}"
                           class="font-normal block truncate">
                        {{ data_get($option, $labelBy) }}
                    </label>

                    <!--
                      Checkmark, only display for selected option.

                      Highlighted: "text-white", Not Highlighted: "text-indigo-600"
                    -->
                    <span class="text-primary absolute inset-y-0 left-0 flex items-center pl-1.5">
                        <input type="checkbox"
                               id="{{ data_get($option,$keyBy) }}"
                               value="{{ data_get($option,$keyBy) }}"
                               {{ $attributes->wire('model') }}
                               name="{{ $attributes->get('name') }}[]"
                               {{ in_array(data_get($option,$keyBy), $value) ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-primary-light text-primary focus:ring-primary">
                    </span>
                </li>
            @empty
                <li x-on:click="toggle()"
                    class="text-primary relative cursor-default select-none py-2 pl-8 pr-4" id="listbox-option-0"
                    role="option">
                    {{ __('No data found') }}
                </li>
            @endforelse
        </ul>
    </div>
</div>
