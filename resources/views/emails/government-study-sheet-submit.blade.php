@component('mail::default')
    @component('mail::table')
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">
                    {{ __('mail.government-study-sheet.body') }} {{ __('mail.government-study-sheet.paragraph1', ['name' => $name, 'applicant_id' => $applicant_id]) }}
                </p>
            </td>
        </tr>
    @endcomponent
@endcomponent
,
