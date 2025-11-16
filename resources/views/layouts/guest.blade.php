<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Midia Ateliê') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #ffffffff;
            font-family: 'Poppins', sans-serif;
            color: #222;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            background-color: #f8a43dff;
            border-radius: 20px;
            color: rgba(0, 0, 0, 0.68) ;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
        }

        .btn-dark {
            background-color: #fab168ff;
            border: none;
        }

        .btn-dark:hover {
            background-color: #f6ac62ff;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Midia Ateliê" width="100">
        </div>

        {{ $slot }}
    </div>
</body>
</html>
