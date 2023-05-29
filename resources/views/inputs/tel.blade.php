<div wire:ignore>
    <x-tel-input
        id="phone"
        maxlength="16"
        value="{{ $fieldValue }}"
        required="{{ $field->required() }}"
        class="tel-input h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base placeholder-gray w-full {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
    />
</div>

@push('scripts')
    <script>
        const input = document.querySelector("#phone");
        input.addEventListener('keyup', function (event) {
            const inputValue = event.target.value;
            const numberPattern = /^[0-9]*$/;

            if (!numberPattern.test(inputValue)) {
                event.target.value = inputValue.replace(/\D/g, '');
            }
        });
        input.addEventListener('telchange', function(e) {
            if(e.detail.valid)
            {
                @this.set('fieldValue', e.detail.number);
            } else {
                if(e.detail.number.includes(e.detail.dialCode)){
                    @this.set('fieldValue', e.detail.number);
                } else {
                    const combineString = "+" + e.detail.dialCode + "" + e.detail.number;
                    @this.set('fieldValue', combineString);
                }
            }
        });
    </script>
@endpush


