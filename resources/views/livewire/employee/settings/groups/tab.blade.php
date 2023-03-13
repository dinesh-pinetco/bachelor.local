<div>
    <div class="hidden sm:block">
        <div class="flex space-x-4 tabs overflow-x-auto">
            <nav class="flex space-x-4" aria-label="Tabs">
                @foreach($tabs as $tabData)
                    <a
                        href="{{ route('employee.settings.groups.index',['tab' => $tabData->slug ]) }}"
                        @class([
                            'inline-flex items-center text-sm leading-5 hover:text-white
                            focus:outline-none focus:text-white transition
                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                            leading-snug transition duration-200 ease-in-out rounded-sm',
                            'text-primary bg-lightgray' => !$tabData->is($tab),
                            'bg-primary text-white' => $tabData->is($tab)
                        ])
                    >
                        <x-svg-icon size="small" :type="$tabData->icon" :active="$tabData->is($tab)" />
                        <span>{{ __($tabData->name) }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
    <div class="block sm:hidden">
        <x-livewire-select isTab=true>
            @foreach($tabs as $tabData)
                <option {{ $tabData->is($tab) ? 'selected' : '' }}
                    value="{{ route('employee.settings.groups.index',['tab' => $tabData->slug ]) }}">{{ __($tabData->name) }}
                </option>
            @endforeach
        </x-livewire-select>
    </div>
</div>
