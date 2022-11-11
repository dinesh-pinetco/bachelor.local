<div class="h-full">
    <div :class="{ 'bg-primary hover:bg-opacity-80 text-white': '{{ $overAllProgress == 100 }}' }"
         class="rounded-full flex items-center px-4 py-2 h-full text-primary">

        @if ($overAllProgress == 100 && auth()->user()->is_eligible_to_update)
            <form method="GET" action="{{ route('submit-application') }}">
                @csrf
                <a href="javascript:void(0);" onclick="event.preventDefault(); this.closest('form').submit();" :class="{ 'opacity-100': '{{ $overAllProgress == 100 }}' }"
                       class="hidden md:inline-block text-sm lg:text-base opacity-0 select-none text-white font-bold capitalize mr-6 -mb-0">{{ __('Submit') }}</a>
            </form>
        @endif

        <div class="flex items-center space-x-4">
            <svg :class="{ 'text-white font-semibold': '{{ $overAllProgress == 100 }}' }" class="w-5 h-5" viewBox="0 0 16 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.63406 1.95134C8.43473 1.33734 7.56606 1.33734 7.36606 1.95134L6.3534 5.06734C6.30978 5.20111 6.22496 5.31765 6.11108 5.40028C5.9972 5.4829 5.8601 5.52738 5.7194 5.52735H2.4434C1.79806 5.52735 1.52873 6.35401 2.0514 6.73401L4.70206 8.65935C4.81593 8.74212 4.90066 8.85881 4.94414 8.9927C4.98761 9.12659 4.98758 9.2708 4.94406 9.40468L3.93206 12.5207C3.73206 13.1347 4.4354 13.646 4.9574 13.266L7.60806 11.3407C7.72199 11.2579 7.85922 11.2133 8.00006 11.2133C8.14091 11.2133 8.27814 11.2579 8.39206 11.3407L11.0427 13.266C11.5647 13.646 12.2681 13.1353 12.0681 12.5207L11.0561 9.40468C11.0125 9.2708 11.0125 9.12659 11.056 8.9927C11.0995 8.85881 11.1842 8.74212 11.2981 8.65935L13.9487 6.73401C14.4707 6.35401 14.2027 5.52735 13.5567 5.52735H10.2801C10.1395 5.52724 10.0025 5.4827 9.88878 5.40008C9.77503 5.31746 9.69031 5.201 9.64673 5.06734L8.63406 1.95134Z"
                    stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" />
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
</div>
