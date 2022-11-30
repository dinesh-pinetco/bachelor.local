@component('mail::default')
    <tr align="left">
        <td>
            <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">{{$name}} ({{$email}})</p><br>
            <p style="display:block;color:#003A79;line-height: 1.4;">{!! $message !!}</p>
        </td>
    </tr>
@endcomponent
