<div class="h-full flex items-center">
        @if ($overAllProgress == 100 && auth()->user()->application_status->id() <= \App\Enums\ApplicationStatus::APPLIED_ON_MARKETPLACE->id())
            <button wire:click="$set('show', true)"
                    class="hidden md:inline-block text-sm lg:text-base opacity-0 select-none bg-red rounded-full px-4 py-2 text-white font-bold capitalize mr-4 -mb-0 opacity-100">{{ __('Submit') }}</button>
        @endif
        <div @class([
            'rounded-full flex items-center px-4 py-2 h-full',
            'text-primary' => $overAllProgress < 100,
            'bg-darkgreen hover:bg-opacity-80 text-white' => $overAllProgress == 100 && auth()->user()->application_status->id() >= \App\Enums\ApplicationStatus::APPLIED_ON_MARKETPLACE->id(),
            'bg-primary hover:bg-opacity-80 text-white' => $overAllProgress == 100,
         ])>

        <div class="flex items-center space-x-4">
            <svg data-tippy-content="({{ __('Here you can see the progress of your application. After filling out all mandatory fields, your application progress is at 100% and a button appears to submit your application. On the way to 100%, your entries are automatically saved so that no data is lost.') }})" :class="{ 'text-white font-semibold': '{{ $overAllProgress == 100 }}' }" class="w-5 h-5 cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                d="M12 8V12M12 16H12.01M21 12C21 13.1819 20.7672 14.3522 20.3149 15.4442C19.8626 16.5361 19.1997 17.5282 18.364 18.364C17.5282 19.1997 16.5361 19.8626 15.4442 20.3149C14.3522 20.7672 13.1819 21 12 21C10.8181 21 9.64778 20.7672 8.55585 20.3149C7.46392 19.8626 6.47177 19.1997 5.63604 18.364C4.80031 17.5282 4.13738 16.5361 3.68508 15.4442C3.23279 14.3522 3 13.1819 3 12C3 9.61305 3.94821 7.32387 5.63604 5.63604C7.32387 3.94821 9.61305 3 12 3C14.3869 3 16.6761 3.94821 18.364 5.63604C20.0518 7.32387 21 9.61305 21 12Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            <div class="w-20 xl:w-44 relative">
                <div class="overflow-hidden h-2 xl:h-3 text-xs flex rounded-full bg-lightgray">
                    <div style="width:{{ $overAllProgress }}%"
                         class="shadow-none flex flex-col text-center rounded-full whitespace-nowrap text-white justify-center
                            @if ($overAllProgress == 0) bg-gray
                            @elseif($overAllProgress < 100) bg-primary-light
                            @elseif($overAllProgress == 100) bg-white @endif transition duration-150 ease-in-out">
                    </div>
                </div>
            </div>
            <span :class="{ 'text-white font-semibold': '{{ $overAllProgress == 100 }}' }" class="text-sm">
                {{ $overAllProgress }}%</span>
        </div>

    </div>

    <div>
        <x-custom-modal width="w-2/5" wire:model="show">
            <x-slot name="title">
                {{ __('Submit application') }}
            </x-slot>
            <div>
                <div class="space-y-3">
                    <p class="text-center text-red flex justify-center">
                        <img class="h-16 w-16" src="{{ asset('images/icon/congratulation.png') }}" alt="congratulations">
                    </p>
                    <h4 class="text-center text-darkgray text-sm sm:text-base">
                        {{ __('Congratulations! You have entered all data in the application process.') }}
                    </h4>
                    <h4 class="text-center text-darkgray text-sm sm:text-base">
                        {{ __('In the next step you can select and mark the companies you want to apply to.') }}
                    </h4>
                    <h4 class="text-center text-darkgray text-sm sm:text-base">
                        {{ __('You can also activate your data for all our partner companies to view, as this increases your chances of a dual study place even further.') }}
                    </h4>
                </div>
            </div>
            <x-jet-input-error for="client" class="mt-1"/>
            <x-slot name="footer">
                <div class="flex justify-center space-x-4 mt-7">
                    <x-danger-button class="bg-primary border-primary px-4 py-2.5 lg:px-5 lg:py-3" data-cy="delete-button" wire:click="submit">
                        {{ __('Yes') }}
                    </x-danger-button>
                    <x-secondary-button data-cy="cancel-button"
                                        wire:click="$set('show', false)">
                        {{ __('No') }}
                    </x-secondary-button>
                </div>
            </x-slot>
        </x-custom-modal>
    </div>
</div>
