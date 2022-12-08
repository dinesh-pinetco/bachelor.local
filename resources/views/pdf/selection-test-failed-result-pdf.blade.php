@extends('laravel-finer::pdf.layout')

@section('content')
    @include('pdf._header')
    <div class="flex justify-end text-sm font-light mt-16 mr-28">
        <p>Elmshorn, den {{ $fail_pdf_created_at->format('d.F Y') }}</p>
    </div>

    <div class="mt-32 ml-32">
        <p class="mt-16">Lieber {{ $user->first_name }},</p>
        <p class="mt-10">leider müssen wir dir nach Auswertung deines Ergebnisses im Auswahlverfahren mitteilen, dass
            du <br>
            die Anforderungen an Bewerber auf ein Studium der Fachrichtung
            {{ $courses }}
            zur <br>
            Zeit (noch) nicht ausreichend erfüllst. Ein erfolgreicher Abschluss des Studiums an der <br>
            NORDAKADEMIE ist daher in deinem Fall eher unwahrscheinlich. Bitte sieh daher für den <br>
            Studienbeginn {{ $user->desiredBeginning->course_start_date->format('F-Y') }} von Bewerbungen bei Kooperationsunternehmen der Hochschule ab. </p>
        <p class="mt-6">
            Sieh dies auch von einer konstruktiven Seite: Das „negative“ Ergebnis kann dich dazu ermuntern, <br>
            noch einmal über den für dich am besten geeigneten Weg nachzudenken. Vielleicht passt du vom <br>
            Profil her ja besser zu einer anderen Hochschule, einem anderen Studiengang oder einer dualen <br>
            Ausbildung? Sollte bei deinem Reflexionsprozess am Ende herauskommen, dass du doch gerne an <br>
            der NORDAKADEMIE studieren würdest, dann darfst du dich gern im nächsten Jahr erneut dem <br>
            Auswahlverfahren stellen. Vielleicht hast du dich bis dahin so entwickelt, dass es dann klappt! <br>
        </p>
        <p class="mt-6">
            Für deinen weiteren Weg wünschen wir dir in jedem Fall alles Gute. Vielen Dank, dass du dich bei <br>
            der NORDAKADEMIE beworben hast.
        </p>
        <p class="mt-6">Herzliche Grüße</p>
        <p class="mt-6">Dein NORDAKADEMIE Test-Team</p>
    </div>
    @include('pdf._footer')
@endsection
