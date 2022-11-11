<div>
    <x-data-table.table :model="$applicants" :columns="$columns" :statuses="$statuses"
                        :selectedStatusesSummery="$selectedStatusesSummery"
                        :applicantsTableFields="$applicantsTableFields"
                        :selectedShowFields="$selectedShowFields">
        <x-slot name="tableAction"></x-slot>
        <x-slot name="head">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('first_name')" role="button" href="#">
                        {{ __('First name') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'name',
                        ])
                    </a>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                    <a wire:click="sort('last_name')" role="button" href="#">
                        {{ __('Last name') }}
                        @include('components.data-table.sort-icon', [
                            'field' => 'last_name',
                        ])
                    </a>
                </th>
                @if(data_get($authPreferencesFields,'email'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('email')" role="button" href="#">
                            {{ __('Email') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'Email',
                            ])
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'created_at'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('created_at')" role="button" href="#">
                            {{ __('Created at') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'created_at',
                            ])
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'course_name'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('Study course') }}
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'course_start_date'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('Desired beginning') }}
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'application_status_name'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('application_status_id')" role="button" href="#">
                            {{ __('Status') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status_id',
                            ])
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'ects_point'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('ects_point') }}
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'government_form_is_submit'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('government_form_is_submit') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status_id',
                            ])
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'study_sheet_is_submit'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('study_sheet_is_submit') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status_id',
                            ])
                        </a>
                    </th>
                @endif
                @if(data_get($authPreferencesFields,'sanna_is_sync'))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('sanna_is_sync') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status_id',
                            ])
                        </a>
                    </th>
                @endif
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider text-right">
                    {{ __('Action') }}
                </th>

            </tr>
        </x-slot>
        <x-slot name="body">
            @forelse ($applicants as $applicant)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $applicant->first_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $applicant->last_name }}</td>
                    @if(data_get($authPreferencesFields,'email'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $applicant->email }}</td>
                    @endif
                    @if(data_get($authPreferencesFields,'created_at'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            {{ $applicant->created_at->format('d.m.Y') }}
                        </td>
                    @endif
                    @if(data_get($authPreferencesFields,'course_name'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ __($applicant->Courses->first()->name) }}</td>
                    @endif
                    @if(data_get($authPreferencesFields,'course_start_date'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ __($applicant->course->first()?->course_start_date?->format('d.m.Y')) }}</td>
                    @endif
                    @if(data_get($authPreferencesFields,'application_status_name'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ __($applicant->application_status->name) }}</td>
                    @endif
                    @if(data_get($authPreferencesFields,'ects_point'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            {{ $applicant->getEctsPointvalue('ects_point') }}
                        </td>
                    @endif
                    @if(data_get($authPreferencesFields,'government_form_is_submit'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->government_form_is_submit?->is_submit)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    @if(data_get($authPreferencesFields,'study_sheet_is_submit'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->study_sheet?->is_submit)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    @if(data_get($authPreferencesFields,'sanna_is_sync'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->is_sync)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a data-cy="edit-button-{{ $applicant->id }}" role="button"
                           class="text-darkgray hover:text-gray inline-block cursor-pointer"
                           href="{{ route('employee.applicants.edit', ['slug' => 'profile', 'applicant' => $applicant]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <a data-cy="delete-button-{{ $applicant->id }}" role="button"
                           class="text-darkgray hover:text-lightred inline-block cursor-pointer"
                           wire:click="openConfirmModal({{ $applicant->id }})" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="no-data-found">
                    <td colspan="11">
                        <div class="space-y-2">
                            <div class="text-4xl text-center text-gray">
                                <i class="fal fa-user-slash"></i>
                            </div>
                            <div class="text-xs text-center text-gray lg:text-base">
                                {{ __('No Data Found') }}
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-data-table.table>
    <x-custom-modal wire:model="show">
        <x-slot name="title">
            {{ __('Delete Applicant') }}
        </x-slot>
        <div>
            <div class="space-y-3">
                <p class="text-center text-red flex justify-center">
                    <svg class="h-12 w-12 stroke-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path
                            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z"/>
                    </svg>
                </p>
                <h4 class="text-center text-darkgray text-sm sm:text-base">
                    {{ __('Are you sure you want to remove applicant.') }}?
                </h4>
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1"/>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button data-cy="delete-button" wire:click='delete'> {{ __('Yes, Delete it') }}
                </x-danger-button>
                <x-secondary-button data-cy="cancel-button" wire:click="$set('show', false)"> {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>
