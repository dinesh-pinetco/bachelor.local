<div class="absolute inset-0">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <input wire:model="files"
           multiple
           name="files"
           id="files"
           {{ $isEdit ?? 'disabled' }}
           type="file"
           accept="{{ $extensions->pluck('extension')->implode(',') ?? '' }}" class="absolute inset-0 opacity-0 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">

    @error('files')
    <span class="error">{{ $message }}</span> @enderror
</div>
