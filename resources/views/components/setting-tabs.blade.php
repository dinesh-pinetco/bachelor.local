<div>
    <div class="hidden sm:block">
        <div class="flex space-x-4 tabs overflow-x-auto">
            <nav class="flex space-x-4" aria-label="Tabs">
                @foreach (Tab::orderBy('sort_order', 'ASC')->get() as $tab)
                    <a href="{{ route('employee.settings.fields.index', ['tab' => $tab->slug]) }}"
                        @class([
                            'inline-flex items-center text-sm leading-5 hover:text-white
                            focus:outline-none focus:text-white transition
                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                            leading-snug transition duration-200 ease-in-out rounded-sm',
                            'text-primary bg-lightgray' => !$tab->is(request()->route('tab')),
                            'bg-primary text-white' => $tab->is(request()->route('tab')),
                        ])>
                        <x-svg-icon size="small" :type="$tab->icon" :active="$tab->is(request()->route('tab'))" />
                        <span>{{ __($tab->name) }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
    <div class="block sm:hidden">
        <x-livewire-select isTab=true>
            @foreach (Tab::orderBy('sort_order', 'ASC')->get() as $tab)
                <option {{ $tab->is(request()->route('tab')) ? 'selected' : '' }}
                    value="{{ route('employee.settings.fields.index', ['tab' => $tab->slug]) }}">{{ __($tab->name) }}
                </option>
            @endforeach
        </x-livewire-select>
    </div>
</div>
