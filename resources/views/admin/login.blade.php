<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
    <style>
        body { background: #f8fafc; font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial; }
        .login-wrap { max-width: 420px; margin: 6rem auto; background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 6px 18px rgba(2,6,23,0.06); }
        h1 { margin: 0 0 1rem 0; font-size: 1.5rem; color: #111827; }
        label { display:block; margin-top: 0.75rem; color:#374151; font-size:0.95rem; }
        input { width:100%; padding:0.85rem 1rem; margin-top:0.35rem; border-radius:10px; border:1px solid rgba(15,23,42,0.08); }
        .button-primary { margin-top:1rem; display:inline-block; padding:0.7rem 1.1rem; border-radius:10px; background:#4f46e5; color:#fff; border:none; cursor:pointer; font-weight:600; }
        .error { background:#fee2e2; color:#991b1b; padding:0.75rem 1rem; border-radius:8px; margin-bottom:0.75rem; }
        .note { color:#6b7280; font-size:0.9rem; margin-top:0.5rem; }
    </style>
</head>
<body>
    <div class="login-wrap">
        <h1>Admin Login</h1>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="post" action="{{ route('admin.login.post') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required />

            <button class="button-primary" type="submit">Sign in</button>
        </form>

        <p class="note">Please use the proper credentials to login.</p>
    </div>
</body>
</html>