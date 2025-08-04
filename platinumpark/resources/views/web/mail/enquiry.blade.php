<html>
    <head>
    </head>
    <body style="margin: 0;">
        <h4 style="text-align: center; padding-top: 50px;">New Enquiry</h4>
        
        <table  width="500" cellspacing="0" cellpadding="0" style="border: 1px solid #999;width:100%;background-color:#ffffff;margin:0 auto;padding-top: 20px; padding-bottom: 20px;max-width:800px;">
            <tbody>
                <tr>
                    <td style="color:#3f4652;line-height:23px;padding-left:28px;padding-right:28px;font-size:15px;font-family:'Open Sans',sans-serif;font-weight:100;">
                        Gender: {{ $gender }} <br>
                        Contact: {{ $contact }} <br>
                        Name: {{ $first_name }} <br>
                        {{-- Last Name: {{ $last_name }} <br> --}}
                        Email: {{ $email }} <br>
                        Services: {!! $services ? $services : "-"!!} <br>
                        {{-- Inquiry: {!! $inquiry ? $inquiry : "-"!!} <br> --}}
                        To Know More : {!! $asset_checkbox ? $asset_checkbox : 'No' !!}
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="500" cellspacing="0" cellpadding="0" style="width:100%;max-width:500;margin:0 auto">
            <tbody>
                <tr>
                    <td><div style="text-align: center; padding: 50px 0; color: #74787e; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">Cheers,<br>
                        Team Platinum Park
                    </div></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>