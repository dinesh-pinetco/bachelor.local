<table style="margin-left: auto; margin-right: auto;" width="550">
    <tr>
        <td align="right">
            <img style="display:block;height:32px;margin-top:10px;margin-right: 52px;"
                 src="{{ asset('images/logo.png') }}"
                 alt="logo">
        </td>
    </tr>
    <table style="margin-top:30px;margin-left: auto; margin-right: auto;font-size: 14px;" width="550">
        <tr>
            <td style="font-size: 12px;width:58%;">
                <p style="font-size: 10px;color: #646464;">NORDAKADEMIE | Köllner Chaussee 11 | 25337 Elmshorn</p>
                <p style="margin-bottom: -8px;">{{ $user->full_name }}</p>
                <p style="margin-bottom: -8px;">{{ $street_house_number }}</p>
                <p>{{ $postal_code }}, {{ $location }}</p>
            </td>
            <td style="font-size: 11px;color: #646464;width: 42%;">
                <p class="flex-nowrap mr-24">NORDAKADEMIE Hochschule der Wirtschaft <br>
                    Köllner Chaussee 11 <br>
                    25337 Elmshorn</p>
                <p>Tel: 04121 4090 - 0 <br>
                    Fax: 04121 4090 - 40 <br>
                    info@nordakademie.de <br>
                    nordakademie.de <br>
                </p>
            </td>
        </tr>
    </table>
</table>
