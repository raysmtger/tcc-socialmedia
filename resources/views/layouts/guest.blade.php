<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Midia Ateliê') }}</title>
    <link rel="icon" href="{{ asset('imagens/favicon-32x32.png') }}" type="image/png">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Fonte Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff;  
            font-family: 'Poppins', sans-serif;
            color: #222;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background-color: #f8a43d;  
            border-radius: 20px;
            color: #000;
            box-shadow: 0 8px 24px rgba(248, 164, 61, 0.3);
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 420px;
        }

        .auth-card h4 {
            color: #000;
            font-weight: 700;
        }

        .btn-dark {
            background-color: #fff; 
            color: #000;
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background-color: transparent;
            color: #fff;
            border-color: #fff;
            transform: translateY(-2px);
        }

        .form-control {
            border: none !important;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            padding: 12px 16px;
            font-size: 1rem;
            color: #000;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            border: none !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.5);
        }

        /* ⭐ Feedback de erro */
        .form-control.is-invalid {
            border: 2px solid #dc3545 !important;
            background-color: #fff;
        }

        .invalid-feedback {
            display: block;
            color: #fff;
            background-color: rgba(220, 53, 69, 0.9);
            padding: 0.5rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* ⭐ Alertas */
        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.15);
            color: #721c24;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.15);
            color: #155724;
        }

        .alert ul {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }

        /* ⭐ Links com espaçamento melhor */
        .auth-links {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center;
            margin-top: 1.5rem;  
            gap: 1rem;  
            font-size: 0.95rem;
        }

        .auth-links a {
            color: #fff !important;
            font-weight: 600;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        .auth-links a:hover {
            text-decoration: underline !important;
            opacity: 0.85;
        }

        /* Checkbox */
        .form-check-input {
            border: 2px solid #fff;
        }

        .form-check-input:checked {
            background-color: #fff;
            border-color: #fff;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }

        .form-check-label {
            color: #000;
            font-weight: 500;
        }

        /* Texto muted */
        .text-muted {
            color: rgba(0, 0, 0, 0.7) !important;
        }

        /* Responsivo */
        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }

            .auth-links {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <img src="{{ asset('imagens/logo.png') }}" alt="Midia Ateliê" width="250">
        </div>

        {{ $slot }}
    </div>
</body>
</html>