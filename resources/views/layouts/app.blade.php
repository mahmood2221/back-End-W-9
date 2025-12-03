<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 1rem 2rem;
        }
        nav a {
            color: white;
            margin-right: 1rem;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 2rem;
            max-width: 800px;
            margin: auto;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 1rem;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th {
            background-color: #007bff;
            color: white;
        }
        ul { 
            padding-left: 20px; 
        }
        footer {
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Laravel MVC Demo</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/features">Features</a>
            <a href="/team">Team</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} جميع الحقوق محفوظة
    </footer>
</body>
</html>
