<x-tel-input id="phone"
             key="phone"
             {{--             wire:model.lazy="fieldValue"--}}
             class="block w-full text-black"
             value="{{ $fieldValue }}"
/>
<span class="text-red" id="error_phone"></span>

@push('scripts')
    <script>
        const input = document.querySelector("#phone");
        var error = document.getElementById("error_phone")

        input.addEventListener('telchange', function (e) {
            if(e.detail.number.length >= 6) {
                if (e.detail.valid) {
                    @this.set('fieldValue', e.detail.number);
                } else {
                    error.textContent = "{{__("Please enter a valid number") }}";
                }
            }
        });
    </script>
@endpush
