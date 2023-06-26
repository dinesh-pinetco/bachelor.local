<div>
    <x-custom-modal wire:model="show" width="w-3/5">
        <x-slot name="title">
            {{ __(':name is ready for enrollment',['name' => $applicant?->full_name]) }}
        </x-slot>
        <x-slot name="slot">
            <div class="bg-white sm:rounded-lg">
                <div class="px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-lightgray">

                        <div class="pb-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:pb-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Last Name') }}</dt>
                            <x-jet-input id="last_name" name="last_name" :value="$applicant?->last_name"
                                         :disabled="!$isEdit"
                                         class="col-span-2 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"/>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('First Name') }}</dt>
                            <x-jet-input id="first_name" name="first_name" :value="$applicant?->first_name"
                                         :disabled="!$isEdit"
                                         class="col-span-2 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"/>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Date of birth') }}</dt>
                            <x-jet-input wire:model="date_of_birth"
                                         :disabled="!$isEdit"
                                         class="col-span-2 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"/>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Desired beginning') }}</dt>
                            <x-jet-input name="desiredBeginning" id="desiredBeginning" :value="$desiredBeginning"
                                         :disabled="!$isEdit"
                                         class="col-span-2 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"/>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Study course') }}</dt>
                            <div class="w-full order-4 xl:order-2 mt-4 sm:mt-0 col-span-2 space-y-1">
                                <select
                                    class="h-11 py-2.5 text-sm md:text-base pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm w-full placeholder-gray  cursor-pointer text-primary"
                                    wire:model="applicantCourse" id="applicantCourse">
                                    <option value="">{{ __('Select Course') }}</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course?->id }}">{{ $course->course?->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="applicantCourse"/>
                            </div>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Is enrolled outside system?') }}</dt>
                            <input type="checkbox" wire:model="enrolledOutsideSystem">
                        </div>

                        @if (!$enrolledOutsideSystem)
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Partner companies') }} <br>
                                    <x-primary-button wire:click="syncCompanies" wire:loading.remove wire:target='syncCompanies'>
                                        {{ __('Sync Companies') }}
                                    </x-primary-button>
                                    <x-primary-button disabled wire:loading wire:target='syncCompanies'>
                                        {{ __('Syncing...') }}
                                    </x-primary-button>
                                </dt>
                                <dd class="col-span-2 space-y-1">
                                    <select
                                        class="h-11 py-2.5 text-sm md:text-base pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm w-full placeholder-gray  cursor-pointer text-primary"
                                        wire:model="selectedCompany" id="selectedCompany">
                                        <option value="">{{ __('Select Partner Company') }}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="selectedCompany"/>
                                </dd>
                            </div>

                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Contact Person from Company') }}</dt>
                                <dd class="col-span-2 space-y-1">
                                    @if ($selectedCompany)
                                        <select
                                            class="col-span-2 h-11 py-2.5 text-sm md:text-base pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm w-full placeholder-gray  cursor-pointer text-primary"
                                            wire:model="selectedCompanyContacts" id="selectedCompanyContacts">
                                            <option value="null">{{ __('Select Company Contact') }}</option>
                                            @foreach ($companyContacts as $companyContact)
                                                <option value="{{ $companyContact->id }}">{{ $companyContact->fullName }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <p class="col-span-2 text-sm font-medium text-gray-500">{{ __('Please select partner company') }}</p>
                                    @endif
                                    <x-jet-input-error for="selectedCompanyContacts"/>
                                </dd>
                            </div>
                        @else
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Partner company') }}</dt>
                                <div class="w-full order-4 xl:order-2 mt-4 sm:mt-0 col-span-2">
                                    <x-jet-input wire:model="selectedCompany"
                                                class="w-full"/>
                                    <x-jet-input-error for="selectedCompany"/>
                                </div>
                            </div>

                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                                <dt class="text-sm font-medium text-gray-500">{{ __('Contact Person from Company') }}</dt>
                                <div class="w-full order-4 xl:order-2 mt-4 sm:mt-0 col-span-2">
                                    <x-jet-input wire:model="selectedCompanyContacts"
                                                class="w-full"/>
                                    <x-jet-input-error for="selectedCompanyContacts"/>
                                </div>
                            </div>
                        @endif
                    </dl>
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <button
                    class="inline-flex justify-center items-center px-4 py-2 bg-green-500 text-white text-center text-base border font-medium tracking-wide rounded-sm border-green-400 hover:bg-green-600 opacity-80 hover:opacity-100 "
                    data-cy="cancel-button"
                    wire:click="enroll"
                    wire:loading.class='opacity-80 cursor-wait'
                >
                    {{ __('Enroll this applicant') }}
                </button>
                <x-danger-button data-cy="delete-button" wire:click="$set('show', false)">
                    {{ __('Cancel') }}
                </x-danger-button>
            </div>
        </x-slot>

    </x-custom-modal>
</div>
