@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                @lang('mail.welcome', compact('name')) <br>
                @lang('mail.contract-received.paragraph1') <br>
                @lang('mail.contract-received.paragraph2') <br>
                @lang('mail.contract-received.paragraph3') <br>
            </p>
        </td>
    </tr>
    @component('mail::button', ['url' => $studySheetUrl])
        @lang('mail.contract-received.study-sheet-action')
    @endcomponent
    <br>
    @component('mail::button', ['url' => $governmentFormUrl])
        @lang('mail.contract-received.government-form-action')
    @endcomponent
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;">
                @lang('mail.contract-received.paragraph4') <br>
                @lang('mail.contract-received.paragraph5') <br>
            </p>
        </td>
    </tr>
@endcomponent
