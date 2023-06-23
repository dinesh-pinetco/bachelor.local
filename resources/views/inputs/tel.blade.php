<x-tel-input id="phone"
             wire:model.lazy="fieldValue"
             class="block w-full text-black"
             value="{{ $fieldValue }}"
/>
<input id="old_value" type="hidden" value="{{ $fieldValue }}">

@push('scripts')
    <script >
        const input = document.querySelector("#phone");
        input.addEventListener('telchange', function (e) {
        const old_value = document.querySelector("#old_value");
            if (!e.detail.valid) {
                if (e.detail.number.includes(e.detail.dialCode) && old_value.value !== e.detail.number) {
                        @this.set('fieldValue', e.detail.number);
                } else {
                    const combineString = "+" + e.detail.dialCode + "" + e.detail.number;
                    if(old_value.value !== e.detail.number) {
                        @this.set('fieldValue', combineString);
                    }
                }
            }
        });
    </script>
@endpush
