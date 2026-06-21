<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.5;
            color: #1f2937;
            background: #f3f4f6;
        }

        main {
            max-width: 32rem;
            margin: 2rem auto;
            padding: 0 1rem 2rem;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        h1 {
            margin: 0 0 1.25rem;
            font-size: 1.5rem;
        }

        .field {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.375rem;
            font-weight: 600;
            font-size: 0.875rem;
        }

        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font: inherit;
        }

        input:focus {
            outline: 2px solid #2563eb;
            outline-offset: 1px;
            border-color: #2563eb;
        }

        .error {
            margin-top: 0.375rem;
            color: #b91c1c;
            font-size: 0.875rem;
        }

        button,
        .button {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            background: #2563eb;
            color: #fff;
            font: inherit;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        button:hover,
        .button:hover {
            background: #1d4ed8;
        }

        .message {
            margin: 0 0 1.25rem;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
        }

        .message--due {
            background: #fef3c7;
            color: #92400e;
        }

        .message--not-due {
            background: #d1fae5;
            color: #065f46;
        }

        .details {
            margin: 0 0 1.25rem;
        }

        .details dt {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            color: #6b7280;
        }

        .details dd {
            margin: 0 0 0.75rem;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <div class="card">
            @yield('content')
        </div>
    </main>
</body>
</html>
