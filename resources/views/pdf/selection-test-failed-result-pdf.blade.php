@extends('laravel-finer::pdf.layout')

@section('content')
    @include('pdf._header')

    @php
        Carbon\Carbon::setlocale($user->locale);
    @endphp

    <table style="margin-left: auto; margin-right: auto;" width="550">
        <tr>
            <td align="right">
                <p style="font-size: 14px;margin-right: 52px;">Elmshorn,
                    den {{ $fail_pdf_created_at->translatedFormat('d.F Y') }}</p>
            </td>
        </tr>

        <tr>
            <td>
                <p style="font-size:14px;">Lieber {{ $user->first_name }},</p>
                <p style="font-size: 14px;margin-right: 52px;margin-top:30px;">leider müssen wir dir nach Auswertung
                    deines Ergebnisses im Auswahlverfahren mitteilen,
                    dass
                    die Anforderungen an Bewerber auf ein Studium der Fachrichtung
                    {{ $courses }}
                    zur
                    Zeit (noch) nicht ausreichend erfüllst. Ein erfolgreicher Abschluss des Studiums an der
                    NORDAKADEMIE ist daher in deinem Fall eher unwahrscheinlich. Bitte sieh daher für den
                    Studienbeginn {{ $user->desiredBeginning->course_start_date->translatedFormat('F-Y') }} von Bewerbungen bei
                    Kooperationsunternehmen der Hochschule ab. </p>
                <p style="font-size: 14px;margin-right: 52px;">
                    Sieh dies auch von einer konstruktiven Seite: Das „negative“ Ergebnis kann dich dazu ermuntern,
                    noch einmal über den für dich am besten geeigneten Weg nachzudenken. Vielleicht passt du vom
                    Profil her ja besser zu einer anderen Hochschule, einem anderen Studiengang oder einer dualen
                    Ausbildung? Sollte bei deinem Reflexionsprozess am Ende herauskommen, dass du doch gerne an
                    der NORDAKADEMIE studieren würdest, dann darfst du dich gern im nächsten Jahr erneut dem
                    Auswahlverfahren stellen. Vielleicht hast du dich bis dahin so entwickelt, dass es dann klappt!
                </p>
                <p style="font-size: 14px;margin-right: 52px;">
                    Für deinen weiteren Weg wünschen wir dir in jedem Fall alles Gute. Vielen Dank, dass du dich bei
                    <br>
                    der NORDAKADEMIE beworben hast.
                </p>
                <p style="font-size:14px;">Herzliche Grüße</p>
                <p style="font-size:14px;">Dein NORDAKADEMIE Test-Team</p>
            </td>
        </tr>
    </table>
    @include('pdf._footer')
@endsection
