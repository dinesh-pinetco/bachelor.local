<div wire:key="{{ $media->id }}"
     class="max-w-4xl px-4 md:px-6 lg:px-8 py-3 bg-lightgray rounded-sm flex items-center text-base">
    <div class="flex items-center flex-grow w-1/3 pr-4">

        @if (!auth()->user()->hasRole(ROLE_APPLICANT) && $media->tag != 'private_document')
            <div class="form-check mr-2">
                <input id="flexCheckChecked" wire:model="media.is_check" @if ($isEdit) wire:change="handleIsCheck" @else {{ "disabled" }} @endif
                       class="flex-shrink-0 w-5 h-5 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                       type="checkbox">
                <label class="form-check-label inline-block hidden" for="flexCheckChecked">
                    {{ __('Is check') }}
                </label>
            </div>
        @endif
        <a href="{{ $media->url }}" target="_blank" class="block w-full truncate font-bold">{{ $media->name }}</a>
    </div>
    <button @if ($isEdit) wire:click.prevent="delete" @endif type="button"
            class="py-2 flex-shrink-0 inline-block {{ $isEdit ?  'cursor-pointer' : 'cursor-not-allowed' }}">
        <svg class="w-5 h-5 text-red" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7 9V15M11 9V15M1 5H17M16 5L15.133 17.142C15.0971 17.6466 14.8713 18.1188 14.5011 18.4636C14.1309 18.8083 13.6439 19 13.138 19H4.862C4.35614 19 3.86907 18.8083 3.49889 18.4636C3.1287 18.1188 2.90292 17.6466 2.867 17.142L2 5H16ZM12 5V2C12 1.73478 11.8946 1.48043 11.7071 1.29289C11.5196 1.10536 11.2652 1 11 1H7C6.73478 1 6.48043 1.10536 6.29289 1.29289C6.10536 1.48043 6 1.73478 6 2V5H12Z"
                stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</div>
