@component('mail::default')
    @component('mail::table')
        @if ($is_test_taken)
            <tr align="left">
                <td>
                    <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                        @lang('mail.welcome', compact('name')) <br>
                    </p>
                </td>
            </tr>
            <tr align="left">
                <td>
                    <p style="display:block;color:#003A79;line-height: 1.4;">
                        @lang('mail.new-application-approved.paragraph1') <br>
                        @lang('mail.new-application-approved.paragraph2') <br>
                        @lang('mail.new-application-approved.paragraph3') <br>
                        @lang('mail.new-application-approved.paragraph4') <br>
                        @lang('mail.new-application-approved.paragraph5') <br>
                    </p>
                </td>
            </tr>
        @else
            <tr align="left">
                <td>
                    <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                        @lang('mail.welcome', compact('name')) <br>
                        @lang('mail.application-approved.body')<br><br>
                        @lang('mail.application-approved.body2')<br>
                    </p>
                </td>
            </tr>
            @component('mail::button', ['url' => $link])
                @lang('mail.application-approved.action')
            @endcomponent
            <tr align="left">
                <td>
                    <p style="display:block;color:#003A79;line-height: 1.4;">
                        @lang('mail.application-approved.paragraph1') <br>
                        @lang('mail.application-approved.paragraph2') <br>
                        @lang('mail.application-approved.paragraph3') <br>
                        @lang('mail.application-approved.paragraph4') <br>
                        @lang('mail.application-approved.paragraph5') <br>
                    </p>
                </td>
            </tr>
        @endif
    @endcomponent
@endcomponent
