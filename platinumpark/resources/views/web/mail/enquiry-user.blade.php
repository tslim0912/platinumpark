<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
    </head>
    <body style="margin: 0;">
        <div style="padding-top: 40px;max-width: 800px; margin: auto; padding-bottom: 13px;" >
            <table width="100%">
                <tr>
                    
                    <th>
                        <div style=" text-align: right;">
                            <img style="width:100px;" src="{{ URL('assets/web/images/logo-black.png') }}" alt="">
                        </div>
                    </th>
                </tr>
                    <th style="font-family:'Open Sans',sans-serif;">
                        <h4 style="font-family:'Open Sans',sans-serif; text-align: center; margin-bottom: 0px; color: #222;     margin-top: 13px;">Greetings from Platinum Park!</h4>
                    </th>
                <tr>

                </tr>
            </table>
            
        </div>
       
        
        <table  width="500" cellspacing="0" cellpadding="0" style="border: 1px solid #999;width:100%;background-color:#ffffff;margin:0 auto;padding-top: 20px; padding-bottom: 20px;max-width:800px;">
            <tbody>
                <tr>
                    <td align="left" style="color:#3f4652;line-height:23px;padding-left:28px;padding-right:28px;font-size:15px;font-family:'Open Sans',sans-serif;font-weight:400;">
                        <font face="'Open Sans', sans-serif;  color: #3f4652 !important;">
                            Dear {!! $first_name !!}, 
                            <br>
                            <br>Thank you for getting in touch with Platinum Park. We have received your query and will get back to you as soon as we can.
                            <br><br>Please find below recap of your sent enquiry to us : 
                            <br><br>
                        </font>
                    </td>
                </tr>
                <tr>
                    <td style="color:#3f4652;line-height:23px;padding-left:28px;padding-right:28px;font-size:15px;font-family:'Open Sans',sans-serif;font-weight:400;">
                        Gender: {{ $gender }} <br>
                        Contact: {{ $contact }} <br>
                        First Name: {{ $first_name }} <br>
                        {{-- Last Name: {{ $last_name }} <br> --}}
                        Email: {{ $email }} <br>
                        Services: {!! $services ? $services : "-"!!} <br>
                        {{-- Inquiry: {!! $inquiry ? $inquiry : "-"!!} <br> --}}
                        To Know More : {!! $asset_checkbox ? $asset_checkbox : 'No' !!}
                    </td>
                </tr>
                <tr>
                    <td align="left" style="color:#3f4652;line-height:23px;padding-left:28px;padding-right:28px;font-size:15px;font-family:'Open Sans',sans-serif;font-weight:400; color: #3f4652 !important;">
                        <font face="'Open Sans', sans-serif">
                            <br>
                            If you would like to provide us with any further information, please feel free to share with us by
                            replying to this email.<br><br>
                            We look forward to speaking with you soon!
                        </font>
                    </td>
                </tr>
                {{-- <tr>
                    <td>Contact Number: {!! $contact_number !!}</td>
                </tr>
                <tr>
                    <td>Email Address: {{ $email }}</td>
                </tr>
                <tr>
                    <td>Message: {!! $messages !!}</td>
                </tr> --}}
            </tbody>
        </table>
        <br>
        <table width="500" cellspacing="0" cellpadding="0" style="width:100%;max-width:500;margin:0 auto">
            <tbody>
                <tr>
                    <td><div style="text-align: center; padding: 15px 0; color: #3f4652; font-family:'Open Sans',sans-serif;">Cheers,<br>
                        Team Platinum Park
                    </div></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>