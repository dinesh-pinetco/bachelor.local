@extends('laravel-finer::pdf.layout')

@section('content')
    @include('pdf._header')
    <div class="flex justify-end text-sm font-light mt-16 mr-28">
        <p>Elmshorn, den {{ $pass_pdf_created_at->format('d.F Y') }}</p>
    </div>

    <div class="mt-32 ml-32">
        <p class="mt-16">Lieber {{ $user->first_name }},</p>
        <p class="mt-10">nach Auswertung des Auswahlverfahrens zeigen deine Ergebnisse, dass du von deinen kognitiven
            <br>
            und motivationalen Kompetenzen gut zu den Studienanforderungen der Fachrichtung
            @foreach($user->desiredBeginning->courses->pluck('name') as $course)
                {{ $course.',' }}
            @endforeach
            an der NORDAKADEMIE, Hochschule der Wirtschaft passt. Wir freuen uns,
            dir daher mitteilen zu können, dass du dich weiter um einen Studienplatz für
            das Jahr {{ $user->desiredBeginning->course_start_date->format('Y') }}
            an der
            NORDAKADEMIE bei einem der ausbildenden Partnerunternehmen bewerben kannst.
        </p>
        <p class="mt-6">Für deinen weiteren Weg wünschen wir dir alles Gute.</p>
        <p class="mt-6">Herzliche Grüße</p>
        <p class="mt-6">Dein NORDAKADEMIE Test-Team</p>
    </div>
    @include('pdf._footer')
@endsection
