@props([
    'wireModel' => $attributes->whereStartsWith('wire:model')->first(),
])

<input id="phone"
    {!! $attributes->merge(['class' => 'tel-input w-full h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray']) !!}
>
@push('scripts')
    <script src="{{ asset('plugins/intlTelInput.min.js') }}"></script>
    <script>
        let PhoneNumber = null;

        document.addEventListener('DOMContentLoaded', function () {
            const input = document.querySelector("#phone");

            PhoneNumber = intlTelInput(input, {
                separateDialCode: true,
                preferredCountries: ["de"],
                utilsScript: "{{ asset('plugins/utils.js') }}",
            });

            input.addEventListener('input', function (event) {
                const inputValue = event.target.value;
                const numberPattern = /^[0-9]*$/;

                if (!numberPattern.test(inputValue)) {
                    event.target.value = inputValue.replace(/\D/g, '');
                }
            });

            input.addEventListener("change", () => {
                input.value = PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164);

                @if($wireModel)
                @this.
                set('{{ $wireModel }}', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
                @endif
            });

            input.addEventListener("countrychange", function () {
                input.value = PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164);

                @if($wireModel)
                @this.
                set('{{ $wireModel }}', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
                @endif
            });
        });
    </script>
@endpush
