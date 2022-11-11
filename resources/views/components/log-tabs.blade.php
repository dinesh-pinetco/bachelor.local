<div>
    <div class="hidden sm:block">
        <div class="flex space-x-4 tabs overflow-x-auto">
            <nav class="flex space-x-4" aria-label="Tabs">
                <a href="{{ route('employee.logs.applicants') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.applicants'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.applicants'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.applicants')" />
                    <span>{{ __('Applicant') }}</span>
                </a>
                <a href="{{ route('employee.logs.courses') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.courses'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.courses'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.courses')" />
                    <span>{{ __('Course') }}</span>
                </a>
                <a href="{{ route('employee.logs.documents') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.documents'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.documents'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.documents')" />
                    <span>{{ __('Document') }}</span>
                </a>
                <a href="{{ route('employee.logs.tests') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.tests'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.tests'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.tests')" />
                    <span>{{ __('Test') }}</span>
                </a>
                <a href="{{ route('employee.logs.groups') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.groups'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.groups'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.groups')" />
                    <span>{{ __('Group') }}</span>
                </a>
                <a href="{{ route('employee.logs.settings') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.settings'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.settings'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.settings')" />
                    <span>{{ __('Setting') }}</span>
                </a>
                <a href="{{ route('employee.logs.contact-profiles') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.contact-profiles'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.contact-profiles'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.contact-profiles')" />
                    <span>{{ __('Contact Profile') }}</span>
                </a>
                <a href="{{ route('employee.logs.faq') }}" @class([
                    'inline-flex items-center text-sm leading-5 hover:text-white
                                            focus:outline-none focus:text-white transition
                                            flex-shrink-0 whitespace-nowrap px-4 py-2 text-base hover:bg-primary
                                            leading-snug transition duration-200 ease-in-out rounded-sm',
                    'text-primary bg-lightgray' => !request()->routeIs('employee.logs.faq'),
                    'bg-primary text-white' => request()->routeIs('employee.logs.faq'),
                ])>
                    <x-svg-icon size="small" :active="request()->routeIs('employee.logs.faq')" />
                    <span>{{ __('Faq') }}</span>
                </a>
            </nav>
        </div>
    </div>
    <div class="block sm:hidden">
        <x-livewire-select isTab=true>
            <option {{ request()->routeIs('employee.logs.applicants') ? 'selected' : '' }}
                value="{{ route('employee.logs.applicants') }}">{{ __('Applicant') }}
            </option>
            <option {{ request()->routeIs('employee.logs.courses') ? 'selected' : '' }}
                value="{{ route('employee.logs.courses') }}">{{ __('Course') }}
            </option>
            <option {{ request()->routeIs('employee.logs.documents') ? 'selected' : '' }}
                value="{{ route('employee.logs.documents') }}">{{ __('Document') }}
            </option>
            <option {{ request()->routeIs('employee.logs.tests') ? 'selected' : '' }}
                value="{{ route('employee.logs.tests') }}">{{ __('Tests') }}
            </option>
            <option {{ request()->routeIs('employee.logs.groups') ? 'selected' : '' }}
                value="{{ route('employee.logs.groups') }}">{{ __('Groups') }}
            </option>
            <option {{ request()->routeIs('employee.logs.settings') ? 'selected' : '' }}
                value="{{ route('employee.logs.settings') }}">{{ __('Settings') }}
            </option>
            <option {{ request()->routeIs('employee.logs.contact-profiles') ? 'selected' : '' }}
                value="{{ route('employee.logs.contact-profiles') }}">{{ __('Contact Profile') }}
            </option>
            <option {{ request()->routeIs('employee.logs.faq') ? 'selected' : '' }}
                value="{{ route('employee.logs.faq') }}">{{ __('Faq') }}
            </option>
        </x-livewire-select>
    </div>
</div>
