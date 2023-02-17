@component('mail::layout')
    @slot('header')
        @component('mail::header')
            <a target="_blank" href="{{ url('') }}">
                <img src="{{ url('images/logo.png') }}" alt="Logo" style="display: block;height:25px;margin-bottom: 20px;" title="Logo"
                    height="55">
            </a>
        @endcomponent
    @endslot
    @component('mail::table')
        <tr align="center">
            <td style="background-image: url('{{ url('images/register-bg.png') }}');height:312px;width:100%;background-position: center;background-size: cover;"
                alt="">
            </td>
        </tr>
        {{ $slot }}
    @endcomponent
    @slot('footer')
        @component('mail::footer')
            <tr align="left">
                <td>
                    <p style="display:inline-block;color:#003A79;line-height: 1.4;margin: 10px 0 0;">{{ __('mail.greetings_1') }} <br> {{ __('mail.greetings_2') }}</p>
                </td>
            </tr>
            <tr align="left">
                <td>
                    <p style="display:inline-block;color:#003A79;line-height: 1.4;margin: 10px 0 0;">
                        {{ __('mail.NORDAKADEMIE University of Applied Sciences') }} <br>
                        {{ __("Telephone") }}: +49 (0)4121 4090 - 154 <br>
                        <a target="_blank" href="https://www.nordakademie.de/">www.nordakademie.de</a></p>
                </td>
            </tr>
            <tr align="left">
                <td>
                    <p style="display:inline-block;color:#003A79;line-height: 1.4;margin: 10px 0 0;">{{ __('mail.technical-support-message') }}</p>
                </td>
            </tr>
        @endcomponent

    @endslot
@endcomponent
