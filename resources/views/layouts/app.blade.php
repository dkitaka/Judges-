<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judges Scoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;600&family=Playfair+Display:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Libre Franklin', sans-serif;
        }
        .serif-title {
            font-family: 'Playfair Display', serif;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #000, transparent);
        }
    </style>
</head>
<body class="bg-white text-gray-900">
    <nav class="border-b border-black">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col items-center md:flex-row md:justify-between">
                <div class="text-3xl font-bold serif-title mb-4 md:mb-0">
                    <a href="{{ route('scoreboard') }}" class="text-black hover:text-gray-700">Judges Scoring System</a>
                </div>
                <div class="space-x-8 text-sm uppercase tracking-wider">
                    <a href="{{ route('scoreboard') }}" class="text-black hover:text-gray-600 border-b-2 border-transparent hover:border-black transition-all duration-200">Scoreboard</a>
                    <a href="{{ route('admin.index') }}" class="text-black hover:text-gray-600 border-b-2 border-transparent hover:border-black transition-all duration-200">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="container mx-auto px-6 mt-6">
            <div class="border-l-4 border-black bg-gray-50 p-4" role="alert">
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-black">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center text-sm text-gray-600">
                © {{ date('Y') }} Judges Scoring System. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
