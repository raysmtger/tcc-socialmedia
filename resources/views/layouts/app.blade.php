<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Midia Ateliê') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    {{-- Fonte Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        header {
            background-color: #F29D35;
            color: #000;
            padding: 15px 40px;
        }

        .nav-center {
            background-color: #fff;
            border-radius: 50px;
            padding: 5px 20px;
            display: inline-flex;
            align-items: center;
        }

        .nav-center a {
            text-decoration: none;
            color: #000;
            font-weight: 500;
            margin: 0 10px;
        }

        .nav-center a.active {
            color: #F29D35;
            font-weight: 600;
        }

        .btn-logout {
            background-color: #fff;
            border: none;
            color: #000;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background-color: #f0f0f0;
        }

        /* Ajustes gerais */
        main {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-between align-items-center">
        {{-- Logo --}}
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Midia Ateliê" height="50" class="me-2">
        </div>

        {{-- Central - Botões Organizer / Prompt --}}
        <div class="nav-center">
            <a href="{{ route('organizer') }}" class="active">organizer</a>
            <a href="{{ route('prompt') }}">Prompt</a>
        </div>

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
    </header>

    <main>
        {{ $slot }}
    </main>
</body>
</html>
