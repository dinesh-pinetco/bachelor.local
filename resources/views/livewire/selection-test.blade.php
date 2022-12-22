<div class="max-w-screen-xl w-full mx-auto">
    <div class="flex items-center justify-between mb-5 md:mb-9">
        <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Selection test') }}
        </h2>
        @if(in_array($applicant->application_status, [\App\Enums\ApplicationStatus::TEST_PASSED, \App\Enums\ApplicationStatus::TEST_FAILED_CONFIRM]))
            <div wire:click="getTestResultPdf"
                 class="w-10 lg:w-14 h-10 lg:h-14 flex items-center justify-center text-white bg-primary hover:bg-opacity-80 rounded-full cursor-pointer">
                <svg class="h-6 w-6 stroke-current" fill="none"
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
                            <div class="flex items-center space-x-4">
                                @if(in_array($test->result?->status,[\App\Models\Result::STATUS_COMPLETED,\App\Models\Result::STATUS_FAILED] ))
                                    <div class="flex items-center space-x-2 text-green-500 text-sm">
                                        <svg class="w-3 h-3 fill-current" fill="currentcolor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/>
                                        </svg>
                                        <p>{{__('Completed')}}</p>
                                    </div>
                                @elseif($test->result?->status == \App\Models\Result::STATUS_STARTED)
                                    <div class="flex items-center space-x-2 text-yellow-500 text-sm">
                                        <svg class="w-3 h-3 fill-current" fill="currentcolor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/>
                                        </svg>
                                        <p>{{__('In Progress')}}</p>
                                    </div>
                                @endif
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
