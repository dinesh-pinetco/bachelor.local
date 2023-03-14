<div class="max-w-screen-xl w-full mx-auto">
    <livewire:tabs :applicant="$applicant"/>
    <div class="flex flex-wrap relative">
        <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
            <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
        </div>
        <div class="flex-grow space-y-4">
            @if($applicant->application_status == \App\Enums\ApplicationStatus::TEST_FAILED)
                <x-danger-button
                    wire:click="$emit('Applicant.Modal.TestFail.modal.toggle',{{ $applicant->id }})">
                    {{ __('Failed Confirm') }}
                </x-danger-button>
            @endif
            @if ($isShow)
                @foreach ($tests as $test)
                    <div class="p-4 shadow-md w-full rounded">
                        <h4 class="mb-4 md:mb-6 text-xl font-bold text-primary">{{ $test->name }}</h4>
                        <div class="flex items-center justify-between flex-wrap">
                            <p class="text-sm md:text-base">{{ $test->status($applicant) }}</p>
                            <x-link-button :active="true"
                                           href="{{ route('employee.selection-tests.show', ['applicant' => $applicant, 'selection_test' => $test]) }}"
                                           class="items-center -mt-0">
                                {{ __('Show result') }}
                            </x-link-button>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p class="text-primary">{{ __('Applicant have not fill personal data.') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
<livewire:applicant.modal.test-fail/>

