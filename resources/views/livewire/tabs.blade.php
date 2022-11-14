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
                        {{ $tab->name }}
                    </x-jet-nav-link>
                    @else
                        <x-jet-nav-link
                            href="{{ route('employee.applicants.edit', ['slug' => $tab->slug, 'applicant' => $applicant]) }}"
                            :active="urlContains($tab->slug)"
                            class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                            {{ $tab->name }}
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
            @else
                <li>
                    <x-jet-nav-link :active="urlContains('documents')"
                                    href="{{ route('employee.applicants.edit', ['slug' => 'documents', 'applicant' => $applicant]) }}"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __('Documents') }}
                    </x-jet-nav-link>
                </li>
                @if ($nakUniversityId != $universityId || $grade > 2.5)
                    <li>
                        <x-jet-nav-link :active="urlContains('selection-test')"
                                        href="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}"
                                        class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                            {{ __('Selection Test') }}
                        </x-jet-nav-link>
                    </li>
                @endif
            @endif

            @unlessrole(ROLE_APPLICANT)
            <li>
                <x-jet-nav-link :active="urlContains('selection-tests')"
                                href="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Selection Test') }}
                </x-jet-nav-link>
            </li>

            <li>
                <x-jet-nav-link :active="urlContains('companies')"
                                href="#"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Companies') }}
                </x-jet-nav-link>
            </li>

            <li>
                <x-jet-nav-link :active="urlContains('contract')"
                                href="#"
                                class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                    {{ __('Contract') }}
                </x-jet-nav-link>
            </li>
            @endunlessrole
        </ul>
        <div class="block sm:hidden">
            <x-livewire-select isTab=true>
                @foreach ($tabs as $tab)
                    @if (auth()->user()->hasRole(ROLE_APPLICANT))
                        <option {{ urlContains($tab->slug) ? 'selected' : '' }}
                                value="{{ route('application.index', ['tab' => $tab->slug]) }}">{{ $tab->name }}
                        </option>
                    @else
                        <option {{ urlContains($tab->slug) ? 'selected' : '' }}
                                value="{{ route('application.index', ['tab' => $tab->slug]) }}">{{ $tab->name }}
                        </option>
                    @endif
                @endforeach
                @if (auth()->user()->hasRole(ROLE_APPLICANT))
                    <option {{ urlContains('documents') ? 'selected' : '' }}
                            value="{{ route('documents.index') }}">
                        {{ __('Documents') }}
                    </option>
                @else
                    <option {{ urlContains('documents') ? 'selected' : '' }}
                        value="{{ route('employee.applicants.edit', ['slug' => 'documents', 'applicant' => $applicant]) }}">
                        {{ __('Documents') }}
                    </option>
                    @if ($nakUniversityId != $universityId || $grade > 2.5)
                        <option {{ urlContains('selection-test') ? 'selected' : '' }}
                            value="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}">
                            {{ __('Selection Test') }}
                        </option>
                    @endif
                @endif
            </x-livewire-select>
        </div>
    </div>
</div>
