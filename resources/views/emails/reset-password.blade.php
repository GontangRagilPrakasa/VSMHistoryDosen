<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
      xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <!--[if gte mso 9]><xml>
         <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
         </o:OfficeDocumentSettings>
        </xml><![endif]-->
        <!-- fix outlook zooming on 120 DPI windows devices -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
        <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
        <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
        <title>JBA INDONESIA</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">

        <style type="text/css">
            html {background: #fbfbfb;font-family: 'Roboto', sans-serif;}
            body {
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            table {
                border-spacing: 0;
            }

            table td {
                border-collapse: collapse;
            }

            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .ReadMsgBody {
                width: 100%;
                background-color: #ebebeb;
            }

            table {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            img {
                -ms-interpolation-mode: bicubic;
            }

            .yshortcuts a {
                border-bottom: none !important;
            }

            @media screen and (max-width: 599px) {
                .force-row,
                .container {
                    width: 100% !important;
                    max-width: 100% !important;
                }
            }
            @media screen and (max-width: 400px) {
                .container-padding {
                    padding-left: 12px !important;
                    padding-right: 12px !important;
                }
            }
            .ios-footer a {
                color: #aaaaaa !important;
                text-decoration: underline;
            }
            a[href^="x-apple-data-detectors:"],
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
        </style>
    </head>

    <body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

        <!-- 100% background wrapper (grey background) -->
        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
            <tr>
                <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #FBFBFB;">
                    <br>
                    <!-- 600px container (white background) -->
                    <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px;box-shadow: 0 0 8px rgba(51, 51, 51, 0.5);">
                        <tr>
                            <td class="container-padding header" align="left" style="font-family:Roboto, Arial, sans-serif;font-size:20px;font-weight:bold;padding-bottom:1em;color:#fff;padding-left:24px;padding-right:24px;padding-top: 1em;background-color: #2270B9">
                                JBA INDONESIA <span style="float: right;">RESET PASSWORD</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff;background: url('<?= env('MAIL_BACKGROUND'); ?>')no-repeat;background-size: 70%;background-position: center;border-bottom: solid 1em #236fb9;">

                                <div class="body-text" style="font-family:Roboto, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
                                    <br>
                                    Yth. Bpk./Ibu <strong>{{ $user_full_name }}</strong>,<br>
                                    Kami menerima permintaan reset password akun Anda,
                                    <br><br>
                                </div>

                                <div class="hr" style="height:1px;border-bottom:1px solid #cccccc">&nbsp;</div>
                                <br>

                                <div  align="center" style="margin-bottom: 48px;margin-top: 30px;">
                                    <a href="{{ $url }}" style="text-decoration: none;font-size: 18px;" >
                                        <div style="padding: 15px 0px 15px 0px; background-color: #2270B9; text-align: center; color: white; width: 200px;" >
                                            Reset Password
                                        </div>
                                    </a>
                                </div>

                                <div class="hr" style="height:1px;border-bottom:1px solid #cccccc;clear: both;">&nbsp;</div>

                                <div class="body-text" style="font-family:Roboto, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
                                    <br>
                                    Apabila Anda tidak pernah meminta reset password, segera hubungi petugas Customer Service JBA
                                    <br><br>
                                    Terima Kasih,<br>
                                    JBA Indonesia<br><br>
                                </div>

                            </td>
                        </tr>

                    </table>
                    <!--/600px container -->
                </td>
            </tr>
        </table>
        <!--/100% background wrapper-->

    </body>
</html>
