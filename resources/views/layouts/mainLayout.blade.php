<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body >
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
</body>

</html>
