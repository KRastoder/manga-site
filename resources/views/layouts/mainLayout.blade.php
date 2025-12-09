<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>

<body class = 'bg-black text-white'>
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
