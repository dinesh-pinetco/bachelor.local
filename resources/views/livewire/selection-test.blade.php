<div class="max-w-screen-xl w-full mx-auto">
    <div class="flex mb-5 md:mb-9">
        <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
        <div class="w-full flex items-center justify-between">
            <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{ __('Selection test') }}
            </h2>
            @if(in_array($applicant->application_status, [\App\Enums\ApplicationStatus::TEST_PASSED, \App\Enums\ApplicationStatus::TEST_FAILED_CONFIRM]))
                <div wire:click="getTestResultPdf" id="download-result" data-tippy-content="{{__('Here you can download your result')}}"
                     class="ml-8 px-8 py-3 flex items-center justify-center text-black bg-secondary hover:bg-secondary-light rounded-md cursor-pointer">
                    <svg class="h-4 w-4 stroke-current" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 5.71432L8 11.7143L14 5.71432H10.2857V0.857178H5.71429V5.71432H2Z" fill="currentColor"/>
                        <rect y="14.0002" width="16" height="1.14286" fill="currentColor"/>
                    </svg>
                    <p class="ml-4 text-base">{{__('Download')}}</p>
                </div>
            @endif
        </div>
    </div>

    @if(in_array($applicant->application_status, [\App\Enums\ApplicationStatus::TEST_TAKEN, \App\Enums\ApplicationStatus::TEST_FAILED]))
        <div class="md:w-max flex justify-center space-x-4 text-primary p-4 bg-secondary rounded-sm mr-auto lg:ml-40 2xl:ml-64">
            <svg class="text-priamry full-current w-5 h-5" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23984 18.6518 7.55544C19.5308 8.87103 20 10.4177 20 12C20 14.1217 19.1572 16.1566 17.6569 17.6569C16.1566 19.1571 14.1217 20 12 20Z"
                    fill="currentColor"/>
                <path
                    d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                    fill="currentColor"/>
                <path
                    d="M12 7C11.7348 7 11.4804 7.10536 11.2929 7.29289C11.1054 7.48043 11 7.73478 11 8V13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14C12.2652 14 12.5196 13.8946 12.7071 13.7071C12.8946 13.5196 13 13.2652 13 13V8C13 7.73478 12.8946 7.48043 12.7071 7.29289C12.5196 7.10536 12.2652 7 12 7Z"
                    fill="currentColor"/>
            </svg>
            <p class="text-sm">
                {{ __('You will be informed as soon as the test results are available') }}
            </p>
        </div>
    @endif
    @if ($applicant->isSelectionTestingMode())
        <div class="flex flex-wrap relative max-w-screen-xl mx-auto">
            <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
                <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
            </div>
            <div class="flex-grow w-1/3 text-primary relative">
                @foreach ($tests as $test)
                    <div class="flex items-center flex-wrap -mx-4">
                        <div class="p-4 w-full md:w-2/5 xl:w-1/4">
                            <svg class="h-16 w-16 md:h-20 md:w-20 md:mr-auto stroke-current" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 12V5.74853C20 5.5894 19.9368 5.43679 19.8243 5.32426L16.6757 2.17574C16.5632 2.06321 16.4106 2 16.2515 2H4.6C4.26863 2 4 2.26863 4 2.6V21.4C4 21.7314 4.26863 22 4.6 22H11"
                                    stroke="#003A79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 10H16M8 6H12M8 14H11" stroke="#003A79" stroke-width="1.5"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path
                                    d="M17.9543 16.9394L18.9543 15.9394C19.3922 15.5015 20.1022 15.5015 20.5401 15.9394V15.9394C20.978 16.3773 20.978 17.0873 20.5401 17.5252L19.5401 18.5252M17.9543 16.9394L14.9632 19.9305C14.8133 20.0804 14.715 20.2741 14.6823 20.4835L14.4396 22.0399L15.9959 21.7973C16.2054 21.7646 16.3991 21.6662 16.549 21.5163L19.5401 18.5252M17.9543 16.9394L19.5401 18.5252"
                                    stroke="#003A79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 2V5.4C16 5.73137 16.2686 6 16.6 6H20" stroke="#003A79" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="p-4 w-full md:w-3/5 xl:w-2/3">
                            <div class="text-primary w-full md:max-w-xl">
                                <div class="mb-4 md:mb-6 flex flex-wrap items-center justify-between gap-4">
                                    <h4 class="text-lg md:text-xl font-medium text-primary">{{ __($test->name) }}</h4>
                                    <div class="flex flex-shrink-0 items-center justify-end ml-auto space-x-4">
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
                                                <x-link-button :active="true"
                                                               href="{{ route('tests.redirect', $test) }}"
                                                               class="items-center -mt-0"
                                                               target="_blank">
                                                    {{ __('To the test') }}
                                                </x-link-button>
                                        @endif

                                    </div>
                                </div>
                                <p class="mb-3 md:mb-6 text-sm md:text-base">{{ $test->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="flex items-center flex-wrap">

        </div>
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
                <x-danger-button class="bg-primary border-primary" data-cy="delete-button"
                                 wire:click='testResultRetrievedOn'> {{ __('Got it!') }}</x-danger-button>
            </div>
        </x-slot>
    </x-custom-modal>
</div>
