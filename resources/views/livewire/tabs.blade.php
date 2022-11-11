<div class="max-w-screen-xl mx-auto flex flex-wrap md:pb-10">
    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>

    <div class="flex-grow w-1/3">
        <div class="flex flex-wrap items-center justify-between mb-5 md:mb-9">
            <h2 class="mb-4 2xl:mb-0 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Application') }}
            </h2>
            <div class="flex flex-wrap xl:ml-auto gap-1 md:gap-3">
                @if (auth()->user()->hasRole([ROLE_ADMIN,ROLE_EMPLOYEE]))

                    @if (!in_array($applicant->application_status, [\App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_NAK, \App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT]))
                        <x-danger-button
                            wire:click="openConfirmModal('{{ \App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT() }}')"
                            class="flex flex-shrink-0 inline-flex px-4 lg:-mt-0">
                            {{ __('Reject by applicant') }}
                        </x-danger-button>
                    @endif
                @endif
            </div>
        </div>

        <ul class="space-x-4 tabs overflow-x-auto hidden sm:flex">
            @foreach ($tabs as $tab)
                <li>
                    @if (auth()->user()->hasRole(ROLE_APPLICANT))
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
                    @endif
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
    <x-custom-modal wire:model="show">
        <x-slot name="title">
            {{ __('Application Reject') }}
        </x-slot>
        <div>
            <div class="space-y-3">

                <p class="text-center text-red flex justify-center">
                    <svg class="h-12 w-12 stroke-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z" />
                    </svg>
                </p>
                <h4 class="text-center text-darkgray text-sm sm:text-base">
                    {{ __('Are you sure you want to reject this application.') }}?
                </h4>
                <textarea wire:model="applicationRejectReason"
                    class="w-full text-sm md:text-base border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-gray placeholder-gray resize-none shadow-sm text-primary"
                    placeholder="{{ __('Enter reason for application reject.') }}" rows="8">
                </textarea>
                <x-jet-input-error for="applicationRejectReason" />
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1" />
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button data-cy="delete-button" wire:click='rejectApplication'> {{ __('Yes, Reject it') }}
                </x-danger-button>
                <x-secondary-button data-cy="cancel-button" wire:click="resetRejectApplication"> {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>
