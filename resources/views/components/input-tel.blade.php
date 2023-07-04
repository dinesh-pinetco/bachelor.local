@props([
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
])

@php
    $mergeAttributes = [
        'type' => 'tel',
        'class' => 'block w-full text-black'
        ];

    if ($attributes->get('disabled')){
        $mergeAttributes['disabled'] = true;
        $mergeAttributes['class'] = 'cursor-not-allowed text-gray bg-light-gray  text-dark-gray/50 ';
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
            error.textContent = "";

            document.getElementById('number').value = e.detail.number;
            if ( e.detail.number.length >= 6 && e.detail.valid) {
                @if($wireModel)
                    @this.set('{{ $wireModel }}', e.detail.number);
                @endif
            } else {
                error.textContent = "{{__("Please enter a valid number") }}";
            }
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
