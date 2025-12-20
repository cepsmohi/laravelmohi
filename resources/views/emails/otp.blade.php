<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Code</title>
</head>
<body>
<p>Hello,</p>

<p>Your One-Time Password is:</p>

<h2 style="letter-spacing: 2px;">{{ $code }}</h2>

<p>This code will expire shortly. Do not share it with anyone.</p>

<p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
