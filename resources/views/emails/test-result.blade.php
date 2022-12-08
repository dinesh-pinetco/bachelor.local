@component('mail::default')
    @component('mail::table')
        <tr align="left" style="padding: 2%;background: white;font-size: 12px;">
            <td style="color: black;">
                <p style="line-height: 1.4;margin-top: 5%;">Lieber {{ $user->full_name }}, <br><br>
                    die Auswertung deiner Ergebnisse fur dem
                    Auswahltest der
                    NORDAKADEMIE ist ab sooft verfügbar.</p>
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
                <p style="line-height: 1.4;margin: 20px 0;">Mit freundlichen Grüßen</p>
                <p style="line-height: 1.4;margin-top: 20px;">Das Auswahltestportal der NORDAKADEMIE</p>
                <br>
            </td>
        </tr>
    @endcomponent
@endcomponent
