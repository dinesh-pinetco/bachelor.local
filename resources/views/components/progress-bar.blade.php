@props(['progress'=> 0])
<div class="flex-shrink-0 mt-4 md:mt-9 w-full relative">
    <div class="overflow-hidden h-3 md:h-4 lg:h-5 text-xs flex rounded-full bg-lightgray">
        <div style="width:{{ $progress*4 }}%"
             class="shadow-none flex flex-col text-center rounded-full whitespace-nowrap text-white justify-center
                                @if($progress == 0) bg-gray
                                @elseif($progress < 25) bg-primary-light
                                @elseif($progress == 25) bg-primary
                                @endif transition duration-150 ease-in-out">
        </div>
    </div>
</div>
