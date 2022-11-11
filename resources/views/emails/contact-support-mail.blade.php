@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">{{$name}} ({{$email}})</p>
        </td>
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">{!! $message !!}</p>
        </td>
    </tr>
@endcomponent
