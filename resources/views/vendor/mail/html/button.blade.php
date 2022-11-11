@component('mail::table')
    <tr>
        <td align="center">
            <a style="display:inline-block;line-height:1.4;padding: 10px;background-color: #003A79;color: #ffffff;border-radius: 5px;text-decoration: none; margin-bottom: 16px;"
               href="{{ $url }}"
               target="_blank"
               rel="noopener">
                {{ $slot }}
            </a>
        </td>
    </tr>
@endcomponent
