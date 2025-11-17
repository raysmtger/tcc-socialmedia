<x-guest-layout>
    <h4 class="fw-bold mb-4">Criar conta</h4>

    {{-- Mensagens de Erro Global --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Corrija os erros:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <input 
                id="name" 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Nome" 
                value="{{ old('name') }}"
                required 
                autofocus
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input 
                id="email" 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="E-mail" 
                value="{{ old('email') }}"
                required
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
                placeholder="Senha (mínimo 8 caracteres)" 
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                placeholder="Confirmar senha" 
                required
            >
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Cadastrar</button>
        </div>

        <div class="auth-links">
            <a href="{{ route('login') }}">Já tenho conta</a>
            <a href="{{ route('password.request') }}">Esqueci minha senha</a>
        </div>
    </form>
</x-guest-layout>