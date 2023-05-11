@props(['setKey' => 'user.phone','setValue' => '' ,'name' => 'phone','isEdit' => true, 'required' => false, 'livewire' => true])
<input
    {{ $isEdit ? '' : 'disabled' }}
    type="tel"
    id="numberValue"
    class="tel-input h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base placeholder-gray w-full {{ $isEdit ? 'text-primary' : 'text-gray cursor-not-allowed' }}"
    maxlength="16"
    name="{{ $name }}"
    value="{{ $setValue }}"
    required="{{ $required }}">

<script>
    let PhoneNumber = null;

    const input = document.querySelector(".tel-input");

    window.onload = function() {
        PhoneNumber = intlTelInput(input, {
            separateDialCode: true,
            preferredCountries:["de"],
            utilsScript : "{{ asset('plugins/utils.js') }}",
        });

        input.addEventListener('input', function(event) {
            const inputValue = event.target.value;
            const numberPattern = /^[0-9]*$/;

            if (!numberPattern.test(inputValue)) {
                event.target.value = inputValue.replace(/\D/g, '');
            }
        });

    };

    if({{$livewire}}) {
        input.addEventListener("change", (event) => {
            @this.
            set('{{ $setKey }}', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
        });

        input.addEventListener("countrychange", function () {
            @this.
            set('{{ $setKey }}', PhoneNumber.getNumber(intlTelInputUtils.numberFormat.E164));
        });
    }
</script>

