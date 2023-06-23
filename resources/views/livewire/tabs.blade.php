<div class="max-w-screen-xl mx-auto flex flex-wrap md:pb-10">
    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
    <div class="flex-grow w-1/3">
        <div class="flex flex-wrap items-center justify-between mb-5 md:mb-9">
            <h2 class="mb-4 2xl:mb-0 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Application') }}
            </h2>
            <div class="flex flex-wrap xl:ml-auto gap-1 md:gap-3">
                @unlessrole(ROLE_APPLICANT)
                @if (!in_array($applicant->application_status, [\App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_NAK, \App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT]))
                    <x-danger-button
                        wire:click="$emit('ApplicationReject.modal.toggle',{{ $applicant }})"
                        class="flex flex-shrink-0 inline-flex px-4 lg:-mt-0">
                        {{ __('Reject by applicant') }}
                    </x-danger-button>
                    <livewire:application-reject/>
                @endif
                @endunlessrole
            </div>
        </div>

        <ul class="space-x-4 tabs overflow-x-auto hidden sm:flex">
            @foreach ($tabs as $tab)
                <li>
                    @role(ROLE_APPLICANT)
                    <x-jet-nav-link href="{{ route('application.index', ['tab' => $tab->slug]) }}"
                                    :active="urlContains($tab->slug)"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __($tab->name) }}
                    </x-jet-nav-link>
                    @else
                        <x-jet-nav-link
                            href="{{ route('employee.applicants.edit', ['slug' => $tab->slug, 'applicant' => $applicant]) }}"
                            :active="urlContains($tab->slug)"
                            class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                            {{ __($tab->name) }}
                        </x-jet-nav-link>
                        @endrole
                </li>
            @endforeach
            @if (auth()->user()->hasRole(ROLE_APPLICANT))
                <li>
                    <x-jet-nav-link href="{{ route('documents.index') }}" :active="urlContains('documents')"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __('Documents') }}
                    </x-jet-nav-link>
                </li>
            @endif

            @unlessrole(ROLE_APPLICANT)
            <li>
                <x-jet-nav-link :active="urlContains('documents')"
                                href="{{ route('employee.applicants.edit', ['slug' => 'documents', 'applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Documents') }}
                </x-jet-nav-link>
            </li>
            <li>
                <x-jet-nav-link :active="urlContains('selection-tests')"
                                href="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Selection Test') }}
                </x-jet-nav-link>
            </li>

            <li>
                <x-jet-nav-link :active="urlContains('companies')"
                                href="{{ route('employee.applicants.edit',['slug' => 'companies', 'applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Companies') }}
                </x-jet-nav-link>
            </li>

            <li>
                <x-jet-nav-link :active="urlContains('contracts')"
                                href="{{ route('employee.applicants.edit',['slug' => 'contracts', 'applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Contract') }}
                </x-jet-nav-link>
            </li>
            <li>
                <x-jet-nav-link :active="urlContains('forms')"
                                href="{{ route('employee.applicants.edit',['slug' => 'forms', 'applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Forms') }}
                </x-jet-nav-link>
            </li>
            @endunlessrole
        </ul>
        <div class="block sm:hidden">
            <x-livewire-select isTab=true>
                @if (auth()->user()->hasRole(ROLE_APPLICANT))
                    @foreach ($tabs as $tab)
                            <option {{ urlContains($tab->slug) ? 'selected' : '' }}
                                    value="{{ route('application.index', ['tab' => $tab->slug]) }}">{{ __($tab->name) }}
                            </option>
                    @endforeach
                    <option {{ urlContains('documents') ? 'selected' : '' }}
                            value="{{ route('documents.index') }}">{{ __('Document') }}
                    </option>
                @endif
                @if(! auth()->user()->hasRole(ROLE_APPLICANT))
                    <option {{ urlContains('profile') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'profile', 'applicant' => $applicant]) }}">
                            {{ __('Profile') }}
                    </option>
                    <option {{ urlContains('industries') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'industries', 'applicant' => $applicant]) }}">
                            {{ __('Industry') }}
                    </option>
                    <option {{ urlContains('motivation') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'motivation', 'applicant' => $applicant]) }}">
                            {{ __('Motivation') }}
                    </option>
                    <option {{ urlContains('documents') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'documents', 'applicant' => $applicant]) }}">
                            {{ __('Documents') }}
                    </option>
                    <option {{ urlContains('selection-test') ? 'selected' : '' }}
                            value="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}">
                            {{ __('Selection Test') }}
                    </option>
                    <option {{ urlContains('companies') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'companies', 'applicant' => $applicant]) }}">
                            {{ __('Companies') }}
                    </option>
                    <option {{ urlContains('contracts') ? 'selected' : '' }}
                            value="{{ route('employee.applicants.edit', ['slug' => 'contracts', 'applicant' => $applicant]) }}">
                            {{ __('Contract') }}
                    </option>
                @endif
            </x-livewire-select>
        </div>
    </div>
</div>
