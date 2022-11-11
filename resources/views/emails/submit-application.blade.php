@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">@lang('mail.welcome', compact('name')) <br>
            @lang('mail.application-received.body', compact('courseName') )<br><br>
            @lang('mail.application-received.body2') <br><br>
            @lang('mail.application-received.body3') <br><br>
            @lang('mail.application-received.body5') <br><br>
                <br>
            @lang('mail.greeting-message') <br>
        </td>
    </tr>
@endcomponent
