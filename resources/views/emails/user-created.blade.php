@component('mail::default')
    @component('mail::table')
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                    @lang('mail.welcome', compact('name')), <br>
                    @lang('mail.new-user.body1') <br>
                    @lang('mail.new-user.body2') <br>
                    @lang('mail.new-user.email', ['email' => $email])
                    @lang('mail.new-user.password', ['password' => $password])<br>
                </p>
            </td>
        </tr>
        @component('mail::button', ['url' => $link])
            {{ __('Click here to go to the applicant portal') }}
        @endcomponent
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;">
                    @lang('mail.new-user.body3') <br><br>
                    @lang('mail.greeting-message') <br>
                </p>
            </td>
        </tr>
    @endcomponent
@endcomponent
