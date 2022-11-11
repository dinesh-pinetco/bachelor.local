@component('mail::default')
    @component('mail::table')
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                    @lang('mail.welcome', compact('name')) <br>
                    @lang('mail.reset-password.body') <br>
                    @lang('mail.reset-password.paragraph1')
                    @lang('mail.reset-password.paragraph2')
                </p>
            </td>
        </tr>
        @component('mail::button', ['url' => $url])
            @lang('mail.reset-password.action')
        @endcomponent
    @endcomponent
@endcomponent
