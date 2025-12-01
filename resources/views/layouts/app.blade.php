<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Каталог одягу') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles + Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50 text-gray-900 antialiased">

<div class="min-h-screen flex flex-col">

    <!-- Header -->
    @include('layouts.navigation')

    <!-- Optional header slot -->
    @if (isset($header))
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-6">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Main content -->
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 py-10 animate-fade">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            © {{ date('Y') }} Каталог одягу — всі права захищені.
        </div>
    </footer>

</div>

</body>
</html>
