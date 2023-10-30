<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reminder Email</title>
    <style>
        body{margin-top:20px;}
    </style>
</head>
<body>
    <table class="body-wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        <tbody>
            <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                <td
                    class="container"
                    width="800"
                    style="
                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                        box-sizing: border-box;
                        font-size: 14px;
                        vertical-align: top;
                        display: block !important;
                        max-width: 800px !important;
                        clear: both !important;
                        margin: 0 auto;
                    "
                    valign="top"
                >
                    <div class="content" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; max-width: 800px; display: block; margin: 0 auto; padding: 20px;">
                        <table
                            class="main"
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;"
                            bgcolor="#fff"
                        >
                            <tbody>
                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td
                                        class=""
                                        style="
                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                            box-sizing: border-box;
                                            font-size: 16px;
                                            vertical-align: top;
                                            color: #fff;
                                            font-weight: 500;
                                            text-align: center;
                                            border-radius: 3px 3px 0 0;
                                            background-color: #38414a;
                                            margin: 0;
                                            padding: 20px;
                                        "
                                        align="center"
                                        bgcolor="#71b6f9"
                                        valign="top"
                                    >
                                        <span style="font-size: 32px; color: #fff;">Calendar Reminder</span> <br />
                                        <span style="margin-top: 10px; display: block;">There is an upcoming event on the next 3 days.</span>
                                    </td>
                                </tr>
                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <tbody>
                                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td
                                                        class="content-block"
                                                        style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 21px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top"
                                                    >
                                                        @if(isset($event->photo))
                                                        <div style="display: flex; justify-content: center; padding: 15px 0 15px 20px">
                                                            <img src="https://media.istockphoto.com/id/491520707/photo/sample-red-grunge-round-stamp-on-white-background.jpg?s=612x612&w=0&k=20&c=FW80kR5ilPkiJtXZEauGTghNBOgQviVPxAbhLWwnKZk=" style="width: 300px; height: auto">
                                                        </div>
                                                        @endif
                                                        {{ $event->title }}
                                                    </td>
                                                </tr>
                                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; margin: 0;">
                                                    <td
                                                        class="content-block"
                                                        style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top"
                                                    >
                                                        <p><strong>DETAILS</strong></p>
                                                        <table>
                                                            <tr>
                                                                <td style="width: 30%">Schedule</td>
                                                                <td>: {{ $event->schedule }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Location / Venue</td>
                                                                <td>: {{ $event->location }}</td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                        <p><strong>REQUIREMENTS</strong></p>
                                                        {!! $event->description !!}
                                                        <br>
                                                        <p><strong>EVENT GOAL</strong></p>
                                                        {!! $event->event_goal !!}
                                                    </td>
                                                </tr>
                                                <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td
                                                        class="content-block"
                                                        style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top"
                                                    >
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="footer" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                            <table width="100%" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                <tbody>
                                    <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td
                                            class="aligncenter content-block"
                                            style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;"
                                            align="center"
                                            valign="top"
                                        >
                                            <a href="#" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">
                                                
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
            </tr>
        </tbody>
    </table>    
</body>
</html>