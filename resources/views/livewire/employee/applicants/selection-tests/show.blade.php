<div class="max-w-screen-xl mx-auto">
    <livewire:tabs :applicant="$applicant"/>
    <div class="flex flex-wrap relative">
        <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
            <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
        </div>
        <div class="flex flex-wrap flex-grow -mx-4">
            <div class="p-4 w-full shadow-md rounded">
                <h4 class="mb-4 md:mb-6 text-xl font-bold text-primary">{{ $test->name }}</h4>
                <div class="flex items-center justify-between flex-wrap">
                    <p class="text-sm md:text-base">{{ $test->status($applicant) }}</p>

                    <x-primary-button type="button"
                                    wire:click="$emit('Applicant.Modal.MarkAsPassed.modal.toggle',{{ $applicant->id }})"
                                    :disabled="!$isEdit"
                                    class="{{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                        {{ __('Mark test as passed') }}
                    </x-primary-button>
                </div>
                <div class="flex items-center justify-between flex-wrap space-x-2">
                    <p class="flex items-center text-sm md:text-base space-x-2">

                    </p>
                    <x-primary-button type="button"
                                    wire:click="$emit('Applicant.Modal.MarkAsFailed.modal.toggle',{{ $applicant->id }})"
                                    :disabled="!$isEdit"
                                    class="{{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                        {{ __('Mark test as failed') }}
                    </x-primary-button>
                </div>
                <div class="flex items-center justify-between flex-wrap mb-3 space-x-2">
                    <p class="flex items-center text-sm md:text-base space-x-2">
                        <span>{{ __('Result') }} :</span>

                        @php
                            $result=$test->getResult($applicant)->first();
                            $meta = json_decode($result->meta, true);
                        @endphp

                        @if ($test->type == \App\Models\Test::TYPE_MOODLE && $result->result)
                            <span>{{ $result->result }}</span>
                        @elseif($test->type == \App\Models\Test::TYPE_CUBIA && $result->result)
                            <span>{{ data_get($meta, 0) }} - {{ data_get($meta, 1) }}</span>
                            <span>
                                    <a href="{{ $result->result }}" target="_blank" download
                                       class="w-6 lg:w-8 h-6 lg:h-8 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-full">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                        </svg>
                                    </a>
                                </span>
                        @elseif($test->type == \App\Models\Test::TYPE_METEOR && $result->result)
                            <a href="{{ $result->result }}" target="_blank" download
                               class="w-6 lg:w-8 h-6 lg:h-8 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-full">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                            </a>
                        @endif
                        <span>{{ $test->isPassed($applicant) }}</span>
                    </p>
                    <x-primary-button type="button"
                                    wire:click="$emit('Applicant.Modal.MarkAsReset.modal.toggle',{{ $applicant->id }})"
                                    :disabled="!$isEdit"
                                    class="{{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                        {{ __('Reset') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
<livewire:applicant.modal.mark-as-passed/>
<livewire:applicant.modal.mark-as-failed/>
<livewire:applicant.modal.mark-as-reset/>
</div>
