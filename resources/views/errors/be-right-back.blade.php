<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>{{ config('app.name', 'Kayise IT') }} — Be right back</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            background: #f4f4f5;
            color: #18181b;
            padding: 1.5rem;
        }
        .card {
            max-width: 28rem;
            text-align: center;
            background: #fff;
            border-radius: 0.75rem;
            padding: 2rem 1.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.08), 0 2px 4px -2px rgb(0 0 0 / 0.06);
        }
        h1 {
            margin: 0 0 0.75rem;
            font-size: 1.375rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        p {
            margin: 0;
            font-size: 0.9375rem;
            line-height: 1.6;
            color: #52525b;
        }
        a {
            color: #4f46e5;
            text-decoration: underline;
            text-underline-offset: 2px;
        }
        a:hover { color: #4338ca; }
        .hint { margin-top: 1.25rem; font-size: 0.875rem; }
    </style>
</head>
<body>
    <main class="card" id="brb-public-page">
        <h1>Be right back</h1>
        <p>We’re updating something on our side. Please try again in a few minutes.</p>
        <p class="hint">
            Need help? Email <a href="mailto:info@kayiseit.com">info@kayiseit.com</a>
            or <a href="{{ url('/') }}">return to the home page</a>.
        </p>
    </main>
</body>
</html>
