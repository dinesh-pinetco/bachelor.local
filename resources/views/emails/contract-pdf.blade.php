@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                @lang('mail.welcome', compact('name')) <br>
                @lang('mail.contract-pdf.paragraph1') <br>
            </p>
        </td>
    </tr>
    <br>
@endcomponent
