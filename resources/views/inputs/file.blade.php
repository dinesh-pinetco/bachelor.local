<div class="mb-3">
    @if (!$errors->hasAny(['photo','fieldValue']) && $fieldValue)
        <div class="profile-img w-36 h-36 relative">
            <div class="w-full h-full rounded-full overflow-hidden">
                <img class="w-full h-full object-cover object-center"
                     src="{{ $fieldValue instanceof \Illuminate\Http\UploadedFile ? $fieldValue->temporaryUrl() : route('storage.url', ['path' => $fieldValue]) }}"
                     alt="{{ $field->label }}">
            </div>
            <a href="javascript:void(0);"
               class="img-overlay duration-150 ease-in rounded-full absolute top-0 left-0 w-full h-full bg-primary bg-opacity-80 flex justify-center items-center {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                <span @if ($isEdit) wire:click="delete" @endif>
                    <svg class="stroke-current w-6 h-6 text-white" fill="none">
                        <path
                            d="M10 11v6m4-6v6M4 7h16m-1 0l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7h14zm-4 0V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3h6z"
                            stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    @else
        <div class="h-36 flex flex-col justify-center" >
            {{-- <x-jet-label>{{ $field->label }}</x-jet-label> --}}
            <label
                class="w-44 flex flex-col items-center p-2 bg-primary text-white rounded-sm cursor-pointer hover:bg-opacity-90">
                <span class="text-base leading-normal">{{ __('Select a file') }}</span>
                <input wire:model="fieldValue" type="file" name="photo" id="{{ $field->id }}"
                    {{ $isEdit ? '' : 'disabled' }} class="hidden" accept="image/jpeg, image/jpg, image/png"
                    required="{{ $field->required() }}">
            </label>
            <h6 class="text-xs mt-2 font-light">JPG, max 1MB</h6>
        <x-jet-input-error for="photo" class="mt-2" />
        <x-jet-input-error for="{{$this->field->label}}" class="mt-2" />
    </div>
    @endif

</div>
