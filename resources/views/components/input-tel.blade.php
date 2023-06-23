@props([
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
])

@php
    $mergeAttributes = [
        'type' => 'tel',
        'class' => 'w-full'
        ];

    if ($attributes->get('disabled')){
        $mergeAttributes['disabled'] = true;
        $mergeAttributes['class'] = 'cursor-not-allowed text-gray ';
    }
@endphp

<x-tel-input id="phone" {{ $attributes->except('disabled')->merge($mergeAttributes)}} />
<input type="hidden" id="number" name="phone"/>

@push('scripts')
    <script>
        const input = document.querySelector("#phone");
        input.addEventListener('telchange', function (e) {
            document.getElementById('phone').value = e.detail.number;
            document.getElementById('number').value = e.detail.number;
            @if($wireModel)
            if (e.detail.valid) {
                @this.set('{{ $wireModel }}', e.detail.number);
            } else {
                if (e.detail.number.includes(e.detail.dialCode)) {
                    @this.set('{{ $wireModel }}', e.detail.number);
                } else {
                    const combineString = "+" + e.detail.dialCode + "" + e.detail.number;
                    @this.set('{{ $wireModel }}', combineString);
                }
            }
            @endif
        });
        document.dispatchEvent(new Event('telDOMChanged'));
    </script>
@endpush
