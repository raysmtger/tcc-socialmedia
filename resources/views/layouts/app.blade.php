<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Midia Ateliê') }}</title>
    <link rel="icon" href="{{ asset('imagens/favicon-32x32.png') }}" type="image/png">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Fonte Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- CSS customizado --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    {{-- HEADER --}}
    <header>
        <div class="container-fluid d-flex justify-content-between align-items-center">
            
            {{-- Logo --}}
            <div class="d-flex align-items-center">
                <a href="{{ route('organizer') }}">
                    <img src="{{ asset('/imagens/logo.png') }}" alt="Logo Midia Ateliê" height="50">
                </a>
            </div>

            {{-- Navegação Central --}}
            <nav class="nav-center">
                <a href="{{ route('organizer') }}" 
                   class="{{ request()->routeIs('organizer*') || request()->routeIs('ideas.*') ? 'active' : '' }}">
                    Organizador
                </a>
                <a href="{{ route('prompt.index') }}" 
                   class="{{ request()->routeIs('prompt.*') ? 'active' : '' }}">
                    Assistente IA
                </a>
            </nav>

            {{-- Logout --}}
            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-logout" title="Sair">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    {{-- CONTEÚDO PRINCIPAL --}}
    <main>
        {{ $slot }}
    </main>
</body>
</html>