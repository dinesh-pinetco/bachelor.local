<div class="max-w-screen-xl w-full mx-auto">
    <div class="flex items-center justify-between mb-5 md:mb-9">
        <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Selection test') }}
        </h2>
        @if(in_array($applicant->application_status, [\App\Enums\ApplicationStatus::TEST_PASSED, \App\Enums\ApplicationStatus::TEST_FAILED_CONFIRM]))
            <div wire:click="getTestResultPdf"
                 class="h-12 w-12 border border-primary rounded-full flex items-center justify-center hover:border-primary-light transform transition-all ease-in-out duration-300 cursor-pointer">
                <svg
                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                </svg>
            </div>
        @endif
    </div>
    @if ($applicant->isSelectionTestingMode())
        @foreach ($tests as $test)
            <div class="flex items-center flex-wrap -mx-4">
                <div class="p-4 w-full md:w-2/5 xl:w-1/3">
                    <div class="rounded-full">
                        @if ($test->type == \App\Models\Test::TYPE_MOODLE)
                            <img src="{{ __('images/icon/flag-usa-light.svg') }}"
                                 class="object-contain object-center w-20 h-20 md:w-40 md:h-40"
                                 alt="user">
                        @elseif($test->type == \App\Models\Test::TYPE_CUBIA)
                            <img src="{{ __('images/icon/lightbulb-exclamation-on-light.svg') }}"
                                 class="object-contain object-center w-20 h-20 md:w-40 md:h-40"
                                 alt="user">
                        @elseif($test->type == \App\Models\Test::TYPE_METEOR)
                            <img src="{{ __('images/icon/pen-to-square-light.svg') }}"
                                 class="object-contain object-center w-20 h-20 md:w-40 md:h-40"
                                 alt="user">
                        @endif
                    </div>
                </div>
                <div class="p-4 w-full md:w-3/5 xl:w-2/3">
                    <div class="text-primary w-full md:max-w-xl">
                        <div class="mb-4 md:mb-6 flex items-center justify-between">
                            <h4 class="text-xl font-medium text-primary">{{ $test->name }}</h4>
                            <div>
                                @if (!in_array($test->result?->status,[\App\Models\Result::STATUS_COMPLETED,\App\Models\Result::STATUS_FAILED]))
                                    @if ($test->type == \App\Models\Test::TYPE_CUBIA)
                                        <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                                       href="{{ $test->getTestLink($applicant,'MIX') }}"
                                                       class="items-center -mt-0"
                                                       target="_blank">
                                            {{ __('To the test of MIX') }}
                                        </x-link-button>
                                        <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                                       href="{{ $test->getTestLink($applicant,'IQT') }}"
                                                       class="items-center -mt-0"
                                                       target="_blank">
                                            {{ __('To the test of IQ') }}
                                        </x-link-button>
                                    @else
                                        <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                                       href="{{ $test->getTestLink($applicant) }}"
                                                       class="items-center -mt-0"
                                                       target="_blank">
                                            {{ __('To the test') }}
                                        </x-link-button>
                                    @endif
                                @endif

                                @if($test->result?->status == \App\Models\Result::STATUS_COMPLETED)
                                    <img src="{{ asset('images/icon/check-circle.svg') }}" alt="test_completed">
                                @elseif($test->result?->status == \App\Models\Result::STATUS_FAILED)
                                    <img src="{{ asset('images/icon/cancel.svg') }}" alt="test_failed">
                                @endif
                            </div>
                        </div>
                        <p class="mb-3 md:mb-6 text-sm md:text-base">{{ $test->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="flex items-center flex-wrap">

        </div>
    @endif
    @if($applicant->application_status == \App\Enums\ApplicationStatus::TEST_TAKEN)
        <span class="text-2xl">
            {{ __('You will be informed as soon as the test results are available') }}
        </span>
    @endif


    <x-custom-modal wire:model="show">
        <div>
            <div class="space-y-3">
                <h4 class="text-center text-darkgray text-sm sm:text-base">
                    {{ __('To complete your application, you still need to do industry, motivation, documents to really apply.') }}
                </h4>
            </div>
        </div>
        <x-jet-input-error for="client" class="mt-1"/>
        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button data-cy="delete-button"
                                 wire:click='testResultRetrievedOn'> {{ __('Got it!') }}</x-danger-button>
                <x-secondary-button data-cy="cancel-button"
                                    wire:click="$set('show', false)"> {{ __('Cancel') }} </x-secondary-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>
