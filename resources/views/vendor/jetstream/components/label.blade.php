@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-light text-xs text-black mb-2.5']) }}>
    {{ $value ?? $slot }}
</label>
