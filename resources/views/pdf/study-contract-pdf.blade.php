@extends('laravel-finer::pdf.layout')

@section('content')
@php
Carbon\Carbon::setlocale($user->locale);
@endphp
<style>
    @page{
        padding: 0;
        margin: 0;
        page-break-after: always
    }
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    h1,h2,h3,h4,h5,h6{
        font-weight: bold;
    }
    body{
        font-family: 'Interstate', sans-serif;
        line-height: 1;
    }
    @font-face {
        font-display: swap;
        font-family: 'Interstate';
        font-style: normal;
        font-weight: 400;
        src: url({{ asset("public/fonts/Interstate-Black.woff")}});

    }
    .main-title{
        font-size: 20px;
        margin-bottom:10px;
        color: #003a79;
        font-weight: 600;
        line-height: 32px;

    }
    @media print {
        .new-page {
            page-break-before: always;
        }
    }
</style>
<table width="600" align="center" style="padding:20px;font-size:16px;font-family:Interstate;" cellspacing="0" cellpadding="0" border="0" >
    <tbody>
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding-bottom:100px;">
                                <img style="display:block;height:32px;margin-right: 52px;" src="{{ asset('images/logo.png') }}" alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" width="100%">
                                <h2 style="color: black;font-size: 22px;line-height:32px;text-align:center;">Studienvertrag für Studierende der NORDAKADEMIE
                                    <br>
                                    Duales Studium - Bachelor of Science
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:40px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="33.33%" align="center">
                                                <span>Studienjahr</span>
                                                <span>{{ $desiredBeginning->format('Y') }}</span>
                                            </td>
                                            <td width="33.33%" align="center">
                                                <span>Beginn:</span>
                                                <span>{{ "[1. Oktober ".$desiredBeginning->format('Y')."]" }}</span>
                                            </td>
                                            <td width="33.33%" align="center">
                                                <span>Ende:</span>
                                                <span>year of desired beginning</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="left" style="padding:16px 65px;">
                                                <span>Zwischen</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <p> der NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft</p>
                                <p>Köllner Chaussee 11</p>
                                <p>25337 Elmshorn</p>
                                <p>
                                    <span style="display: inline-block;vertical-align:middle;">
                                        Telefon:
                                    </span>  <a href="tel:+49412140900" style="display:inline-block;vertical-align:middle;text-decoration:none;color:inherit">+49 (0)4121 4090-0</a>
                                </p>
                                <p>
                                    Fax: +49 (0)4121 4090-40
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px;">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td style="padding-bottom:8px;">
                                            nachfolgend - Hochschule -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:8px;">
                                            und
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:10px;" valign="top" height="300px">
                                            <p>
                                                {{ $user->fullName }}
                                            </p>
                                            <p>
                                                {{ $street_no }}
                                            </p>
                                            <p>
                                                {{ $zip.' '. $city }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:50px;">
                                            nachfolgend - Studierende/r -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>über die Einschreibung zum 1. Oktober {{ $desiredBeginning->format('Y') }} an der NORDAKADEMIE im Studiengang {{ $course }}.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:80px">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="10%" align="left">
                                                <img style="height: 64px;width: 64px;"
                                                src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTvg6oLc3ZWygJ9Vvoc2S7XAFBS1vcZGiYAdbJCGzex4E4STFKZ"
                                                alt="">
                                            </td>
                                            <td width="90%" style="font-size: 10px;color:#646464;text-align:center" align="left">

                                                <b>
                                                    NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule
                                                    der
                                                    Wirtschaft
                                                </b>
                                                <p>
                                                    <br>
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
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        {{-- second page starts here  --}}
        <tr>
            <td style="padding-bottom:40px;">
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:80px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="center">Seite 2 von 9</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="main-title">1. Vertragsschluss</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                1.1
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    1.1 Die/Der Studierende meldet sich mit Abschluss dieses Vertrags verbindlich für denStudiengang
                                                </p>
                                                <p style="margin-bottom: 10px;">
                                                    an der NORDAKADEMIE auf Grundlage der nachfolgenden Vertragsbedingungen und den folgenden Regelwerken
                                                </p>
                                                <p >
                                                    <ul style="list-style: bullet;margin-left:60px;">
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
                                                </p>
                                                <p style="margin-top: 30px;">
                                                    die ebenfalls Vertragsbestandteil werden. Die Regelwerke sind dem Vertrag beigefügt. <br>
                                                    Änderungen dieser Ordnungen werden hochschulöffentlich bekannt gemacht und <br>
                                                    werden dadurch Bestandteil dieses Vertrages.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                1.2
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Dieser Vertrag kommt erst zustande, wenn die/der Studierende diesen Vertrag
                                                    persönlich unterzeichnet und der Hochschule bis zum 30.09.2022 im Original vorliegt.
                                                    Solange der von der/dem Studierenden unterzeichnete Vertrag der Hochschule nicht
                                                    zugegangen ist, ist der Studienplatz nicht wirksam angenommen.
                                                </p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                1.3
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende übersendet der Hochschule unverzüglich den anliegenden
                                                    Verwaltungsbogen zusammen mit einer beglaubigten Kopie der
                                                    Hochschulzugangsberechtigung und dem Nachweis des Versichertenstatus bei einer
                                                    Krankenversicherung. Zudem fügt die/der Studierende den Nachweis eines
                                                    bestehenden Praktikumsvertrages mit dem kooperierenden Ausbildungsunternehmen
                                                    bei.
                                                </p>

                                            </td>
                                        </tr>
                                        <tr>

                                            <td colspan="2">
                                                <h4 class="main-title">2. Verpflichtung der Hochschule</h4>
                                                <p style="margin-bottom:16px;">
                                                    Nach Eingang des von dem Studierenden/der Studierenden unterzeichneten Vertrages nebst
                                                    der unter Ziff. 1.3. beizubringenden zusätzlichen Unterlagen, verpflichtet sich die Hochschule
                                                    durch die Vertragsunterzeichnung zur ordnungsgemäßen Ausbildung der/des Studierenden
                                                    auf der Grundlage des Gesetzes über die Hochschulen und das Universitätsklinikum SchleswigHolstein (Hochschulgesetz – HSG) in seiner jeweils gültigen Fassung sowie der jeweils gültigen
                                                    Einschreib- und Prüfungsverfahrensordnung (vgl. oben Ziffer 1.1. des
                                                </p>
                                                <p>
                                                    Darüber hinaus verpflichtet sich die Hochschule einen zwischen Hochschulausbildung und
                                                    betrieblicher Praxis abgestimmten Studienverlauf in Koordination mit dem Ausbildungsbetrieb
                                                    gemäß § 2 des zu Grunde liegenden Kooperationsvertrages zu gewährleisten.
                                                </p>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>

        {{-- second page ends here  --}}

        {{-- third page starts here  --}}
        <tr>
            <td style="padding-bottom:40px;">
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="center">Seite 3 von 9</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:10px 0;">
                                                Der Studienort für die Präsenzveranstaltungen ist Elmshorn (Hauptsitz), Köllner Chaussee 11, 25337 Elmshorn.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="main-title">
                                                    3. Verpflichtung der Studierenden
                                                </h3>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                3.1
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende verpflichtet sich zu einem Verhalten innerhalb und außerhalb der Hochschule, das nicht gegen die im Verhaltenskodex (s. Ziffer 1.1.) aufgeführten Grundsätze verstößt. Das gilt auch für die betriebliche Praktikumszeit am Ausbildungsbetrieb: Die/Der Studierende hat die geltenden Ordnungen des Ausbildungsunternehmens zu beachten.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                3.2
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende verpflichtet sich zur Teilnahme am Studium gem. den
                                                    Anforderungen dieser Vertragsbestimmungen, insbesondere den unter Ziffer 1.1.
                                                    bezeichneten Regelwerken der Hochschule. Die Studierenden sind zur Einhaltung und
                                                    Kenntnis der jeweils geltenden Einschreib- und Prüfungsverfahrensordnung (s. Ziffer
                                                    1.1. des Studienvertrages) verpflichtet.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                3.3
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende erhält bei Studienbeginn eine hochschulinterne E-Mail-Adresse. Sie/Er ist verpflichtet, diese regelmäßig einzusehen. Ab Studienbeginn sendet die Hochschule alle offiziellen Mitteilungen an die hochschulinterne E-Mail-Adresse der Studierenden.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                3.4
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Staatsbürger von Nicht-EU und Nicht-EWR Staaten sind für die aufenthaltsrechtlichen Voraussetzungen ihres Aufenthalts in Deutschland selbst verantwortlich.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                3.5
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende erklärt, dass sie/er an einer anderen Hochschule in einem
                                                    verwandten oder gleichartigen Studiengang bislang keine erforderliche Prüfung oder Leistungsnachweise endgültig nicht bestanden hat, und diesbezüglich keine Widerspruchs- oder Gerichtsverfahren anhängig sind.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">
                                                    4.Gebühren
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                4.1
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Der Ausbildungsbetrieb trägt und entrichtet die Studiengebühr, die von der Hochschule
                                                    erhoben wird, in der jeweils aktuellen Höhe gem. der Gebührenordnung (vgl. Ziff. 1.1)
                                                    und wie in § 4 des Kooperationsvertrages niedergelegt.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                4.2
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende verpflichtet sich für den Studienablauf wichtige Änderungen
                                                    ihrer/seiner persönlichen Daten, wie des Namens, der Anschrift und der Telefonnummer unverzüglich der Hochschule mitzuteilen und nachzuweisen. In jedem Fall ist der Hochschule bei Studienbeginn eine gültige Meldeadresse in Deutschland mitzuteilen.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">
                                                    5. Laufzeit des Studienvertrags
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                5.1
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Der Studienvertrag wird für die Dauer der Regelstudienzeit von sieben Semestern
                                                    abgeschlossen. Die Verpflichtung der Studierenden während der Vertragslaufzeit wird nicht dadurch berührt, dass diese das Studium nicht antreten oder zu einem späteren
                                                    Zeitpunkt dem Studienbetrieb fernbleiben.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                5.2
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Es gelten die Regelungen zur Beurlaubung gem. § 16 der Einschreibordnung, es wird
                                                    insbesondere auf das Erfordernis der schriftlichen Beantragung unter Angabe der hier
                                                    aufgeführten wichtige Gründe gemäß § 16 Abs. 1, Nr. 1-3 hingewiesen.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>
        {{-- third page ends here  --}}

        {{-- fourth page starts here  --}}
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="center" style="padding-bottom: 6px;">Seite 4 von 9</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                5.3
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Ist die Regelstudienzeit gem. Ziff. 5.1 absolviert, haben Studierende Anspruch auf die
                                                    Verlängerung dieses Vertrages, sofern der Antrag auf die Vertragsverlängerung vier
                                                    Wochen vor Ablauf der Regelstudienzeit bei der Hochschule eingeht und die/der
                                                    Studierende wichtige Gründe außerhalb des Studiums glaubhaft macht, die die
                                                    Nichteinhaltung der Regelstudienzeit rechtfertigen. Der Anspruch muss schriftlich
                                                    geltend gemacht und in einem dafür vorgesehenen Rückmeldebogen, der von der
                                                    Hochschule auf Anfrage herausgegeben wird, begründet werden. Die/Der Studierende
                                                    hat die Finanzierung des Studiums im Falle der Verlängerung des Studienvertrages
                                                    über die Regelstudienzeit hinaus zu gewährleisten, sofern diese nicht durch den
                                                    Betrieb sichergestellt bzw. im Praktikumsvertrag geregelt wird.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                5.4
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Besteht die/der Studierende eine Hochschulprüfung gemäß der (fachspezifischen)
                                                    Prüfungsordnung nicht, die für den erfolgreichen Abschluss des Studiums erforderlich
                                                    ist, so verlängert sich das Vertragsverhältnis auf ihren/seinen Antrag, welcher
                                                    schriftlich und binnen einer Frist von 4 Wochen nach Bekanntgabe des
                                                    Prüfungsergebnisses bei der Hochschule eingegangen sein muss, bis zu der nach
                                                    Prüfungsordnung nächstmöglichen Wiederholungsprüfung.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                5.5
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 6px;">
                                                    Im Falle einer Betriebsaufgabe des Ausbildungsbetriebes, die den Fortgang der
                                                    betrieblichen Praxisphase für die Studierende bzw. den Studierenden beendet, wird
                                                    der/dem Studierenden eine angemessene Übergangszeit, jedoch nicht länger als sechs
                                                    Wochen nach Beendigung, zur Ermöglichung der Fortsetzung des Studiums
                                                    eingeräumt. Die/Der Studierende hat spätestens nach der Übergangszeit einen neuen
                                                    Praktikumsvertrag mit einem Kooperationsbetrieb der Hochschule nachzuweisen, der
                                                    die praktische Ausbildung fortsetzt. Die Hochschule unterstützt den Studierenden bei
                                                    der Suche eines geeigneten und in Kooperation mit der Hochschule stehenden
                                                    Ausbildungsbetriebes, der die Ausbildung fortsetzt.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">6. Vorzeitige Beendigung des Studienvertrags</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.1
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Dieser Studienvertrag wird vorbehaltlich der nachstehenden Bedingungen für die
                                                    gesamte Studienzeit bis zur Beendigung des Studiums geschlossen. Dieser Vertrag
                                                    kann von jedem Vertragspartner unter Einhaltung einer Kündigungsfrist von vier
                                                    Wochen vor Ende eines jeden Semesters zum Semesterende ordentlich gekündigt
                                                    werden.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.2
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule kann nach Beginn des Studiums den Studienvertrag bei Vorliegen eines
                                                    wichtigen Grundes mit sofortiger Wirkung kündigen. Ein wichtiger Grund liegt
                                                    insbesondere dann vor, wenn die/der Studierende durch ihr/sein persönliches
                                                    Verhalten Anlass für eine solche Kündigung gibt. Insbesondere wenn die/der
                                                    Studierende gegen die im Merkblatt „Verhaltenskondex“ (vgl. Ziff. 1.1.) aufgeführten
                                                    Grundsätze verstößt. Ein wichtiger Grund liegt ferner bei groben Verstößen gegen die
                                                    Vertragspflichten vor und wenn ein wie unter Ziffer 1.3 definierter Vertrag mit einem
                                                    Unternehmen nicht mehr vorliegt bzw. gekündigt wurde oder die/der Studierende nach
                                                    Betriebsaufgabe des Ausbildungsbetriebes der Hochschule nicht innerhalb der gemäß
                                                    Ziff. 5.5 genannten Übergangszeit einen neuen Praktikumsvertrag nachweist.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.3
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule hat das Recht, den Studiengang vor Beginn des Semesters abzusagen,
                                                    wenn die Durchführung wirtschaftlich nicht vertretbar ist, insbesondere, wenn die
                                                    durch die Hochschule zu bestimmende Mindestteilnehmerzahl für den Studiengang
                                                    nicht erreicht wird oder wenn andere wichtige Gründe vorliegen, insbesondere auf
                                                    Grund gesetzlich angeordneter Maßnahmen, die von der Hochschule nicht zu vertreten
                                                    sind.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>
        {{-- fourth page ends here  --}}

        {{-- fifth page starts here  --}}
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="center" style="padding-bottom: 6px;">Seite 5 von 9</td>
                                        </tr>
                                        <tr>
                                            <td  width="5%" align="left" valign="top"></td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Die Absage muss spätestens 6 Wochen vor Beginn des Studiengangs den Studierenden
                                                    bekanntgegeben werden. Innerhalb dieser Frist erwachsen der/dem Studierenden
                                                    keinerlei Schadens- bzw. sonstige Ersatzansprüche.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.4
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Ein Wechsel innerhalb der Dozentenschaft berechtigt den Studierenden nicht zum
                                                    Rücktritt vom Studienvertrag.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.5
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Das Recht zur außerordentlichen Kündigung bleibt unberührt.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.6
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 6px;">
                                                    Die Kündigung bedarf der Schriftform.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="5%" align="left" valign="top">
                                                6.7
                                            </td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 6px;">
                                                    Stellt die Hochschule vor dem vereinbarten Vertragsende den endgültigen Verlust des
                                                    Prüfungsanspruchs fest, so endet das Vertragsverhältnis mit der bestands- bzw.
                                                    rechtskräftigen Feststellung des endgültigen Verlusts des Prüfungsanspruchs im Sinne
                                                    des § 42 Absatz 2 Nr. 3 HSG, spätestens aber mit dem vorgesehenen Ende des
                                                    Vertragsverhältnisses. Unabhängig davon besteht die Kündigungsmöglichkeit nach
                                                    Ziffer 6.2.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">7. Urheber- und Nutzungsrechte</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Alle Rechte an den Werkstücken und Arbeiten der Studierenden, die während der bzw. für die
                                                    Lehrveranstaltungen erstellt werden, bleiben bei den Studierenden (z. B. zur Veröffentlichung
                                                    auf der Hochschul-Homepage).
                                                </p>
                                                <p style="margin-bottom: 10px;">
                                                    Das Urheberrecht an Studienheften, Skripten oder sonstigen Lernmitteln, die während des
                                                    Studiums zur Verfügung gestellt werden, gebührt allein der Hochschule bzw. der/dem
                                                    jeweiligen Autor/in oder Hersteller/in. Den Studierenden ist nicht gestattet, die Studienhefte,
                                                    Skripte oder sonstige Lernmittel/Inhalte ohne schriftliche Zustimmung der Hochschule bzw.
                                                    der/des Autors/Autorin oder der/des Herstellers/Herstellerin ganz oder teilweise zu
                                                    reproduzieren, in Daten verarbeitende Medien aufzunehmen, in irgendeiner Form zu
                                                    verbreiten und/oder Dritten zugänglich zu machen. Darüber hinaus dürfen keine Aufnahmen
                                                    und/oder Mitschnitte im Kontext der Lehrveranstaltungen erstellt werden. Das Kopieren von
                                                    zur Verfügung gestellter Software ist ohne vorherige Erlaubnis untersagt.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">8. Ausgabe von Prüfungszeugnissen</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Ausgabe von Prüfungszeugnissen setzt voraus, dass die/der Studierende die von der Hochschule ggf. entliehenen Gegenstände zurückgegeben hat.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">9. Haftung</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule übernimmt keine Haftung für einen mit dem Studium beabsichtigten Erfolg
                                                    und/ oder eine beabsichtigte Zulassung zu Prüfungen und/oder das Bestehen solcher
                                                    Prüfungen. Die Haftung der Hochschule, gleich aus welchem Rechtsgrund, die im
                                                    Zusammenhang mit der Benutzung der Räumlichkeiten und den An- und Abfahrten zum oder
                                                    vom Gelände der Hochschule stehen, beschränkt sich auf Vorsatz und grobe Fahrlässigkeit.
                                                    Ausnahme sind Unfälle auf dem Gelände der Hochschule, gegen die die Studierenden
                                                    versichert sind.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        {{-- fifth page starts here  --}}

        {{-- sixth page starts here  --}}
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="center" style="padding-bottom: 6px;">Seite 6 von 9</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>

                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule haftet unbeschadet vorstehender Regelungen und der nachfolgenden
                                                    Haftungsbeschränkungen uneingeschränkt für Schäden an Leben, Körper und Gesundheit, die
                                                    auf einer fahrlässigen oder vorsätzlichen Pflichtverletzung ihrer gesetzlichen Vertreter oder
                                                    Erfüllungsgehilfen beruhen sowie für alle Schäden, die auf vorsätzlichen oder grob
                                                    fahrlässigen Vertragsverletzungen sowie Arglist ihrer gesetzlichen Vertreter oder ihrer
                                                    Erfüllungsgehilfen beruhen.
                                                </p>
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule haftet bei leichter Fahrlässigkeit im Hinblick auf Sach- und Vermögenschäden
                                                    nicht, außer wenn sie eine wesentliche Vertragspflicht, deren Erfüllung die ordnungsgemäße
                                                    Durchführung des Vertrages überhaupt erst ermöglicht, deren Verletzung die Erreichung des
                                                    Zwecks des Vertrages gefährdet und auf deren Einhaltung der Studierende regelmäßig
                                                    vertraut (im Folgenden „Kardinalpflicht“). Die Haftung wegen einer solchen Kardinalpflicht ist
                                                    ihrerseits auf den vertragstypischen, vorhersehbaren Schaden beschränkt. Dies gilt auch für
                                                    entgangenen Gewinn und ausgebliebene Einsparungen. Bei einfachen fahrlässigen
                                                    Verletzungen nicht vertragswesentlicher Nebenpflichten haftet die Hochschule im Übrigen
                                                    nicht. Die genannten Haftungsbeschränkungen gelten auch, soweit die Haftung für die
                                                    gesetzlichen Vertreter, leitenden Angestellten und sonstigen Erfüllungsgehilfen der
                                                    Hochschule betroffen ist.
                                                </p>
                                                <p style="margin-bottom: 10px;">
                                                    Eine weitergehende Haftung der Hochschule ist ohne Rücksicht auf die Rechtsnatur des
                                                    geltend gemachten Anspruchs ausgeschlossen. Soweit die Haftung ausgeschlossen oder
                                                    beschränkt ist, gilt dies auch für die persönliche Haftung der Angestellten, Arbeitnehmer,
                                                    Mitarbeiter, Vertreter und Erfüllungsgehilfen der Hochschule.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">8. Ausgabe von Prüfungszeugnissen</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Ausgabe von Prüfungszeugnissen setzt voraus, dass die/der Studierende die von der Hochschule ggf. entliehenen Gegenstände zurückgegeben hat.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">9. Haftung</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule übernimmt keine Haftung für einen mit dem Studium beabsichtigten Erfolg
                                                    und/ oder eine beabsichtigte Zulassung zu Prüfungen und/oder das Bestehen solcher
                                                    Prüfungen. Die Haftung der Hochschule, gleich aus welchem Rechtsgrund, die im
                                                    Zusammenhang mit der Benutzung der Räumlichkeiten und den An- und Abfahrten zum oder
                                                    vom Gelände der Hochschule stehen, beschränkt sich auf Vorsatz und grobe Fahrlässigkeit.
                                                    Ausnahme sind Unfälle auf dem Gelände der Hochschule, gegen die die Studierenden
                                                    versichert sind.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">10. Datenschutz</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die/Der Studierende ermächtigt die Hochschule, die im Zusammenhang mit dem
                                                    Vertragsverhältnis und dem Studium erhaltenen Daten über die Studierende bzw. den
                                                    Studierenden im Rahmen der Datenschutzgesetze zu verarbeiten und zu speichern. Die
                                                    Nutzung, Speicherung und Weitergabe personenbezogener Daten erfolgt nach Maßgabe der
                                                    geltenden datenschutzrechtlichen Bestimmungen, insbesondere denen der
                                                    Datenschutzgrundverordnung. Sämtliche personenbezogene Daten werden vertraulich
                                                    behandelt und nur insoweit an Dritte weitergegeben, wie dies gesetzlich angeordnet oder zur
                                                    Wahrung der berechtigten Interessen der Hochschule erforderlich ist. In diesem
                                                    Zusammenhang wird auf die Datenschutzerklärung der Hochschule verwiesen (siehe
                                                    Verwaltungsbogen mit Datenschutzerklärung).
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">11. Organisatorische Änderungen</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;">
                                                    Die Hochschule behält sich vor, Änderungen im Studienablauf vorzunehmen, sofern die
                                                    Studienziele hierdurch nicht beeinträchtigt werden und die Änderungen im Einklang mit der
                                                    geltenden Prüfungsordnung stehen und die Studieninhalte nicht wesentlich verändert werden.
                                                    Als Änderungen im Studienablauf gelten insbesondere der Beginn der Semester oder die
                                                    Länge der Vorlesungszeiten.
                                                </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        {{-- sixth page ends here  --}}

        {{-- seventh page starte here  --}}
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="center" style="padding-bottom: 6px;">Seite 7 von 9</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">12. Online-Streitbeilegung</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left" valign="top">
                                                <p style="margin-bottom: 10px;text-align:justify;">
                                                    Die Europäische Kommission stellt unter http://ec.europa.eu/consumers/odr/ eine Plattform
                                                    zur außergerichtlichen Online-Streitbeilegung (sog. OS-Plattform) bereit. Die Hochschule
                                                    weist darauf hin, dass an einem Streitbeilegungsverfahren vor einer
                                                    Verbraucherstreitschlichtungs- stelle nicht teilgenommen wird.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">13. Sonstiges</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  width="5%" align="left" valign="top">13.1</td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Erfüllungsort für die beiderseitigen Leistungen ist der Sitz der NORDAKADEMIE. Es
                                                    findet deutsches Recht Anwendung. Der Gerichtsstand ist Elmshorn.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  width="5%" align="left" valign="top">13.2</td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Sollten einzelne Bestimmungen des Vertrages unwirksam sein oder werden, so wird die
                                                    Wirksamkeit der übrigen Bestimmungen hiervon nicht berührt. Die unwirksame
                                                    Regelung ist durch eine wirksame und wirtschaftlich angemessene Bestimmung, die
                                                    dem Gewollten der Parteien am nächsten kommt, zu ersetzen.
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  width="5%" align="left" valign="top">13.3</td>
                                            <td width="95%" align="left" valign="top" style="padding-left: 10px;">
                                                <p style="margin-bottom: 10px;">
                                                    Mündliche Nebenabreden wurden nicht getroffen. Änderungen und Ergänzungen dieses
                                                    Studienvertrages bedürfen zu ihrer Wirksamkeit der Schriftform. Dies gilt auch für die
                                                    Aufhebung des Schriftformerfordernisses.
                                                </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:100px">
                                    <tbody>
                                        <tr>
                                            <td width="49%" align="left">
                                                <table cellpadding="0" cellspacing="0" width="100%"  border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td >
                                                                <p>
                                                                    Elmshorn,__________________________
                                                                </p>
                                                                <p style="padding-top:6px;font-size:12px;padding-left:40px">(Datum)</p>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="40%" align="right">

                                                <table cellpadding="0" cellspacing="0" width="100%" align="right" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p>
                                                                    _______________________________
                                                                </p>
                                                                <p style="padding-top:6px;font-size:12px;">(Ort, Datum)</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:100px;margin-bottom:50px">
                                    <tbody>
                                        <tr>
                                            <td width="49%" align="left">
                                                <table cellpadding="0" cellspacing="0" width="100%"  border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p>
                                                                    _______________________________
                                                                </p>
                                                                <p style="padding-top:6px;font-size:12px;">Für die Hochschule (Stempel, Unterschrift)</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="40%" align="right">

                                                <table cellpadding="0" cellspacing="0" width="100%" align="right" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <p>
                                                                    _______________________________
                                                                </p>
                                                                <p style="padding-top:6px;font-size:12px;">Studierende/r (Unterschrift)</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Der Vertrag ist in zwei gleichlautenden Ausfertigungen ausgestellt und von den Vertragsschließenden eigenhändig unterschrieben.</td>
                                        </tr>
                                        <tr>
                                            <td height="150px"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3 class="main-title">Anlagen</h3>
                                                <p style="text-align: justify;">
                                                    Widerrufsbelehrung mit Muster-Widerrufsformular, Prüfungsordnung
                                                    Betriebswirtschaftslehre, Merkblatt: Verhaltenskodex, Verwaltungsbogen mit
                                                    Datenschutzerklärung, Prüfungsverfahrensordnung, Einschreibordnung, Gebührenordnung
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        {{-- seventh page ends here  --}}

        {{-- eight page starts here  --}}
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding-bottom: 6px;">
                                <p style="margin-bottom: 10px;">
                                    Seite 8 von 9
                                </p>
                                <b style="font-size: 22px;">Widerrufsbelehrung</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0px 65px 40px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3 class="main-title">Widerrufsrecht</h3>
                                                <p style="margin-bottom: 6px;">
                                                    Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu
                                                    widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.
                                                    Um Ihr Widerrufsrecht auszuüben, müssen Sie uns unter der Anschrift:
                                                </p>
                                                <p>
                                                    NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft
                                                </p>
                                                <p>
                                                    Köllner Chaussee 11
                                                </p>
                                                <p style="margin-bottom: 20px;">
                                                    25337 Elmshorn
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td width="20%" style="padding-bottom:6px">
                                                                Telefon:
                                                            </td>
                                                            <td width="80%" style="padding-bottom:6px">
                                                                +49 (0)4121 4090-0
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%" style="padding-bottom:6px">
                                                                Fax:
                                                            </td>
                                                            <td width="80%" style="padding-bottom:6px">
                                                                +49 (0)4121 4090-40
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%" style="padding-bottom:6px">
                                                                E-Mail:
                                                            </td>
                                                            <td width="80%" style="padding-bottom:6px">
                                                                <a href="mailto:info@nordakademie.de" style="text-decoration: none;color:inherit;">
                                                                    info@nordakademie.de
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin-bottom: 6px">
                                                    mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief, Telefax oder EMail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie können dafür das
                                                    beigefügte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist. Zur
                                                    Wahrung der Widerrufsfrist reicht es aus, dass Sie die
                                                </p>
                                                <h3 class="main-title">Widerrufsfolgen</h3>
                                                <p style="margin-bottom: 6px;">
                                                    Wenn Sie diesen Vertrag widerrufen, werden wir Ihnen den Zahlungsbetrag, den wir von Ihnen
                                                    erhalten haben, unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag
                                                    zurückzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrages bei uns
                                                    eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei
                                                    der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde etwas Anderes
                                                    vereinbart. Für diese Rückzahlung werden keine Entgelte berechnet. Haben Sie während der
                                                    Widerrufsfrist auf Ihren Wunsch unsere Dienstleistungen in Anspruch genommen, so sind wir
                                                    berechtigt, von Ihnen einen angemessenen Betrag als Gegenleistung zu verlangen, der dem
                                                    Anteil der bis zu diesem Zeitpunkt, zu dem Sie uns von der Ausübung des Widerrufsrechts
                                                    hinsichtlich dieses Vertrages unterrichten, bereits erbrachten Dienstleistungen im Vergleich
                                                    zum Gesamtumfang der im Vertrag vorgesehenen Dienstleistungen entspricht.
                                                </p>
                                                <h3 class="main-title">Besondere Hinweise</h3>
                                                <p style="margin-bottom: 6px;">
                                                    Ihr Widerrufsrecht erlischt vorzeitig, wenn der Vertrag von beiden Seiten auf Ihren
                                                    ausdrücklichen Wunsch vollständig erfüllt ist, bevor Sie Ihr Widerrufsrecht ausgeübt haben.
                                                </p>
                                                <h3 class="main-title">Ende der Widerrufsbelehrung</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="150px"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        {{-- eight page ends here  --}}

        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="right" style="padding:60px 0 20px;">
                                <img style="display:block;height:32px;margin-right: 52px;"
                                src="{{ asset('images/logo.png') }}"
                                alt="logo">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding-bottom: 6px;">
                                <p style="margin-bottom: 10px;">
                                    Seite 9 von 9
                                </p>

                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 65px 40px;">
                                <h3 class="main-title">Muster-Widerrufsformular</h3>
                                <p style="margin:20px 0;">An die</p>
                                <p>NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft</p>
                                <p style="margin: 3px 0;">Köllner Chaussee 11</p>
                                <p style="margin-bottom: 16px">25337 Elmshorn</p>

                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="20%" style="padding-bottom:6px">
                                                Telefon:
                                            </td>
                                            <td width="80%" style="padding-bottom:6px">
                                                +49 (0)4121 4090-0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="padding-bottom:6px">
                                                Fax:
                                            </td>
                                            <td width="80%" style="padding-bottom:6px">
                                                +49 (0)4121 4090-40
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%" style="padding-bottom:6px">
                                                E-Mail:
                                            </td>
                                            <td width="80%" style="padding-bottom:6px">
                                                <a href="mailto:info@nordakademie.de" style="text-decoration: none;color:inherit;">
                                                    info@nordakademie.de
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p style="margin: 10px 0;">
                                    Hiermit widerrufe(n) ich / wir (*) den von mir / uns (*) abgeschlossenen Vertrag über den
                                    Kauf der folgenden Waren (*) / die Erbringung der folgenden Dienstleistung (*):
                                </p>
                                <p style="width:100%;border-bottom:2px solid #000;padding-top:45px;margin-bottom:30px;"></p>
                                <p>Bestellt am (*) / erhalten am (*):</p>
                                <p style="width:100%;border-bottom:2px solid #000;padding-top:45px;margin-bottom:30px;"></p>
                                <p>
                                    Vorname / Name des / der Verbraucher(s):
                                </p>
                                <p style="width:100%;border-bottom:2px solid #000;padding-top:45px;margin-bottom:30px;"></p>
                                <p>
                                    Anschrift des / der Verbraucher(s):
                                </p>
                                <p style="width:100%;border-bottom:2px solid #000;padding-top:45px;margin-bottom:30px;"></p>
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td width="40%" align="left" align="top" style="padding-right:30px;">
                                            <p style="width:100%;border-bottom:2px solid #000;padding-top:45px;margin-bottom:30px;"></p>
                                            <p style="font-size:12px;margin-top:6px">Unterschrift des / der Verbraucher(s)</p>
                                            <p style="font-size:12px;margin-top:6px">(nur bei Mitteilung auf Papier)</p>
                                        </td>
                                        <td width="40%" align="left" align="top" style="padding-left:30px;">
                                            <p style="width:100%;border-bottom:2px solid #000;padding-top:28px;margin-bottom:30px;"></p>
                                            <p style="font-size:12px;margin-top:6px">Datum</p>
                                        </td>
                                    </tr>
                                </table>
                                <p style="margin-top: 30px"> (*) Unzutreffendes bitte streichen</p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
        </tr>

    </tbody>
</table>



@endsection
