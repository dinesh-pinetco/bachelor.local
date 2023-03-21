<div class="absolute inset-0">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <input wire:model="files"
           multiple
           name="files"
           id="files"
           :disabled="{{ !$isEdit }}"
           type="file"
           accept="{{ $extensions->pluck('extension')->implode(',') ?? '' }}" class="absolute inset-0 opacity-0 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
           wire:loading.attr="disabled" wire:loading.class='opacity-80 cursor-wait'>
           @error('files.*')
                <span class="text-red absolute bottom-2 md:bottom-4 lg:bottom-6 left-0 right-10 w-full text-center">{{ $message }}</span>
            @enderror
</div>
