@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">@lang('mail.welcome', compact('name')) <br>
            <p style="display:block;color:#003A79;line-height: 1.4;">
                @lang('mail.contract-sent.paragraph1',['studyCourse'=> $course,'desiredBeginning'=> $desiredBeginning])<br>
                @lang('mail.contract-sent.paragraph2')<br>
                @lang('mail.contract-sent.paragraph3')<br><br>
                @lang('mail.greeting-message')<br>
            </p>
        </td>
    </tr>
@endcomponent
