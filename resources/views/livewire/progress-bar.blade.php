<div class="h-full">
    <div :class="{ 'bg-primary hover:bg-opacity-80 text-white': '{{ $overAllProgress == 100 }}' }"
         class="rounded-full flex items-center px-4 py-2 h-full text-primary">

        @if ($overAllProgress == 100 && auth()->user()->application_status->id() < \App\Enums\ApplicationStatus::PERSONAL_DATA_COMPLETED->id())
            <button wire:click="$set('show', true)"
                    class="hidden md:inline-block text-sm lg:text-base opacity-0 select-none text-white font-bold capitalize mr-6 -mb-0 opacity-100">{{ __('Submit') }}</button>
        @endif

        <div class="flex items-center space-x-4">
            <svg :class="{ 'text-white font-semibold': '{{ $overAllProgress == 100 }}' }" class="w-5 h-5"
                 viewBox="0 0 16 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.63406 1.95134C8.43473 1.33734 7.56606 1.33734 7.36606 1.95134L6.3534 5.06734C6.30978 5.20111 6.22496 5.31765 6.11108 5.40028C5.9972 5.4829 5.8601 5.52738 5.7194 5.52735H2.4434C1.79806 5.52735 1.52873 6.35401 2.0514 6.73401L4.70206 8.65935C4.81593 8.74212 4.90066 8.85881 4.94414 8.9927C4.98761 9.12659 4.98758 9.2708 4.94406 9.40468L3.93206 12.5207C3.73206 13.1347 4.4354 13.646 4.9574 13.266L7.60806 11.3407C7.72199 11.2579 7.85922 11.2133 8.00006 11.2133C8.14091 11.2133 8.27814 11.2579 8.39206 11.3407L11.0427 13.266C11.5647 13.646 12.2681 13.1353 12.0681 12.5207L11.0561 9.40468C11.0125 9.2708 11.0125 9.12659 11.056 8.9927C11.0995 8.85881 11.1842 8.74212 11.2981 8.65935L13.9487 6.73401C14.4707 6.35401 14.2027 5.52735 13.5567 5.52735H10.2801C10.1395 5.52724 10.0025 5.4827 9.88878 5.40008C9.77503 5.31746 9.69031 5.201 9.64673 5.06734L8.63406 1.95134Z"
                    stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
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
        <x-custom-modal wire:model="show">
            <x-slot name="title">
                {{ __('Submit Application') }}
            </x-slot>
            <div>
                <div class="space-y-3">
                    <p class="text-center text-red flex justify-center">
                        <svg class="h-12 w-12 stroke-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path
                                    d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z"/>
                        </svg>
                    </p>
                    <h4 class="text-center text-darkgray text-sm sm:text-base">
                        {{ __('Are you sure you want to submit this application.') }}?
                    </h4>
                </div>
            </div>
            <x-jet-input-error for="client" class="mt-1"/>
            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button data-cy="delete-button" wire:click="submit">
                        {{ __('Yes, submit it') }}
                    </x-danger-button>
                    <x-secondary-button data-cy="cancel-button"
                                        wire:click="$set('show', false)">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
            </x-slot>
        </x-custom-modal>
    </div>
</div>
