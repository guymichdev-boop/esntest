<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="js/main.js">
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
        </nav>
    </header>

    <main class="container">
        <!-- Child views inject their content here -->
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 My Laravel App</p>
    </footer>
</body>
</html>
