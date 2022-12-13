@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                @lang('mail.failed-applicant.welcome',compact('admin')) <br><br>
                @lang('mail.failed-applicant.body',compact('name')) <br><br>
                <br>
            </p>
        </td>
    </tr>
    @component('mail::button', ['url' => $url])
            @lang('mail.failed-applicant.action')
        @endcomponent
@endcomponent
