@component('mail::layout')
    @slot('header')
        @component('mail::header')
            <a target="_blank" href="https://viewstripo.email"><img src="images/logo.png" alt="Logo"
                    style="display: block;height:25px;margin-bottom: 20px;" title="Logo" height="55"></a>
        @endcomponent
    @endslot
    @component('mail::table')
        {{ $slot }}
    @endcomponent
    @slot('footer')
        @component('mail::footer')
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
                    <a style="display:inline-block;margin:0 4px;text-decoration: none;" href="javascript:void(0);">
                        <img src="images/linked_in.png" alt="linked_in" style="display: block;" height="20">
                    </a>
                    <a style="display:inline-block;margin:0 4px;text-decoration: none;" href="javascript:void(0);">
                        <img src="images/instagram.png" alt="instagram" style="display: block;" height="20">
                    </a>
                    <a style="display:inline-block;margin:0 4px;text-decoration: none;" href="javascript:void(0);">
                        <img src="images/facebook.png" alt="facebook" style="display: block;" height="20">
                    </a>
                    <a style="display:inline-block;margin:0 4px;text-decoration: none;" href="javascript:void(0);">
                        <img src="images/twitter.png" alt="twitter" style="display: block;" height="20">
                    </a>
                    <a style="display:inline-block;margin:0 4px;text-decoration: none;" href="javascript:void(0);">
                        <img src="images/you_tube.png" alt="you_tube" style="display: block;" height="20">
                    </a>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <p style="width: 50%;height: 2px;background-color: #C6C7C8;margin: 30px 0;"></p>
                </td>
            </tr>
            <tr align="left">
                <td>
                    <p style="color:#003A79;line-height: 1.4;text-align: center">
                        <small>{{ __('NORDAKADE
                                                                                        MIE gAG Hochschule der Wirtschaft, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein
                                                                                        25337, 04121 / 4090 - 0') }}</small>
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a href="javascript:void(0);"
                        style="color:#009ac4;text-decoration: underline;cursor: pointer; margin-right: 4px;">{{ __('Log Out') }}</a>
                    <a href="javascript:void(0);"
                        style="color:#009ac4;text-decoration: underline;cursor: pointer;">{{ __('Manage setting rings') }}
                    </a>
                </td>
            </tr>
        @endcomponent
    @endslot
@endcomponent
