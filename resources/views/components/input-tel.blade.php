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
<span class="text-red" id="error_phone"></span>


@push('scripts')
    <script>
        const input = document.querySelector("#phone");
        var error = document.getElementById("error_phone")

        input.addEventListener('telchange', function (e) {
            document.getElementById('phone').value = e.detail.number;
            document.getElementById('number').value = e.detail.number;
            @if($wireModel)
                if (e.detail.valid) {
                    @this.set('{{ $wireModel }}', e.detail.number);
                } else {
                    error.textContent = "{{__("Please enter a valid number") }}";
                }
            @endif
        });

        window.addEventListener('refreshTelJs', event => {
            var element = document.querySelector('.iti--allow-dropdown');

            if(!element){
                document.dispatchEvent(new Event('telDOMChanged'));
            }
        });

        document.dispatchEvent(new Event('telDOMChanged'));
    </script>
@endpush
