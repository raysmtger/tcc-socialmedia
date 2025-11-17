<x-guest-layout>
    <h4 class="fw-bold mb-4">Entrar</h4>

    {{-- Mensagens de Erro Globais --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Erro!</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Mensagem de Sucesso (ex: "Email de recuperação enviado") --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input 
                id="email" 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="E-mail" 
                value="{{ old('email') }}"
                required 
                autofocus
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input 
                id="password" 
                type="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Senha" 
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Lembrar-me</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Entrar</button>
        </div>

        <div class="auth-links">
            <a href="{{ route('register') }}">Criar conta</a>
            <a href="{{ route('password.request') }}">Esqueci minha senha</a>
        </div>
    </form>
</x-guest-layout>