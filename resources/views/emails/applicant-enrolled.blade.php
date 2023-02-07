@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                @lang('mail.welcome', compact('name')) <br>
                @lang('mail.applicant-enrolled.paragraph1') <br>
                @lang('mail.applicant-enrolled.paragraph2') <br>
                @lang('mail.applicant-enrolled.paragraph3') <br>
            </p>
        </td>
    </tr>
    @component('mail::button', ['url' => $studySheetUrl])
        @lang('mail.applicant-enrolled.study-sheet-action')
    @endcomponent
    <br>
    @component('mail::button', ['url' => $governmentFormUrl])
        @lang('mail.applicant-enrolled.government-form-action')
    @endcomponent
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;">
                @lang('mail.applicant-enrolled.paragraph4') <br>
                @lang('mail.applicant-enrolled.paragraph5') <br>
            </p>
        </td>
    </tr>
@endcomponent
