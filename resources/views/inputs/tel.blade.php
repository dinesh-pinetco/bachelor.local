<div wire:ignore>
    <input
        {{ $isEdit ? '' : 'disabled' }}
        type="tel"
        id="numberValue"
        class="tel-input h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base placeholder-gray w-full {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
        maxlength="16"
        required="{{ $field->required() }}">
</div>
@push('scripts')
    <script>
        let PhoneNumber = null;
        initialiseValue();
        const input = document.querySelector(".tel-input");

        window.onload = function () {
            initialiseTeleInput();
        };
        input.addEventListener("change", (event) => {
            @this.set('fieldValue', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
        });

        input.addEventListener("countrychange", function() {
            @this.set('fieldValue', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
        });

        Livewire.on('initialiseTelInput', () => {
            initialiseValue();
        });

        function initialiseValue() {
            {{--alert({{ $fieldValue }});--}}
            @if($fieldValue)
            document.getElementById('numberValue').value = "{{ $fieldValue }}";

            @endif
        }

        function initialiseTeleInput() {
            PhoneNumber = intlTelInput(input, {
                separateDialCode: true,
                preferredCountries: ["de"],
                utilsScript: "{{ asset('plugins/utils.js') }}",
            });

            const numberInput = document.querySelector(".tel-input");
            numberInput.addEventListener('input', function(event) {
                const inputValue = event.target.value;
                const numberPattern = /^[0-9]*$/;

                if (!numberPattern.test(inputValue)) {
                    event.target.value = inputValue.replace(/\D/g, '');
                }
            });
        }
    </script>
@endpush
