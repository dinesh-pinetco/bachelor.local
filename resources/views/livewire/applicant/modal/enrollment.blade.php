<div>
    <x-custom-modal wire:model="show" width="w-3/5">
        <x-slot name="title">
            {{ __(':name is ready for enrollment',['name' => $applicant?->full_name]) }}
        </x-slot>
        <x-slot name="slot">
            <div class="overflow-hidden bg-white sm:rounded-lg">
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
                            <div class="w-full order-4 xl:order-2 mt-4 sm:mt-0 col-span-2">
                                <x-multi-select
                                    :options="$courses"
                                    keyBy="id"
                                    labelBy="name"
                                    :value="[1,2]"
                                    :disabled="true"
                                />
                            </div>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Partner companies') }} <br>
                                <x-primary-button>
                                    Click here
                                </x-primary-button>
                            </dt>
                            <dd class="col-span-2">
                                <select
                                    class="h-11 py-2.5 text-sm md:text-base pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm w-full placeholder-gray  cursor-pointer text-primary"
                                    name="company" id="company">
                                    <option value="select">select</option>
                                </select>
                            </dd>
                        </div>

                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3">
                            <dt class="text-sm font-medium text-gray-500">Person name from company</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">Name goes here!</dd>
                        </div>
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
                >
                    {{ __('Enroll this applicant') }}
                </button>
                <x-danger-button data-cy="delete-button"
                                 wire:click="$set('show', false)"
                                 wire:loading.class='opacity-80 cursor-wait'>
                    {{ __('Cancel') }}
                </x-danger-button>
            </div>
        </x-slot>

    </x-custom-modal>
</div>
