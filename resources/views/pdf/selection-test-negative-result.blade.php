<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-end">
        <img class="mt-8 mr-32"
            src="https://www.nordakademie.de/sites/default/files/images/be1b74dbdfb593baee229cab329a599c/250/logo_1.webp"
            alt="logo">
    </div>
    <div class="flex text-sm font-light text-gray-500">
        <p class="flex-1 mt-20 ml-32">NORDAKADEMIE | Köllner Chaussee 11 | 25337 Elmshorn</p>
        <p class="flex-nowrap mr-24 mt-20">NORDAKADEMIE Hochschule der Wirtschaft <br>
            Köllner Chaussee 11 <br>
            25337 Elmshorn</p>
    </div>

    <div class="flex justify-end text-sm font-light mt-16 mr-28">
        <p>Elmshorn, den 29. September 2022</p>
    </div>

    <div class="mt-32 ml-32">
        <p class="mt-16">Lieber {{ $user->first_name }},</p>
        <p class="mt-10">leider müssen wir dir nach Auswertung deines Ergebnisses im Auswahlverfahren mitteilen, dass
            du <br>
            die Anforderungen an Bewerber auf ein Studium der Fachrichtung Betriebswirtschaftslehre zur <br>
            Zeit (noch) nicht ausreichend erfüllst. Ein erfolgreicher Abschluss des Studiums an der <br>
            NORDAKADEMIE ist daher in deinem Fall eher unwahrscheinlich. Bitte sieh daher für den <br>
            Studienbeginn Oktober 2022 von Bewerbungen bei Kooperationsunternehmen der Hochschule ab. </p>
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
</body>

<footer>
    <div class="mt-32 ml-32">
        <div style="margin-top: 5%;" class="mb-3">{!! DNS2D::getBarcodeHTML("http://bachelor.nak.test/verified/$email", 'QRCODE',3,3) !!}</div>
    </div>

    <div class="flex text-sm font-light mt-20 mb-20">
        <img class="w-20 h-20 ml-14 flex-nowrap"
            src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTvg6oLc3ZWygJ9Vvoc2S7XAFBS1vcZGiYAdbJCGzex4E4STFKZ"
            alt="">
        <p align="center" class="flex-nowrap ml-20"><b>NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der
                Wirtschaft</b> <br>
            <b>Vorstand:</b><span class="text-gray-500"> Dipl.-Wirtsch.-Ing. (FH) Christoph Fülscher, Prof. Dr. Stefan
                Wiedmann</span> <br>
            <b>Aufsichtsrat:</b><span class="text-gray-500"> Holger Micheel-Sprenger (Vorsitzender), Dr. Nico Fickinger
                (stellv. Vorsitzender)</span> <br>
            <b>Bankverbindungen:</b><span class="text-gray-500"> Sparkasse Südholstein | IBAN DE27 2305 1030 0002 2509
                75 | SWIFT/BIC NOLADE21SHO</span>
            <br>
            <b>Neue Bankverbindung:</b><span class="text-gray-500"> Bank | IBAN DE73 2219 1405 0017 0281 51 | SWIFT/BIC
                GENODEF1PIN </span><br>
            <b>Sitz:</b> <span class="text-gray-500"> Elmshorn, Amtsgericht Pinneberg, HRB 1682 EL | St.-Nr.:
                DE277063065L</span>
        </p>
    </div>
</footer>

</html>
