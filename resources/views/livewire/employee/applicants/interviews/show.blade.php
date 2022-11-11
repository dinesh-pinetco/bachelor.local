<div class="max-w-screen-xl mx-auto">
    <livewire:tabs :applicant="$applicant" />
    <div class="flex flex-wrap relative">
        <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
            <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
        </div>
        <div class="flex-grow w-1/3 text-primary relative">
            <div class="lg:flex mb-10 lg:-mx-4">
                @if ($applicant->application_status_id >= User::STATUS_TEST_TAKEN)
                    <div class="w-full lg:w-1/2 lg:px-4 lg:max-w-md mr-auto">
                        <div class="flex justify-start items-baseline mb-7">
                            <div class="form-check space-x-1">
                                <input wire:model="interview.has_taken_placement" @if ($isEdit) wire:change="handleHasTakenPlacement" @else {{ "disabled" }} @endif
                                    class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                    type="checkbox">
                                <label class="form-check-label inline-block" for="flexCheckChecked">
                                    {{ __('Interview has taken place') }}
                                </label>
                            </div>
                        </div>
                        <div class="mb-7">
                            <x-jet-label for="label" class="block">
                                {{ __('Interview Date') }}
                            </x-jet-label>

                            <div class="flex">
                                <x-jet-input class="w-full {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                             type="date" wire:model="interview.date" :disabled="!$isEdit"></x-jet-input>

                                @if($this->interview->date)
                                    <button wire:click="removeInterviewDate" class="ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            <x-jet-input-error for="interview.date"/>
                        </div>
                        <div class="mb-7">
                            <x-jet-label for="label" class="block">
                                {{ __('Comment') }}
                            </x-jet-label>

                            <div wire:ignore>
                                <trix-editor
                                    :disabled="!$isEdit"
                                    class="prose formatted-content"
                                    x-data
                                    x-on:trix-change="$dispatch('input', event.target.value)"
                                    x-ref="trix"
                                    wire:model.debounce.500ms="interview.comment"
                                    wire:key="interview.comment"
                                ></trix-editor>
                            </div>
                            <x-jet-input-error for="interview.comment" />
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
