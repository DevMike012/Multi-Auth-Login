<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Change password</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f7fa; display:flex; align-items:center; justify-content:center; height:100vh; }
        .card { background:white; padding:24px; border-radius:8px; box-shadow:0 4px 16px rgba(0,0,0,0.08); width:360px; }
        label { display:block; margin-bottom:6px; font-weight:600; }
        input { width:100%; padding:8px 10px; margin-bottom:12px; border:1px solid #d1d5db; border-radius:6px; }
        button { width:100%; padding:10px; background:#2563eb; color:white; border:none; border-radius:6px; cursor:pointer; }
        .status { background:#e6f4ea; color:#065f46; padding:8px; border-radius:6px; margin-bottom:12px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Set a new password</h2>

        @if(session('status'))
            <div class="status">{{ session('status') }}</div>
            <script>
                // Redirect after a short delay to allow user to read the message
                setTimeout(function() {
                    // Redirect target is provided by server via Location header after redirect;
                    // No-op here — server will redirect when ChangePasswordController returns redirect.
                }, 1500);
            </script>
        @endif

        <form method="POST" action="{{ route('password.change.store') }}">
            @csrf

            <div>
                <label for="password">New password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
            </div>

            <div>
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div>
                <button type="submit">Change password</button>
            </div>
        </form>
    </div>
</body>
</html>
