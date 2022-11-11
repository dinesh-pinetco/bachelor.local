@component('mail::layout')
    @slot('header')
        @component('mail::header')
            <a target="_blank" href="javascript:void(0);">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="display: block;height:25px;margin-bottom: 20px;" title="Logo" height="55">
            </a>
        @endcomponent
    @endslot
    @component('mail::table')

        <tr align="center">
            <td style="background-image: url('images/register-bg.png');height:312px;width:100%;background-position: center;background-size: cover;"
                alt="">
            </td>
        </tr>
        <tr align="left">
            <td>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 60px;">Hallo
                    CONTACT.FIRSTNAME,<br>
                    Du überlegst, Deinen <strong>Master in Wirtschaftsinformatik </strong> zu machen, weißt aber
                    noch nicht, an welcher Hochschule?</p>
                <p style="display:block;color:#003A79;line-height: 1.4;margin-top: 20px;">Was zählt, ist Deine
                    Als die Nr. 1
                    Wirtschaftshochschule im Norden geben wir alles für unsere Studierenden. Es ist unser
                    kompromissloser Anspruch, Dich für Deine Karriere optimal zu Dafür bieten wir in jedem
                    Bereich den jetzt und auf lange Sicht gesehen perfekten Studiengang. Und sind dafür in engem
                    Austausch mit der Wirtschaft.</p>
                <p style="display:block;color:#003A79;line-height: 1.4;margin: 20px 0;">Das klingt spannend?
                    Dann melde Dich
                    an zu unserem <strong>Online-lnfoabend</strong> <a href="javascript:void(0);"
                                                                       style="color:#009ac4;text-decoration: underline;cursor: pointer;">Master
                        Wirtschaftsinformatik</a> am Montag, 14.3. um 17.00 Uhr.
                    Hier kannst Du Dich genauer informieren und
                </p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a style="display:inline-block;line-height:1.4;padding: 10px;background-color: #003A79;color: #ffffff;border-radius: 5px;text-decoration: none;"
                   href="javascript:void(0);">Zur Kostolosen Annemlung</a>
            </td>
        </tr>
        <tr align="left">
            <td>
                <p style="color:#003A79;line-height: 1.4;margin: 20px 0;">Während des Online-Events hast du
                    die Möglichkeit Fragen z.B. zu den Lehrinhalt- en oder Bewerbungsverfahren zu stellen.</p>
                <p style="color:#003A79;line-height: 1.4;margin-top: 20px;">Wir freuen uns auf Dich!<br><small>Vom
                        Team der NORDAKADEMIE</small>
                </p>
                <p style="color:#003A79;line-height: 1.4;margin: 20px 0;"><strong>100% DEINE ZUKUNFT —
                        Bachelor. Master. Karriere.</strong>
                </p>
            </td>
        </tr>
        <tr align="left">
            <td>
                <p style="display:inline-block;color:#003A79;line-height: 1.4;margin: 20px 0 0;">NORDAKADEMIE
                    Hochschule der
                    Wirtschaft <br> Köllner Chaussee 11 25337 EImshorn <br>
                    T: 04121 4090-154</p>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 30px;">
                <a style="display:inline-block;margin:0 4px;text-decoration: none;"
                   href="javascript:void(0);">
                    <img src="{{ asset('images/linked_in.png') }}" alt="linked_in"
                         style="display: block;"
                         height="20">
                </a>
                <a style="display:inline-block;margin:0 4px;text-decoration: none;"
                   href="javascript:void(0);">
                    <img src="{{asset('images/instagram.png')}}" alt="instagram"
                         style="display: block;"
                         height="20">
                </a>
                <a style="display:inline-block;margin:0 4px;text-decoration: none;"
                   href="javascript:void(0);">
                    <img src="{{asset('images/facebook.png')}}" alt="facebook"
                         style="display: block;"
                         height="20">
                </a>
                <a style="display:inline-block;margin:0 4px;text-decoration: none;"
                   href="javascript:void(0);">
                    <img src="{{asset('images/twitter.png')}}" alt="twitter"
                         style="display: block;"
                         height="20">
                </a>
                <a style="display:inline-block;margin:0 4px;text-decoration: none;"
                   href="javascript:void(0);">
                    <img src="{{asset('images/you_tube.png')}}" alt="you_tube"
                         style="display: block;"
                         height="20">
                </a>
            </td>
        </tr>
        <tr>
            <td align="center">
                <p style="width: 50%;height: 2px;background-color: #C6C7C8;margin: 30px 0;"></p>
            </td>
        </tr>
    @endcomponent
    @slot('footer')
        @component('mail::footer')
            <tr align="left">
                <td>
                    <p style="color:#003A79;line-height: 1.4;text-align: center"><small>{{__('NORDAKADE
                MIE gAG Hochschule der Wirtschaft, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein
                25337, 04121 / 4090 - 0')}}</small></p>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a href="javascript:void(0);"
                       style="color:#009ac4;text-decoration: underline;cursor: pointer; margin-right: 4px;">{{__('Log Out')}}</a>
                    <a href="javascript:void(0);"
                       style="color:#009ac4;text-decoration: underline;cursor: pointer;">{{__('Manage setting rings')}}
                    </a>
                </td>
            </tr>
        @endcomponent
    @endslot
@endcomponent
