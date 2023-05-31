@props([
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
    'value' => '',
    'name' => '',
    'required' => false,
    'disabled' => false
])
<x-tel-input id="phone"
             {{--             class="block w-full @if($disabled) cursor-not-allowed opacity-50 @endif"--}}
             class="block w-full text-black"
             {{--             {!! $attributes->except(['id', $attributes->wire('model')->directive])->merge(['class' => 'tel-input w-full h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray']) !!}--}}
             value="{{ $value }}"
/>
<input type="hidden" id="number" name="phone"/>

@push('scripts')
    <script>
        const input = document.querySelector("#phone");
        input.addEventListener('telchange', function(e) {
            document.getElementById('phone').value = e.detail.number;
            document.getElementById('number').value = e.detail.number;
            @if($wireModel)
                if(e.detail.valid)
                {
                    @this.set('{{ $wireModel }}', e.detail.number);
                } else {
                    if(e.detail.number.includes(e.detail.dialCode)){
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
