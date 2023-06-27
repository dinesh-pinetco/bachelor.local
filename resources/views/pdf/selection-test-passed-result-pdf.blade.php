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
                    den {{ $pass_pdf_created_at->translatedFormat('d F Y') }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:14px;">Lieber {{ $user->first_name }},</p>
                <p style="font-size: 14px;margin-right: 52px;margin-top: 30px;">nach Auswertung des Auswahlverfahrens zeigen deine
                    Ergebnisse, dass du von deinen
                    kognitiven
                    <br>
                    und motivationalen Kompetenzen gut zu den Studienanforderungen der Fachrichtung
                    {{ $courses }}
                    an der NORDAKADEMIE, Hochschule der Wirtschaft passt. Wir freuen uns,
                    dir daher mitteilen zu können, dass du dich weiter um einen Studienplatz für
                    das Jahr {{ $user->selectedDesiredBeginning->course_start_date->translatedFormat('Y') }}
                    an der
                    NORDAKADEMIE bei einem der ausbildenden Partnerunternehmen bewerben kannst.
                </p>
                <p style="font-size: 14px;margin-right: 52px;">Für deinen weiteren Weg wünschen wir dir alles Gute.</p>
                <p style="font-size:14px;">Herzliche Grüße</p>
                <p style="font-size:14px;">Dein NORDAKADEMIE Test-Team</p>
            </td>
        </tr>
    </table>
    @include('pdf._footer')
@endsection
