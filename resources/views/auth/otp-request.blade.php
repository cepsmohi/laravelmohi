<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>OTP Login</title>
</head>
<body>
<h1>Login with OTP</h1>

@if (session('status'))
    <p style="color: green">{{ session('status') }}</p>
@endif

@if ($errors->any())
    <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('otp.request') }}">
    @csrf
    <label>Email or Phone</label><br>
    <input name="identifier" value="{{ old('identifier') }}" placeholder="email@example.com or +8801XXXXXXXXX" required>
    <br><br>
    <button type="submit">Send OTP</button>
</form>
</body>
</html>
