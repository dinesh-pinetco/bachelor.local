@extends('laravel-finer::pdf.layout')

@section('content')
    @php
        Carbon\Carbon::setlocale($user->locale);
    @endphp
        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td align="center">
                    <h2 style="margin-top: 20px;font-weight: bold;color: black;font-size: 25px;">Studienvertrag für Studierende der NORDAKADEMIE</h2>
                    <h2 style="margin-top: 20px;font-weight: bold;color: black;font-size: 25px;">Duales Studium - Bachelor of Science</h2>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    Studienjahr
                </td>
                <td>
                    {{ $desiredBeginning->format('Y') }}
                </td>
                <td>
                    Beginn:
                </td>
                <td>
                    {{ "[1. Oktober ".$desiredBeginning->format('Y')."]" }}
                </td>
                <td>
                    Ende:
                </td>
                <td>
                    year of desired beginning
                </td>
            </tr>
            <tr>
                <td>
                    Zwischen
                </td>
            </tr>
        </table>
        <table align="center">
            <tr>
                <td>
                    der NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft
                </td>
            </tr>
            <tr>
                <td>Köllner Chaussee 11</td>
            </tr>
            <tr>
                <td> 25337 Elmshorn </td>
            </tr>
            <tr>
                <td> Telefon: +49 (0)4121 4090-0 </td>
            </tr>
            <tr>
                <td> Fax: +49 (0)4121 4090-40 </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>nachfolgend - Hochschule -</td>
            </tr>
            <tr>
                <td>und</td>
            </tr>
        </table>
        <table align="center">
            <tr>
                <td>{{ $user->fullName }}</td>
            </tr>
            <tr>
                <td>{{ $street_no }}</td>
            </tr>
            <tr>
                <td>{{ $zip.' '. $city }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td>nachfolgend - Studierende/r -</td>
            </tr>
            <tr>
                <td>über die Einschreibung zum 1. Oktober {{ $desiredBeginning->format('Y') }} an der NORDAKADEMIE im Studiengang {{ $course }}.</td>
            </tr>
        </table>

        <table style="margin-top:auto;margin-left: auto; margin-right: auto;font-size: 12px;page-break-after:always;" width="550">
            <tr>
                <td>
                    <img style="height: 64px;width: 64px;margin-left: -20px;" class="w-20 h-20 ml-14 flex-nowrap"
                         src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTvg6oLc3ZWygJ9Vvoc2S7XAFBS1vcZGiYAdbJCGzex4E4STFKZ"
                         alt="">
                </td>
                <td style="font-size: 10px;color:#646464;">
                    <p align="center" class="flex-nowrap ml-20"><b>NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule
                            der
                            Wirtschaft</b> <br>
                        <b>Vorstand:</b>
                        <span class="text-gray-500"> Dipl.-Wirtsch.-Ing. (FH) Christoph Fülscher, Prof. Dr.
                            Stefan
                            Wiedmann
                        </span>
                        <br>
                        <b>Aufsichtsrat:</b>
                        <span class="text-gray-500"> Holger Micheel-Sprenger (Vorsitzender), Dr. Nico
                            Fickinger
                            (stellv. Vorsitzender)
                        </span>
                        <br>
                        <b>Bankverbindungen:</b>
                        <span class="text-gray-500"> Sparkasse Südholstein | IBAN DE27 2305 1030 0002
                            2509
                            75 | SWIFT/BIC NOLADE21SHO
                        </span>
                        <br>
                        <b>Neue Bankverbindung:</b>
                        <span class="text-gray-500"> Bank | IBAN DE73 2219 1405 0017 0281 51 |
                            SWIFT/BIC
                            GENODEF1PIN
                        </span>
                        <br>
                        <b>Sitz:</b>
                        <span class="text-gray-500"> Elmshorn, Amtsgericht Pinneberg, HRB 1682 EL | St.-Nr.:
                            DE277063065L
                        </span>
                    </p>
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td align="center">Seite 2 von 9</td>
            </tr>
        </table>
        <table>
            <tr>
                <td>1. Vertragsschluss</td>
            </tr>
            <tr>
                <td>1.1 Die/Der Studierende meldet sich mit Abschluss dieses Vertrags verbindlich für denStudiengang</td>
            </tr>
            <tr>
                <td>an der NORDAKADEMIE auf Grundlage der nachfolgenden Vertragsbedingungen und den folgenden Regelwerken</td>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>Verhaltenskodex</li>
                        <li>Prüfungsverfahrensordnung (in der zum Zeitpunkt des Studienbeginns <br>
                             gültigen Fassung)
                        </li>
                        <li>Prüfungsordnung des Studiengangs Betriebswirtschaftslehre</li>
                        <li>Verwaltungsbogen mit Datenschutzerklärung</li>
                        <li>Gebührenordnung</li>
                        <li>Einschreibordnung (in der zum Zeitpunkt des Studienbeginns gültigen <br>
                            Fassung); Es wird insbesondere auf die Regelung hinsichtlich der speziellen <br>
                            Formerfordernisse des § 14 Abs. 1 S. 2 Nr. 5 der Einschreibeordnung <br>
                            verwiesen,
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    die ebenfalls Vertragsbestandteil werden. Die Regelwerke sind dem Vertrag beigefügt. <br>
                    Änderungen dieser Ordnungen werden hochschulöffentlich bekannt gemacht und <br>
                    werden dadurch Bestandteil dieses Vertrages.
                </td>
            </tr>
            <tr>
                <td>1.2  Dieser Vertrag kommt erst zustande, wenn die/der Studierende diesen Vertrag <br>
                    persönlich unterzeichnet und der Hochschule bis zum 30.09.2022 im Original vorliegt. <br>
                    Solange der von der/dem Studierenden unterzeichnete Vertrag der Hochschule nicht <br>
                    zugegangen ist, ist der Studienplatz nicht wirksam angenommen.
                </td>
            </tr>
            <tr>
                <td>1.3 Die/Der Studierende übersendet der Hochschule unverzüglich den anliegenden <br>
                    Verwaltungsbogen zusammen mit einer beglaubigten Kopie der <br>
                    Hochschulzugangsberechtigung und dem Nachweis des Versichertenstatus bei einer <br>
                    Krankenversicherung. Zudem fügt die/der Studierende den Nachweis eines <br>
                    bestehenden Praktikumsvertrages mit dem kooperierenden Ausbildungsunternehmen <br>
                    bei.
                </td>
            </tr>
        </table>
        <table style="page-break-after: always;">
            <tr>
                <td>2. Verpflichtung der Hochschule</td>
            </tr>
            <tr>
                <td>
                    Nach Eingang des von dem Studierenden/der Studierenden unterzeichneten Vertrages nebst <br>
                    der unter Ziff. 1.3. beizubringenden zusätzlichen Unterlagen, verpflichtet sich die Hochschule <br>
                    durch die Vertragsunterzeichnung zur ordnungsgemäßen Ausbildung der/des Studierenden <br>
                    auf der Grundlage des Gesetzes über die Hochschulen und das Universitätsklinikum Schleswig- <br>
                    Holstein (Hochschulgesetz – HSG) in seiner jeweils gültigen Fassung sowie der jeweils gültigen <br>
                    Einschreib- und Prüfungsverfahrensordnung (vgl. oben Ziffer 1.1. des Studienvertrages) sowie <br>
                    der Prüfungsordnung des Studiengangs Betriebswirtschaftslehre. <br>
                </td>
            </tr>
            <tr>
                <td>
                    Darüber hinaus verpflichtet sich die Hochschule einen zwischen Hochschulausbildung und <br>
                    betrieblicher Praxis abgestimmten Studienverlauf in Koordination mit dem Ausbildungsbetrieb <br>
                    gemäß § 2 des zu Grunde liegenden Kooperationsvertrages zu gewährleisten.
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>Seite 3 von 9</td>
            </tr>
            <tr>
                <td> Der Studienort für die Präsenzveranstaltungen ist Elmshorn (Hauptsitz), Köllner Chaussee 11, <br>
                    25337 Elmshorn.
                </td>
            </tr>
        </table>
        <table style="page-break-after: always;">
            <tr>
                <td>3. Verpflichtung der Studierenden</td>
            </tr>
            <tr>
                <td>
                    3.1  Die/Der Studierende verpflichtet sich zu einem Verhalten innerhalb und außerhalb der <br>
                    Hochschule, das nicht gegen die im Verhaltenskodex (s. Ziffer 1.1.) aufgeführten <br>
                    Grundsätze verstößt. Das gilt auch für die betriebliche Praktikumszeit am <br>
                    Ausbildungsbetrieb: Die/Der Studierende hat die geltenden Ordnungen des <br>
                    Ausbildungsunternehmens zu beachten.
                </td>
            </tr>
            <tr>
                <td>
                    3.2  Die/Der Studierende verpflichtet sich zur Teilnahme am Studium gem. den <br>
                    Anforderungen dieser Vertragsbestimmungen, insbesondere den unter Ziffer 1.1. <br>
                    bezeichneten Regelwerken der Hochschule. Die Studierenden sind zur Einhaltung und <br>
                    Kenntnis der jeweils geltenden Einschreib- und Prüfungsverfahrensordnung (s. Ziffer <br>
                    1.1. des Studienvertrages) verpflichtet.
                </td>
            </tr>
            <tr>
                <td>
                    3.3  Die/Der Studierende erhält bei Studienbeginn eine hochschulinterne E-Mail-Adresse. <br>
                    Sie/Er ist verpflichtet, diese regelmäßig einzusehen. Ab Studienbeginn sendet die <br>
                    Hochschule alle offiziellen Mitteilungen an die hochschulinterne E-Mail-Adresse der <br>
                    Studierenden.
                </td>
            </tr>
            <tr>
                <td>
                    3.4  Staatsbürger von Nicht-EU und Nicht-EWR Staaten sind für die aufenthaltsrechtlichen <br>
                    Voraussetzungen ihres Aufenthalts in Deutschland selbst verantwortlich.
                </td>
            </tr>
            <tr>
                <td>
                    3.5  Die/Der Studierende erklärt, dass sie/er an einer anderen Hochschule in einem <br>
                    verwandten oder gleichartigen Studiengang bislang keine erforderliche Prüfung oder <br>
                    Leistungsnachweise endgültig nicht bestanden hat, und diesbezüglich keine <br>
                    Leistungsnachweise endgültig nicht bestanden hat, und diesbezüglich keine
                </td>
            </tr>

            <tr>
                <td>4. Gebühren</td>
            </tr>
            <tr>
                <td>
                    4.1  Der Ausbildungsbetrieb trägt und entrichtet die Studiengebühr, die von der Hochschule <br>
                    erhoben wird, in der jeweils aktuellen Höhe gem. der Gebührenordnung (vgl. Ziff. 1.1) <br>
                    und wie in § 4 des Kooperationsvertrages niedergelegt.
                </td>
            </tr>
            <tr>
                <td>
                    4.2 Die/Der Studierende verpflichtet sich für den Studienablauf wichtige Änderungen <br>
                    ihrer/seiner persönlichen Daten, wie des Namens, der Anschrift und der <br>
                    Telefonnummer unverzüglich der Hochschule mitzuteilen und nachzuweisen. In jedem <br>
                    Fall ist der Hochschule bei Studienbeginn eine gültige Meldeadresse in Deutschland <br>
                    mitzuteilen.
                </td>
            </tr>
            <tr>
                <td>5. Laufzeit des Studienvertrags</td>
            </tr>
            <tr>
                <td>
                    5.1 Der Studienvertrag wird für die Dauer der Regelstudienzeit von sieben Semestern <br>
                    abgeschlossen. Die Verpflichtung der Studierenden während der Vertragslaufzeit wird <br>
                    nicht dadurch berührt, dass diese das Studium nicht antreten oder zu einem späteren <br>
                    Zeitpunkt dem Studienbetrieb fernbleiben.
                </td>
            </tr>
            <tr>
                <td>
                    5.2  Es gelten die Regelungen zur Beurlaubung gem. § 16 der Einschreibordnung, es wird <br>
                    insbesondere auf das Erfordernis der schriftlichen Beantragung unter Angabe der hier <br>
                    aufgeführten wichtige Gründe gemäß § 16 Abs. 1, Nr. 1-3 hingewiesen.
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table style="page-break-after: always">
            <tr>
                <td>Seite 4 von 9</td>
            </tr>
            <tr>
                <td>
                    5.3  Ist die Regelstudienzeit gem. Ziff. 5.1 absolviert, haben Studierende Anspruch auf die <br>
                    Verlängerung dieses Vertrages, sofern der Antrag auf die Vertragsverlängerung vier <br>
                    Wochen vor Ablauf der Regelstudienzeit bei der Hochschule eingeht und die/der <br>
                    Studierende wichtige Gründe außerhalb des Studiums glaubhaft macht, die die <br>
                    Nichteinhaltung der Regelstudienzeit rechtfertigen. Der Anspruch muss schriftlich <br>
                    geltend gemacht und in einem dafür vorgesehenen Rückmeldebogen, der von der <br>
                    Hochschule auf Anfrage herausgegeben wird, begründet werden. Die/Der Studierende <br>
                    hat die Finanzierung des Studiums im Falle der Verlängerung des Studienvertrages <br>
                    über die Regelstudienzeit hinaus zu gewährleisten, sofern diese nicht durch den <br>
                    Betrieb sichergestellt bzw. im Praktikumsvertrag geregelt wird.
                </td>
            </tr>
            <tr>
                <td>
                    5.4  Besteht die/der Studierende eine Hochschulprüfung gemäß der (fachspezifischen) <br>
                    Prüfungsordnung nicht, die für den erfolgreichen Abschluss des Studiums erforderlich <br>
                    ist, so verlängert sich das Vertragsverhältnis auf ihren/seinen Antrag, welcher <br>
                    schriftlich und binnen einer Frist von 4 Wochen nach Bekanntgabe des <br>
                    Prüfungsergebnisses bei der Hochschule eingegangen sein muss, bis zu der nach <br>
                    Prüfungsordnung nächstmöglichen Wiederholungsprüfung.
                </td>
            </tr>
            <tr>
                <td>
                    5.5  Im Falle einer Betriebsaufgabe des Ausbildungsbetriebes, die den Fortgang der <br>
                    betrieblichen Praxisphase für die Studierende bzw. den Studierenden beendet, wird <br>
                    der/dem Studierenden eine angemessene Übergangszeit, jedoch nicht länger als sechs <br>
                    Wochen nach Beendigung, zur Ermöglichung der Fortsetzung des Studiums <br>
                    eingeräumt. Die/Der Studierende hat spätestens nach der Übergangszeit einen neuen <br>
                    Praktikumsvertrag mit einem Kooperationsbetrieb der Hochschule nachzuweisen, der <br>
                    die praktische Ausbildung fortsetzt. Die Hochschule unterstützt den Studierenden bei <br>
                    der Suche eines geeigneten und in Kooperation mit der Hochschule stehenden <br>
                    Ausbildungsbetriebes, der die Ausbildung fortsetzt.
                </td>
            </tr>
            <tr>
                <td>6. Vorzeitige Beendigung des Studienvertrags</td>
            </tr>
            <tr>
                <td>
                    6.1  Dieser Studienvertrag wird vorbehaltlich der nachstehenden Bedingungen für die <br>
                    gesamte Studienzeit bis zur Beendigung des Studiums geschlossen. Dieser Vertrag <br>
                    kann von jedem Vertragspartner unter Einhaltung einer Kündigungsfrist von vier <br>
                    Wochen vor Ende eines jeden Semesters zum Semesterende ordentlich gekündigt <br>
                    werden.
                </td>
            </tr>
            <tr>
                <td>
                    6.2  Die Hochschule kann nach Beginn des Studiums den Studienvertrag bei Vorliegen eines <br>
                    wichtigen Grundes mit sofortiger Wirkung kündigen. Ein wichtiger Grund liegt <br>
                    insbesondere dann vor, wenn die/der Studierende durch ihr/sein persönliches <br>
                    Verhalten Anlass für eine solche Kündigung gibt. Insbesondere wenn die/der <br>
                    Studierende gegen die im Merkblatt „Verhaltenskondex“ (vgl. Ziff. 1.1.) aufgeführten <br>
                    Grundsätze verstößt. Ein wichtiger Grund liegt ferner bei groben Verstößen gegen die <br>
                    Vertragspflichten vor und wenn ein wie unter Ziffer 1.3 definierter Vertrag mit einem <br>
                    Unternehmen nicht mehr vorliegt bzw. gekündigt wurde oder die/der Studierende nach <br>
                    Betriebsaufgabe des Ausbildungsbetriebes der Hochschule nicht innerhalb der gemäß <br>
                    Ziff. 5.5 genannten Übergangszeit einen neuen Praktikumsvertrag nachweist.
                </td>
            </tr>
            <tr>
                <td>
                    6.3  Die Hochschule hat das Recht, den Studiengang vor Beginn des Semesters abzusagen, <br>
                    wenn die Durchführung wirtschaftlich nicht vertretbar ist, insbesondere, wenn die <br>
                    durch die Hochschule zu bestimmende Mindestteilnehmerzahl für den Studiengang <br>
                    nicht erreicht wird oder wenn andere wichtige Gründe vorliegen, insbesondere auf <br>
                    Grund gesetzlich angeordneter Maßnahmen, die von der Hochschule nicht zu vertreten <br>
                    sind.
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table style="page-break-after: always;">
            <tr>
                <td>Seite 5 von 9</td>
            </tr>
            <tr>
                <td>
                    Die Absage muss spätestens 6 Wochen vor Beginn des Studiengangs den Studierenden <br>
                    bekanntgegeben werden. Innerhalb dieser Frist erwachsen der/dem Studierenden <br>
                    keinerlei Schadens- bzw. sonstige Ersatzansprüche.
                </td>
            </tr>
            <tr>
                <td>
                    6.4  Ein Wechsel innerhalb der Dozentenschaft berechtigt den Studierenden nicht zum <br>
                    Rücktritt vom Studienvertrag.
                </td>
            </tr>
            <tr>
                <td>6.5  Das Recht zur außerordentlichen Kündigung bleibt unberührt.</td>
            </tr>
            <tr>
                <td>6.6.  Die Kündigung bedarf der Schriftform.</td>
            </tr>
            <tr>
                <td>
                    6.7.  Stellt die Hochschule vor dem vereinbarten Vertragsende den endgültigen Verlust des <br>
                    Prüfungsanspruchs fest, so endet das Vertragsverhältnis mit der bestands- bzw. <br>
                    rechtskräftigen Feststellung des endgültigen Verlusts des Prüfungsanspruchs im Sinne <br>
                    des § 42 Absatz 2 Nr. 3 HSG, spätestens aber mit dem vorgesehenen Ende des <br>
                    Vertragsverhältnisses. Unabhängig davon besteht die Kündigungsmöglichkeit nach <br>
                    Ziffer 6.2.
                </td>
            </tr>

            <tr>
                <td>7. Urheber- und Nutzungsrechte</td>
            </tr>
            <tr>
                <td>
                    Alle Rechte an den Werkstücken und Arbeiten der Studierenden, die während der bzw. für die <br>
                    Lehrveranstaltungen erstellt werden, bleiben bei den Studierenden (z. B. zur Veröffentlichung <br>
                    auf der Hochschul-Homepage). <br>
                </td>
            </tr>
            <tr>
                <td>
                    Das Urheberrecht an Studienheften, Skripten oder sonstigen Lernmitteln, die während des <br>
                    Studiums zur Verfügung gestellt werden, gebührt allein der Hochschule bzw. der/dem <br>
                    jeweiligen Autor/in oder Hersteller/in. Den Studierenden ist nicht gestattet, die Studienhefte, <br>
                    Skripte oder sonstige Lernmittel/Inhalte ohne schriftliche Zustimmung der Hochschule bzw. <br>
                    der/des Autors/Autorin oder der/des Herstellers/Herstellerin ganz oder teilweise zu <br>
                    reproduzieren, in Daten verarbeitende Medien aufzunehmen, in irgendeiner Form zu <br>
                    verbreiten und/oder Dritten zugänglich zu machen. Darüber hinaus dürfen keine Aufnahmen <br>
                    und/oder Mitschnitte im Kontext der Lehrveranstaltungen erstellt werden. Das Kopieren von <br>
                    zur Verfügung gestellter Software ist ohne vorherige Erlaubnis untersagt.
                </td>
            </tr>

            <tr>
                <td>8. Ausgabe von Prüfungszeugnissen</td>
            </tr>
            <tr>
                <td>
                    Die Ausgabe von Prüfungszeugnissen setzt voraus, dass die/der Studierende die von der <br>
                    Hochschule ggf. entliehenen Gegenstände zurückgegeben hat.
                </td>
            </tr>

            <tr>
                <td>9. Haftung</td>
            </tr>
            <tr>
                <td>
                    Die Hochschule übernimmt keine Haftung für einen mit dem Studium beabsichtigten Erfolg <br>
                    und/ oder eine beabsichtigte Zulassung zu Prüfungen und/oder das Bestehen solcher <br>
                    Prüfungen. Die Haftung der Hochschule, gleich aus welchem Rechtsgrund, die im <br>
                    Zusammenhang mit der Benutzung der Räumlichkeiten und den An- und Abfahrten zum oder <br>
                    vom Gelände der Hochschule stehen, beschränkt sich auf Vorsatz und grobe Fahrlässigkeit. <br>
                    Ausnahme sind Unfälle auf dem Gelände der Hochschule, gegen die die Studierenden <br>
                    versichert sind.
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table style="page-break-after: always;">
            <tr>
                <td>Seite 6 von 9</td>
            </tr>
            <tr>
                <td>
                    Die Hochschule haftet unbeschadet vorstehender Regelungen und der nachfolgenden <br>
                    Haftungsbeschränkungen uneingeschränkt für Schäden an Leben, Körper und Gesundheit, die <br>
                    auf einer fahrlässigen oder vorsätzlichen Pflichtverletzung ihrer gesetzlichen Vertreter oder <br>
                    Erfüllungsgehilfen beruhen sowie für alle Schäden, die auf vorsätzlichen oder grob <br>
                    fahrlässigen Vertragsverletzungen sowie Arglist ihrer gesetzlichen Vertreter oder ihrer <br>
                    Erfüllungsgehilfen beruhen.
                </td>
            </tr>
            <tr>
                <td>
                    Die Hochschule haftet bei leichter Fahrlässigkeit im Hinblick auf Sach- und Vermögenschäden <br>
                    nicht, außer wenn sie eine wesentliche Vertragspflicht, deren Erfüllung die ordnungsgemäße <br>
                    Durchführung des Vertrages überhaupt erst ermöglicht, deren Verletzung die Erreichung des <br>
                    Zwecks des Vertrages gefährdet und auf deren Einhaltung der Studierende regelmäßig <br>
                    vertraut (im Folgenden „Kardinalpflicht“). Die Haftung wegen einer solchen Kardinalpflicht ist <br>
                    ihrerseits auf den vertragstypischen, vorhersehbaren Schaden beschränkt. Dies gilt auch für <br>
                    entgangenen Gewinn und ausgebliebene Einsparungen. Bei einfachen fahrlässigen <br>
                    Verletzungen nicht vertragswesentlicher Nebenpflichten haftet die Hochschule im Übrigen <br>
                    nicht. Die genannten Haftungsbeschränkungen gelten auch, soweit die Haftung für die <br>
                    gesetzlichen Vertreter, leitenden Angestellten und sonstigen Erfüllungsgehilfen der <br>
                    Hochschule betroffen ist.
                </td>
            </tr>
            <tr>
                <td>10. Datenschutz</td>
            </tr>
            <tr>
                <td>
                    Die/Der Studierende ermächtigt die Hochschule, die im Zusammenhang mit dem <br>
                    Vertragsverhältnis und dem Studium erhaltenen Daten über die Studierende bzw. den <br>
                    Studierenden im Rahmen der Datenschutzgesetze zu verarbeiten und zu speichern. Die <br>
                    Nutzung, Speicherung und Weitergabe personenbezogener Daten erfolgt nach Maßgabe der <br>
                    geltenden datenschutzrechtlichen Bestimmungen, insbesondere denen der <br>
                    Datenschutzgrundverordnung. Sämtliche personenbezogene Daten werden vertraulich <br>
                    behandelt und nur insoweit an Dritte weitergegeben, wie dies gesetzlich angeordnet oder zur <br>
                    Wahrung der berechtigten Interessen der Hochschule erforderlich ist. In diesem <br>
                    Zusammenhang wird auf die Datenschutzerklärung der Hochschule verwiesen (siehe <br>
                    Verwaltungsbogen mit Datenschutzerklärung).
                </td>
            </tr>

            <tr>
                <td>11. Organisatorische Änderungen</td>
            </tr>
            <tr>
                <td>
                    Die Hochschule behält sich vor, Änderungen im Studienablauf vorzunehmen, sofern die <br>
                    Studienziele hierdurch nicht beeinträchtigt werden und die Änderungen im Einklang mit der <br>
                    geltenden Prüfungsordnung stehen und die Studieninhalte nicht wesentlich verändert werden. <br>
                    Als Änderungen im Studienablauf gelten insbesondere der Beginn der Semester oder die <br>
                    Länge der Vorlesungszeiten. <br>
                </td>
            </tr>

            <tr>
                <td>12. Online-Streitbeilegung</td>
            </tr>
            <tr>
                <td>
                    Die Europäische Kommission stellt unter http://ec.europa.eu/consumers/odr/ eine Plattform <br>
                    zur außergerichtlichen Online-Streitbeilegung (sog. OS-Plattform) bereit. Die Hochschule <br>
                    weist darauf hin, dass an einem Streitbeilegungsverfahren vor einer <br>
                    Verbraucherstreitschlichtungs- stelle nicht teilgenommen wird.
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table style="page-break-after: always;">
            <tr>
                <td>Seite 7 von 9</td>
            </tr>
            <tr>
                <td>
                    13.1  Erfüllungsort für die beiderseitigen Leistungen ist der Sitz der NORDAKADEMIE. Es <br>
                    findet deutsches Recht Anwendung. Der Gerichtsstand ist Elmshorn.
                </td>
            </tr>
            <tr>
                <td>
                    13.2  Sollten einzelne Bestimmungen des Vertrages unwirksam sein oder werden, so wird die <br>
                    Wirksamkeit der übrigen Bestimmungen hiervon nicht berührt. Die unwirksame <br>
                    Regelung ist durch eine wirksame und wirtschaftlich angemessene Bestimmung, die <br>
                    dem Gewollten der Parteien am nächsten kommt, zu ersetzen.
                </td>
            </tr>
            <tr>
                <td>
                    13.3  Mündliche Nebenabreden wurden nicht getroffen. Änderungen und Ergänzungen dieses <br>
                    Studienvertrages bedürfen zu ihrer Wirksamkeit der Schriftform. Dies gilt auch für die <br>
                    Aufhebung des Schriftformerfordernisses.
                </td>
            </tr>

            <tr>
                <td>
                    Elmshorn, ___________________________
                </td>
                <td>
                    _____________________________________
                    (Ort, Datum)
                </td>
            </tr>
            <tr>
                <td>
                    _____________________________________
                    Für die Hochschule (Stempel, Unterschrift)
                </td>
                <td>
                    _____________________________________
                    Studierende/r (Unterschrift)
                </td>
            </tr>
            <tr>
                Der Vertrag ist in zwei gleichlautenden Ausfertigungen ausgestellt und von den Vertrags- <br>
                schließenden eigenhändig unterschrieben.
            </tr>

            <tr>
                <td>Anlagen</td>
            </tr>
            <tr>
                <td>Widerrufsbelehrung            mit              Muster-Widerrufsformular,           Prüfungsordnung <br>
                    Betriebswirtschaftslehre,    Merkblatt:     Verhaltenskodex,      Verwaltungsbogen     mit <br>
                    Datenschutzerklärung,   Prüfungsverfahrensordnung,  Einschreibordnung,  Gebührenordnung
                </td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table style="page-break-after: always;">
            <tr>
                <td>Seite 8 von 9 <br>
                    Widerrufsbelehrung
                </td>
            </tr>
            <tr>
                <td>Widerrufsrecht</td>
            </tr>
            <tr>
                <td>
                    Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu <br>
                    widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses. <br>
                    Um Ihr Widerrufsrecht auszuüben, müssen Sie uns unter der Anschrift:
                </td>
            </tr>
            <tr>
                <td>
                    NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft <br>
                    Köllner Chaussee 11 <br>
                    25337 Elmshorn
                </td>
            </tr>

            <tr>
                <td>
                    Telefon: +49 (0)4121 4090-0 <br>
                    Fax: +49 (0)4121 4090-40 <br>
                    E-Mail: info@nordakademie.de
                </td>
            </tr>
            <tr>
                <td>
                    mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief, Telefax oder E <br>
                    Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie können dafür das <br>
                    beigefügte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist. Zur <br>
                    Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung über die Ausübung des <br>
                    Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
                </td>
            </tr>
            <tr>
                <td>Widerrufsfolgen</td>
            </tr>
            <tr>
                <td>
                    Wenn Sie diesen Vertrag widerrufen, werden wir Ihnen den Zahlungsbetrag, den wir von Ihnen <br>
                    erhalten haben, unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag <br>
                    zurückzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrages bei uns <br>
                    eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei <br>
                    der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde etwas Anderes <br>
                    vereinbart. Für diese Rückzahlung werden keine Entgelte berechnet. Haben Sie während der <br>
                    Widerrufsfrist auf Ihren Wunsch unsere Dienstleistungen in Anspruch genommen, so sind wir <br>
                    Anteil der bis zu diesem Zeitpunkt, zu dem Sie uns von der Ausübung des Widerrufsrechts <br>
                    hinsichtlich dieses Vertrages unterrichten, bereits erbrachten Dienstleistungen im Vergleich <br>
                    zum Gesamtumfang der im Vertrag vorgesehenen Dienstleistungen entspricht.
                </td>
            </tr>
            <tr>
                <td>Besondere Hinweise</td>
            </tr>
            <tr>
                <td>
                    Ihr Widerrufsrecht erlischt vorzeitig, wenn der Vertrag von beiden Seiten auf Ihren <br>
                    ausdrücklichen Wunsch vollständig erfüllt ist, bevor Sie Ihr Widerrufsrecht ausgeübt haben.
                </td>
            </tr>
            <tr>
                <td>Ende der Widerrufsbelehrung</td>
            </tr>
        </table>

        <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
            <tr>
                <td align="right">
                    <img style="display:block;height:32px;margin-right: 52px;"
                        src="{{ asset('images/logo.png') }}"
                        alt="logo">
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>Seite 9 von 9</td>
            </tr>
            <tr>
                <td>Muster-Widerrufsformular</td>
            </tr>
            <tr>
                <td>An die</td>
            </tr>
            <tr>
                <td>
                    NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft <br>
                    Köllner Chaussee 11 <br>
                    25337 Elmshorn
                </td>
            </tr>
            <tr>
                <td>
                    Telefon: +49 (0)4121 4090-0 <br>
                    Fax: +49 (0)4121 4090-40 <br>
                    E-Mail: info@nordakademie.de
                </td>
            </tr>
            <tr>
                <td>
                    Hiermit widerrufe(n) ich / wir (*) den von mir / uns (*) abgeschlossenen Vertrag über den <br>
                    Kauf der folgenden Waren (*) / die Erbringung der folgenden Dienstleistung (*): <br>
                    _________________________________________________________________________
                </td>
            </tr>
            <tr>
                <td>
                    Bestellt am (*) / erhalten am (*): <br>
                    _________________________________________________________________________
                </td>
            </tr>
            <tr>
                <td>
                    Vorname / Name des / der Verbraucher(s): <br>
                    _________________________________________________________________________
                </td>
            </tr>
            <tr>
                <td>
                    Anschrift des / der Verbraucher(s): <br>
                    _________________________________________________________________________
                </td>
            </tr>

            <tr>
                <td>
                    ________________________________
                    Unterschrift des / der Verbraucher(s) <br>
                    (nur bei Mitteilung auf Papier)
                </td>
                <td>
                    ________________________________
                    Datum
                </td>
            </tr>
            <tr>
                <td> (*) Unzutreffendes bitte streichen</td>
            </tr>
        </table>
@endsection
