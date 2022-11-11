<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>
<body
    style="box-sizing: border-box; margin: 0; padding: 20px 0;height: 100%; width: 100%; word-break: break-word;font-family:'Poppins', sans-serif; -webkit-font-smoothing: antialiased;background:#EDEFF0;">

<table style="font-size: 14px;border:2px solid #eee;padding:20px;background-color:#fff;" width="600px"
       cellpadding="0" cellspacing="0" role="presentation" align="center">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            {{ $header ?? '' }}

            <!-- Email Body -->
                <!-- Body content -->
                <tr>
                    <td>
                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                        {{ $subcopy ?? '' }}
                    </td>
                </tr>
                {{ $footer ?? '' }}
            </table>
        </td>
    </tr>
</table>
</body>
</html>
