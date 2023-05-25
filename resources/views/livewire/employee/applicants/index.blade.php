<div>
    <x-data-table.table :model="$applicants" :columns="$columns">
        <x-slot name="tableAction">
            @can('exportApplicantReport', auth()->user())
                <button
                    class="inline-block px-4 py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out flex items-center mb-4 xl:mb-0 -mt-0"
                    wire:click="exportApplicants">
                    <svg wire:loading.remove wire:target="exportApplicants" class="stroke-current" width="20"
                         height="20"
                         viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_392_11349)">
                            <path d="M15.33 8L10 12" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M4.67001 8L10 12" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M19 13V18H1V13" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M10 12V1" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_392_11349">
                                <rect width="20" height="19" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <img wire:loading wire:target="exportApplicants"
                         src="{{asset('images/loading-loading-forever.gif')}}"
                         alt="verify email background image"
                         class="h-5 w-5 object-cover object-center">
                </button>
            @endcan
        </x-slot>
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
                @if(in_array('email', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('email')" role="button" href="#">
                            {{ __('Email') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'Email',
                            ])
                        </a>
                    </th>
                @endif
                @if(in_array('created_at', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('created_at')" role="button" href="#">
                            {{ __('Created at') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'created_at',
                            ])
                        </a>
                    </th>
                @endif
                @if(in_array('course_name', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('Study course') }}
                        </a>
                    </th>
                @endif
                @if(in_array('course_start_date', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('Desired beginning') }}
                        </a>
                    </th>
                @endif
                @if(in_array('application_status_name', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a wire:click="sort('application_status')" role="button" href="#">
                            {{ __('Status') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status',
                            ])
                        </a>
                    </th>
                @endif
                @if(in_array('ects_point', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('ects_point') }}
                        </a>
                    </th>
                @endif
                @if(in_array('government_form_is_submit', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('government_form_is_submit') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status',
                            ])
                        </a>
                    </th>
                @endif
                @if(in_array('study_sheet_is_submit', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('study_sheet_is_submit') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status',
                            ])
                        </a>
                    </th>
                @endif
                @if(in_array('sanna_is_sync', $authPreferencesFields))
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-darkgray tracking-wider">
                        <a role="button" href="#">
                            {{ __('sanna_is_sync') }}
                            @include('components.data-table.sort-icon', [
                                'field' => 'application_status',
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
                    <td class="px-6 py-4 text-sm text-primary">
                        <div class="w-40 break-words">{{ $applicant->first_name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-primary">
                        <div class="w-40 break-words">{{ $applicant->last_name }}</div>
                    </td>
                    @if(in_array('email', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ $applicant->email }}</td>
                    @endif
                    @if(in_array('created_at', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            {{ $applicant->created_at->format('d.m.Y') }}
                        </td>
                    @endif
                    @if(in_array('course_name', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary relative">
                            @if($applicant->desiredBeginning?->courses?->count() > 1)
                                <div class="cursor-pointer"
                                     x-data="{ tooltip: false }"
                                     x-on:click="tooltip =! tooltip" x-cloak>
                                    @foreach ($applicant->desiredBeginning?->courses?->pluck('name') as $index => $course)
                                        <div class="">
                                            <svg class="absolute right-0 top-4 transition-all ease-in-out duration-500"
                                                 :class="tooltip ? 'transform rotate-180' : ''" width="24px"
                                                 height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg" color="#003A79">
                                                <path d="M6 9l6 6 6-6" stroke="#003A79" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            @if($index < 1)
                                                {{ $course }}
                                        </div>
                                        @else
                                            <div x-show="tooltip">
                                                <span class="truncate">{{ $course }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="cursor-auto">
                                    {{ $applicant->desiredBeginning?->courses->first()?->name }}
                                </span>
                            @endif
                        </td>
                    @endif
                    @if(in_array('course_start_date', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ __($applicant->desiredBeginning?->course_start_date?->format('d.m.Y')) }}</td>
                    @endif
                    @if(in_array('application_status_name', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">{{ __($applicant->application_status->value) }}</td>
                    @endif
                    @if(in_array('ects_point', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            {{ $applicant->getEctsPointvalue('ects_point') }}
                        </td>
                    @endif
                    @if(in_array('government_form_is_submit', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->government_form?->is_submit)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    @if(in_array('study_sheet_is_submit', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->study_sheet?->is_submit)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    @if(in_array('sanna_is_sync', $authPreferencesFields))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                            @if($applicant->configuration?->is_synced_to_sanna)
                                <x-icons.success/>
                            @else
                                <x-icons.cancel/>
                            @endif
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        @can('updateSelectionTestStatus', $applicant)
                            <span data-cy="test-pass-button-{{ $applicant->id }}" role="button"
                                  data-tippy-content="{{__('Pass Applicant')}}"
                                  class="text-darkgray hover:text-green-600 inline-block cursor-pointer"
                                  wire:click="$emit('Applicant.Modal.TestPass.modal.toggle',{{ $applicant->id }})">
                                <svg class="fill-current h-4 w-4" fill="currentcolor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 384 512">
                                    <path
                                        d="M320 64H280h-9.6C263 27.5 230.7 0 192 0s-71 27.5-78.4 64H104 64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64zM80 112v24c0 13.3 10.7 24 24 24h88 88c13.3 0 24-10.7 24-24V112h16c8.8 0 16 7.2 16 16V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V128c0-8.8 7.2-16 16-16H80zm88-32a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zM289 267.6c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-89.7 89.7L129 287c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l53.3 53.3c4.5 4.5 10.6 7 17 7s12.5-2.5 17-7L289 267.6z"/>
                                </svg>
                            </span>
                        @endcan
                        <a data-cy="edit-button-{{ $applicant->id }}" role="button"
                           class="text-darkgray hover:text-gray inline-block cursor-pointer"
                           href="{{ route('employee.applicants.edit', ['slug' => 'profile', 'applicant' => $applicant]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        @canImpersonate
                            <a data-cy="edit-button-{{ $applicant->id }}" role="button"
                               class="text-darkgray hover:text-gray inline-block cursor-pointer "
                               href="{{ route('impersonate', $applicant->id) }}">
                                <x-icons.impersonate class="stroke-current h-4 w-4" />
                            </a>
                        @endCanImpersonate
                        <span data-cy="delete-button-{{ $applicant->id }}" role="button"
                              class="text-darkgray hover:text-lightred inline-block cursor-pointer"
                              wire:click="openConfirmModal({{ $applicant->id }}, 'delete')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </span>
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
                    {{ __('Are you sure you want to remove applicant?') }}
                </h4>
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1"/>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button data-cy="delete-button"
                                 wire:click="delete">
                    {{ __('Yes, Delete it') }}
                </x-danger-button>
                <x-secondary-button
                    data-cy="cancel-button"
                    wire:click="$set('show', false)"> {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>

    <livewire:applicant.modal.test-pass/>
</div>
