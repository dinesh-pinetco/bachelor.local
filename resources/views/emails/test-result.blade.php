@component('mail::default')
    @component('mail::table')
        <tr align="left" style="padding: 2%;background: white;font-size: 12px;">
            <td style="color: black;">
                <p style="line-height: 1.4;margin-top: 5%;">Moin {{ $user->first_name }}, <br><br>
                    die Auswertung deiner Ergebnisse für dem
                    Auswahltest der
                    NORDAKADEMIE ist ab sofort verfügbar.</p>
                <p style="line-height: 1.4;margin: 20px 0;">Bitte logge dich unter
                    <a href="{{ route('selection-test.index') }}"
                        style="text-decoration: underline;color:#003A79;">{{ route('selection-test.index') }}</a> ein
                    und
                    lade deine Auswertung herunter.
                    Diese Auswertung kannst du dann deiner Bewerbung bei unseren Kooperationsunternehmen beifügen. Du
                    erhältst
                    deine Auswertung nicht direkt per E-Mail, da diese persönliche Daten enthält, die wir Ihnen nicht
                    auf
                    diesem
                    Weg zur Verfügung stellen wollen. Die Verbindung, über die du deine Auswertung herunterladen kannst,
                    ist
                    verschlüsselt und kann daher nicht einfach verändert werden, wodurch wir die Korrektheit deiner
                    Auswertung
                    sicherstellen können.
                </p>
                <span style="font-size:16px;padding-top:20px;display:block;">Mit freundlichen Grüßen</span>
            </td>
        </tr>
    @endcomponent
@endcomponent
