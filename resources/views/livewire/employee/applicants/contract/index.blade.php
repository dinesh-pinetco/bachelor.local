<div class="max-w-screen-xl mx-auto">
    <livewire:tabs :applicant="$applicant" />
    @if($applicant->application_status->id() >= \App\Enums\ApplicationStatus::ENROLLMENT_ON->id())
        <div class="flex flex-wrap relative mt-5 md:mt-0">
            <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
                <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
            </div>
            <div class="flex-grow w-1/3 text-primary relative">
                <div class="lg:flex mb-10 lg:-mx-4">
                    <div class="w-full lg:w-1/2 lg:px-4 lg:max-w-md mr-auto">
                        <div>
                            <x-jet-label for="name" value="{{ __('Company name') }}" />
                                         <x-jet-input id="name" type="text" class="mt-1 block w-full {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}" :disabled="!$isEdit" wire:model="enrollCompany" autofocus />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                            <div class="mb-7 value mt-4">
                                <x-jet-label for="label" class="block">
                                    {{ __('Contract Received Date') }}
                                </x-jet-label>
                                <div class="flex">
                                    <x-jet-input
                                        class="w-full" type="date" wire:model="contract.receive_date" wire:loading.attr='disabled' wire:loading.class='cursor-wait'>
                                    </x-jet-input>
                                    @if($contract->receive_date)
                                        <button wire:click="removeContractDate('receive_date')" class="ml-2 hover:text-red">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <x-jet-input-error for="contract.receive_date" />
                            </div>
                        @if(! is_null($applicant->contract()->first()?->receive_date))
                            <div class="mb-7 value">
                                <x-jet-label for="label" class="block">
                                    {{ __('Contract Send Date') }}
                                </x-jet-label>
                                <div class="flex">
                                    <x-jet-input
                                        class="w-full" type="date" wire:model="contract.send_date" wire:loading.attr='disabled' wire:loading.class='cursor-wait'>
                                    </x-jet-input>
                                    @if($contract->send_date)
                                        <button wire:click="removeContractDate('send_date')" class="ml-2 hover:text-red">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <x-jet-input-error for="contract.send_date" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="lg:pl-40 2xl:pl-64 mt-5 md:mt-0">
            <p class="text-primary">{{ __('Applicant not submit study-sheet and government-form.') }}</p>
        </div>
    @endif
</div>
