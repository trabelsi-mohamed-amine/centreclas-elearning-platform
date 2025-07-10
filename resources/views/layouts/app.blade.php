<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CLAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom validation and notification JS -->
    <script src="{{ asset('js/custom-validations.js') }}"></script>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    {{-- Affichage conditionnel du Navbar --}}
    @if (!isset($hideNavbar) || $hideNavbar !== true)
        <x-navbar/>
    @endif

    <!-- Hidden flash message elements for JS to process -->
    @if(session('success'))
        <div id="flash-success-message" style="display: none;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div id="flash-error-message" style="display: none;">{{ session('error') }}</div>
    @endif

    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Affichage conditionnel du Footer --}}
    @if (!isset($hideFooter) || $hideFooter !== true)
        <x-footer/>
    @endif

    @stack('scripts')
</body>
</html>
