<div class="max-w-screen-xl w-full mx-auto">
    <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
        {{ __('Selection test') }}
    </h2>
    @if (auth()->user()->isSelectionTestingMode())
        @foreach ($tests as $test)
            <div class="flex items-center flex-wrap -mx-4">
                <div class="p-4 w-full lg:w-2/5 xl:w-1/3">
                    <div class="rounded-full">
                        @if ($test->type == \App\Models\Test::TYPE_MOODLE)
                            <img src="{{ __('images/icon/flag-usa-light.svg') }}"
                                 class="object-contain object-center w-40 h-40 md:w-52 md:h-52 lg:w-64 lg:h-64"
                                 alt="user">
                        @elseif($test->type == \App\Models\Test::TYPE_CUBIA)
                            <img src="{{ __('images/icon/lightbulb-exclamation-on-light.svg') }}"
                                 class="object-contain object-center w-40 h-40 md:w-52 md:h-52 lg:w-64 lg:h-64"
                                 alt="user">
                        @elseif($test->type == \App\Models\Test::TYPE_METEOR)
                            <img src="{{ __('images/icon/pen-to-square-light.svg') }}"
                                 class="object-contain object-center w-40 h-40 md:w-52 md:h-52 lg:w-64 lg:h-64"
                                 alt="user">
                        @endif
                    </div>
                </div>
                <div class="p-4 w-full lg:w-3/5 xl:w-2/3">
                    <div class="text-primary">
                        <h4 class="mb-4 md:mb-6 text-xl font-medium text-primary">{{ $test->name }}</h4>
                        <p class="mb-3 md:mb-6 max-w-md text-sm md:text-base">{{ $test->description }}</p>
                        @if ($test->result?->status != \App\Models\Result::STATUS_COMPLETED)
                            @if ($test->type == \App\Models\Test::TYPE_CUBIA)
                                <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                               href="{{ $test->getTestLink(auth()->user(),'MIX') }}"
                                               class="items-center mb-4 xl:mb-0 -mt-0"
                                               target="_blank">
                                    {{ __('To the test of MIX') }}
                                </x-link-button>
                                <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                               href="{{ $test->getTestLink(auth()->user(),'IQT') }}"
                                               class="items-center mb-4 xl:mb-0 -mt-0"
                                               target="_blank">
                                    {{ __('To the test of IQ') }}
                                </x-link-button>
                            @else
                                <x-link-button :active="true" wire:click="startTest({{ $test->id }})"
                                               href="{{ $test->getTestLink(auth()->user()) }}"
                                               class="items-center mb-4 xl:mb-0 -mt-0"
                                               target="_blank">
                                    {{ __('To the test') }}
                                </x-link-button>
                            @endif
                        @else
                            <img src="{{ asset('images/icon/check.svg') }}" alt="test_taken">
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="flex items-center flex-wrap">

        </div>
    @endif
    @if(auth()->user()->application_status == \App\Enums\ApplicationStatus::TEST_TAKEN)
        <span class="text-2xl">
            {{ __('You will be informed as soon as the test results are available') }}
        </span>
    @endif
</div>
