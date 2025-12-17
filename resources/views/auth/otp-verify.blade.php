<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify OTP</title>
</head>
<body>
<h1>Verify OTP</h1>

@if ($errors->any())
    <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="hidden" name="identifier" value="{{ old('identifier', $identifier) }}">

    <p>Sent to: <strong>{{ old('identifier', $identifier) }}</strong></p>

    <label>OTP Code</label><br>
    <input name="code" value="{{ old('code') }}" placeholder="123456" required>
    <br><br>

    <button type="submit">Verify & Login</button>
</form>

<form method="POST" action="{{ route('otp.request') }}" style="margin-top: 12px;">
    @csrf
    <input type="hidden" name="identifier" value="{{ old('identifier', $identifier) }}">
    <button type="submit">Resend OTP</button>
</form>
</body>
</html>
