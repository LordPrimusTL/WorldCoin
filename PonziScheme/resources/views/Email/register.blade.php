<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mailer Demo</title>
</head>

<body style="background-color: green;">
Hi {{ $data['fname'] }},
Hi {{ $link }},
<br>
Welcome to the Laravel and SendGrid SMTP tutorial.  This email was sent from Laravel using SendGrid as a service.
<br>
Best Regards
</body>
</html>