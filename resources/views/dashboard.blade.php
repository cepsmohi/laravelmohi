<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>
<body>
<h1>Dashboard</h1>
<p>You are logged in as: {{ auth()->user()->email ?? auth()->user()->phone }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>
