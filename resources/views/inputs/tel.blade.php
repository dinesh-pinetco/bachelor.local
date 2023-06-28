<x-tel-input id="phone"
{{--             wire:model.lazy="fieldValue"--}}
             class="block w-full text-black"
             value="{{ $fieldValue }}"
/>
<input id="old_value" type="hidden" value="{{ $fieldValue }}">
<span class="text-red" id="error_phone"></span>

@push('scripts')
    <script >
        const input = document.querySelector("#phone");
        var error = document.getElementById("error_phone")

        input.addEventListener('telchange', function (e) {
        const old_value = document.querySelector("#old_value");
            if (e.detail.valid) {
                @this.set('fieldValue', input.value);
            } else {
                error.textContent = "{{__("Please enter a valid number") }}";
            }
        });
    </script>
@endpush
