<x-guest-layout>
    <h4 class="fw-bold mb-4">Recuperar senha</h4>

    <p class="text-muted mb-4" style="font-size: 0.9rem;">
        Informe seu e-mail e enviaremos um link para redefinir sua senha.
    </p>

    {{-- Mensagem de Sucesso --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Mensagens de Erro --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('email') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Enviar link</button>
        </div>
        
        <div class="auth-links">
            <a href="{{ route('login') }}">Voltar ao login</a>
            <a href="{{ route('register') }}">Criar nova conta</a>
        </div>
    </form>
</x-guest-layout>