<div class="max-w-screen-xl w-full mx-auto">
    <livewire:tabs :applicant="$applicant" />
    <div class="flex flex-wrap relative">
        <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
            <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
        </div>
        <div class="flex-grow space-y-4">
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
            @endif
        </div>
    </div>
</div>
