<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
        body {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0 !important;
            padding: 0 !important;
        }

        body .title-text {
            font-size: 20px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-weight: bold;
            color: #005FB4;
            line-height: 1.5;
            text-align: left;
        }

        body .inner-text {
            font-size: 14px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #333333;
            line-height: 1.5;
            padding-bottom: 20px;
        }

        p {
            margin: 1em 0;
        }

        table td {
            border-collapse: collapse;
        }

        img {
            outline: 0;
        }

        a img {
            border: none;
        }

        p {
            margin: 1em 0;
        }

        @-ms-viewport {
            min-width: 480px;
            max-width: 960px;
        }

        @media only screen and (max-width: 480px) {
            body .container {
                width: 100% !important;
            }

            body .footer {
                width: auto !important;
                margin-left: 0;
            }

            body .content-padding {
                padding: 4px !important;
            }

            body .logo {
                display: block !important;
                padding: 0 !important;
            }

            body .content img {
                width: auto !important;
                max-width: 100% !important;
                height: auto !important;
                max-height: inherit !important;
            }

            body .photo img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            body .drop {
                display: block !important;
                width: 100% !important;
                float: left;
                clear: both;
            }
        }

        @media only screen and (max-width: 660px) {
            body .container {
                width: 100% !important;
            }

            body .logo {
                display: block !important;
                padding: 0 !important;
            }

            body .photo img {
                width: 100% !important;
                height: auto !important;
            }
        }
    </style>
</head>
<body bgcolor="#ffffff" text="#212121"
      style="background-color: #FFFFFF; color: #000000; margin: 0; padding: 0; -webkit-text-size-adjust:none;">

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td align="center">
            <table cellspacing="0" cellpadding="0" border="0" width="628" class="container" align="center">
                <tr>
                    <td width="100%" align="left">
                        <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" width="100%">
                            <tr>
                                <td class="title-text">
                                    <p class="logo" style="color: white; background-color: #1963aa; padding: 5px; border-radius: 5px;"
                                       align="center">
                                        <a href="https://www.puertoparrot.com">
                                            <img src="{{ url(config('admin-mailer.logo_link')) }}?u={{ $log->uuid }}"
                                                 width="300" height="51" alt="Puerto Parrot">
                                        </a>
                                    </p>
                                    <p class="title-text">{{ $title }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" style="background: #f2f2f2;">
            <table cellspacing="0" cellpadding="0" border="0" width="628" class="container" align="center">
                <tr>
                    <td style="padding: 10px 0 10px 0;">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td align="left" class="content content-padding inner-text">
                                    @yield('content')
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding: 20px 16px 0 16px; background: #ffffff;">
            <table cellspacing="0" cellpadding="0" border="0" width="628" class="container" align="center">
                <tr>
                    <td width="100%" align="left">
                        <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" width="100%">
                            @if (isset($info_box))
                                @include('emails._infobox')
                            @endif
                            <tr>
                                <td class="inner-text">
                                    Thank you, <br/><br/>The Puerto Parrot Team
                                </td>
                            </tr>
                            @if (isset($emails_notify))
                                @include('emails._notify')
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" style="padding: 8px 16px; background: #CCFF77;">
            <table cellspacing="0" cellpadding="0" border="0" width="628" class="container" align="center"
                   style="text-align: center">
                <tr>
                    <td align="center" style="text-align: center">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%" align="center">
                            <tr>
                                <td width="314" class="drop">
                                    <table border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                            <td style="vertical-align: middle; padding: 8px 8px 8px 8px">
                                                <a href="mailto:contact@puertoparrot.com"><img
                                                            src="http://www.puertoparrot.com/img/social_icon_mail_white_alpha_2x.png"
                                                            width="32" height="32" alt="mail" border="0"/></a>
                                            </td>
                                            <td style="vertical-align: middle; padding: 8px 8px 8px 8px">
                                                <a href="https://www.facebook.com/puertoparrot" target="_blank"><img
                                                            src="http://www.puertoparrot.com/img/social_icon_facebook_white_alpha_2x.png"
                                                            width="32" height="32" alt="Facebook" border="0"/></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" style="background: #e5e5e5; padding: 30px 16px" class="footer">
            <table cellspacing="0" cellpadding="0" border="0" width="628" class="container" align="center">
                <tr>
                    <td style="font-size: 14px; font-family: 'Helvetica Neue', Arial, sans-serif; color: #333333; line-height: 1.1rem; padding: 0 0 8px 0; margin: 0; text-align: center">
                        This is a message by <a href="https://www.puertoparrot.com"
                                                style="font-weight: bold;color:#333333; text-decoration: none;"
                                                target="_blank">Puerto Parrot</a><br>
                        You may unsubscribe at any time by <a
                                href="{{ route($prefix . 'unsubscribe', ['u' => $customer->uuid]) }}">clicking this
                            link</a><br>
                        {{ route($prefix . 'unsubscribe', ['u' => $customer->uuid]) }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 14px; font-family: 'Helvetica Neue', Arial, sans-serif; color: #333333; line-height: 1.5; padding: 0 0 8px 0; margin: 0; text-align: center">
                        Puerto Parrot | &copy; {{ date("Y") }} -
                        <a href="{{ route('home.copyright') }}"
                           style="font-weight:bold; color:#333333; text-decoration:none;">Terms & Conditions</a> -
                        <a href="{{ route('home.terms') }}"
                           style="font-weight:bold; color:#333333; text-decoration:none;">Privacy Policy</a> -
                        <a href="{{ route('home.about') }}"
                           style="font-weight:bold; color:#333333; text-decoration:none;">About us</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
