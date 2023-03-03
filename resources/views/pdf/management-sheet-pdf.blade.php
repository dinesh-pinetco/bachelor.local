@extends('laravel-finer::pdf.layout')

@section('content')
    <table style="margin-left: auto;margin-top:-20px; margin-right: auto;" width="550">
        <tr>
            <td align="right">
                <img style="display:block;height:32px;margin-right: 52px;"
                     src="{{ asset('images/logo.png') }}"
                     alt="logo">
            </td>
        </tr>
        <table style="margin-top:30px;margin-left: auto; margin-right: auto;font-size: 14px;" width="550">
            <tr>
                <caption style="font-weight: 700;margin-top:50px;margin-bottom:10px;font-size:16px;text-align: left;">
                    Verwaltungsbogen
                </caption>
            </tr>
            <tr>
                <td>
                    <table style="font-size: 12px;font-weight: lighter;text-align: left;">
                        <td>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Studiengang')}}:</td>
                                <td>{{__('Wirtschaftsingenieurwesen')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Beginn des Studiums')}}:</td>
                                <td>{{__('01.10.2023')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Vorname')}}:</td>
                                <td>{{__('Max')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Nachname')}}:</td>
                                <td>{{__('Musterfrau')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('geboren am')}}:</td>
                                <td>{{__('01.01.2003')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('geboren in')}}:</td>
                                <td>{{__('Testcity, Deutschland')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Nationalität')}}:</td>
                                <td>{{__('deutsch')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Telefon')}}:</td>
                                <td>{{__('034533333333 3333333')}}
                                </td>
                            </tr>
                            <tr valign="top" style="font-size: 12px;">
                                <td style="padding-right: 35px;">{{__('Adresse')}}:</td>
                                <td>Teststraße 19<br/>
                                    12345 Testcity<br/>
                                    Deutschland
                                </td>
                            </tr>
                        </td>
                    </table>
                </td>
                <td align="right">
                    <img style="display:inline-block;height:150px;width:120px;margin-right:50px;object-fit: contain;"
                         src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTvg6oLc3ZWygJ9Vvoc2S7XAFBS1vcZGiYAdbJCGzex4E4STFKZ"
                         alt="Bild des Studierenden">
                </td>
            </tr>
        </table>
    </table>
    <table>
        <tr valign="top" style="font-size: 12px;">
            <td style="width: 23%;">{{__('Zweite Fremdsprache')}}:</td>
            <td>{{__('Spanisch')}}
            </td>
        </tr>
        <tr valign="top" style="font-size: 12px;">
            <td style="font-size: 12px;width:23%;"></td>
            <td style="font-size: 12px;font-style: italic;text-align: left;padding-top:8px;">{{__('Spanisch und Französisch können sowohl als Anfänger (ohne Vorkenntnisse) wie auch als
Fortgeschrittener (2-3 Jahre Vorkenntnisse) belegt werden. Auf Basis eines Einstufungstests
werden homogene Unterrichtsgruppen entsprechend den individuellen Sprachkenntnissen
gebildet. ')}}
            </td>
        </tr>
        <tr valign="top" style="font-size: 12px;">
            <td style="font-size: 12px;width:23%;">{{__('Kooperationsunternehmen')}}:</td>
            <td style="font-size: 12px;">Nordakademie<br/>
                Reginald Testuser<br/>
                Teststraße 123 <br/>
                12345 Testcity
            </td>
        </tr>
    </table>
    <table style="margin-top: 15px;border:1px solid #D9D9D9;background: #EEEEEE;">
        <tr>
            <td colspan="2" style="margin-top: 20px;padding: 5px;font-size: 11px;">
                {{__('Bitte sende diesen Bogen mit einer beglaubigten Kopie Deines Schulabschlusszeugnisses* und einer Versicherungsbescheinigung Deiner
Krankenkasse, den Studienvertrag an die NORDAKADEMIE, Köllner Chaussee 11, 25337 Elmshorn. Sollten Dir noch nicht alle Unterlagen
vorliegen, sende uns bitte vorab den Verwaltungsbogen und Studienvertrag zu und reiche die fehlenden Unterlagen nach. ')}}
            </td>
        </tr>
    </table>
    <table style="margin-top: 50px;">
        <tr>
            <caption style="font-weight: 700;margin-bottom:10px;font-size:12px;text-align: left;color:#003A79;">
                {{__('Information zur Verarbeitung Ihrer personenbezogenen Daten')}}
            </caption>
        </tr>
        <tr>
            <td>
                <p style="font-size: 11px;margin-top:-1px;">{{__('Die NORDAKADEMIE gemeinnützige Aktiengesellschaft Hochschule der Wirtschaft (Köllner Chaussee 11, 25337 Elmshorn) verarbeitet als
verantwortliche Stelle Deine personenbezogenen Daten für die Erfüllung des Studienvertrages, (z.B. Identifikation, Prüfungen,
Hochschulzeugnisse etc.). Rechtsgrundlage für die Verarbeitung ist Art. 6 Abs. 1 lit. b DSGVO.')}}</p>
                <p style="font-size: 11px;">{{__('Eine Übermittlung Deiner Daten an Dritte findet grundsätzlich nicht statt, außer in den folgenden Fällen: Die Datenübermittlung ist für die
Durchführung des Studienvertrags erforderlich, es besteht eine gesetzliche Verpflichtung oder Sie haben zuvor ausdrücklich in die
Weitergabe Deiner Daten eingewilligt. Die erhobenen Daten werden bei Fortfall des Zwecks der Verarbeitung oder innerhalb der
gesetzlichen Aufbewahrungsfristen gelöscht.')}}
                </p>
                <p style="font-size: 11px;"><b>Ihre
                        Rechte</b>: {{__('Nähere Informationen zu Deinen Rechten sowie allgemeine Hinweise zum Datenschutz indem Du unter')}}
                    :<a class="underline cursor-pointer" href="https://www.nordakademie.de/datenschutz/">https://www.nordakademie.de/datenschutz/</a>
                </p>
            </td>
        </tr>
    </table>
    <table style="margin-top:12px;margin-left: auto; margin-right: auto;font-size: 12px;" width="550">
        <tr>
            <td style="width: 40%;">
                <p style="display: inline-block;">{{__('Datum')}}</p>
                <p style="display: inline-block;margin-left: 20px;">15.12.2022</p>
            </td>
            <td style="width: 60%;">
                <p style="display: inline-block;">{{__('Unterschrift')}}</p>
                <p style="margin-left:20px;display:inline-block;border-bottom: 1px solid #000;width: 200px;"></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>* Als Schulabschlusszeugnis bezeichnen wir das Dokument, das Ihnen nach geltendem deutschen Recht den
                    Zugang zum Studium
                    an einer Fachhochschule ermöglicht (Hochschulzugangsberechtigung).</p>
            </td>
        </tr>
    </table>

    <table style="margin-top:auto;margin-left: auto; margin-right: auto;font-size: 12px;" width="550">
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

@endsection
