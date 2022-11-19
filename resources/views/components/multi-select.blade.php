@props([
    'options' => [],
    'keyBy' => null,
    'labelBy' => null,
    'value' => [],
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
    'searchable' => false
])

<div wire:ignore
     x-data="{
        open: false,
        @if($wireModel)
            value: @entangle($attributes->wire('model')),
        @else
            value: @js($value),
        @endif
        keyBy: @js($keyBy),
        labelBy: @js($labelBy),
        options: @js($options),
        filteredOptions: @js($options),
        placeholder: @js($attributes->get('placeholder')),
        search: '',
        init() {
            this.setPlaceholder();

            this.$watch('search', () => this.filterOptions());
            this.$watch('value', () => this.setPlaceholder());
        },
        setPlaceholder() {
            if(this.value && this.value.length) {
                this.placeholder = this.getLabel(this.options.find(option => this.getKey(option) === (isNaN(this.value[0]) ? this.value[0] : parseInt(this.value[0]))));

                let totalSelected = this.value.length;

                if(totalSelected > 1) {
                    this.placeholder += ` + ${totalSelected-1} more`;
                }
            } else {
                this.placeholder = @js($attributes->get('placeholder'));
            }
        },
        filterOptions() {
            if (this.search) {
                let keywords = this.search.toLowerCase().split(' ');

                this.filteredOptions = this.options.filter(option => {
                    let value = this.getLabel(option).toLowerCase();

                    return keywords.filter(keyword => keyword && value.search(keyword) > -1).length > 0;
                });
            } else {
                this.filteredOptions = this.options;
            }
        },
        getKey(option) {
            return option[this.keyBy];
        },
        getLabel(option) {
            return option[this.labelBy];
        },
        toggle() {
            this.search = '';

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
        }
    }"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
    x-id="['multiselect']"
>
    {{-- <label id="listbox-label" class="block text-sm font-medium text-gray-700"></label> --}}
    <div class="relative mt-1">
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('multiselect')"
            aria-haspopup="listbox"
            aria-labelledby="listbox-label"
            type="button"
            class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
        >
            <span class="block truncate" x-text="placeholder"></span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <!-- Heroicon name: mini/chevron-up-down -->
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
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
            style="display: none"
            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white p-2 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        >
            <li class="pb-2" x-show="@js($searchable)">
                <input type="text"
                       x-model="search"
                       placeholder="Search"
                       class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
            </li>

            <template x-for="option in filteredOptions" :key="getKey(option)">
                <li role="option"
                    class="text-gray-900 relative cursor-default select-none py-1 pl-8 pr-4">
                    <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                    <label :for="getKey(option)"
                           class="font-normal block truncate"
                           x-text="getLabel(option)"
                    ></label>

                    <span class="text-indigo-600 absolute inset-y-0 left-0 flex items-center pl-1.5">
                        <input type="checkbox"
                            x-ref="input"
                            x-model="value"
                            @if($name = $attributes->get('name'))
                                name="{{ $name }}"
                            @endif
                            :id="getKey(option)"
                            :value="getKey(option)"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        >
                    </span>
                </li>
            </template>
        </ul>
    </div>
</div>
