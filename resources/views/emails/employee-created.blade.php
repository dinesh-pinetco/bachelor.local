@component('mail::default')
    @component('mail::table')
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                    @lang('mail.welcome', compact('name')) <br>
                    @lang('mail.new-employee.body1') <br>
                    @lang('mail.new-employee.email', ['email' => $email])
                    @lang('mail.new-employee.password', ['password' => $password])<br>
                </p>
            </td>
        </tr>
        @component('mail::button', ['url' => $link])
            {{ __('Here you can access the application portal') }}
        @endcomponent
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                    @lang('mail.greeting-message') <br>
                </p>
            </td>
        </tr>
    @endcomponent
@endcomponent
