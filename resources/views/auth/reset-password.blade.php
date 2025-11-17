<x-guest-layout>
    <h4 class="fw-bold mb-4">Nova senha</h4>

    {{-- Mensagens de Erro --}}
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

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <input 
                id="email" 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="E-mail" 
                value="{{ old('email', $request->email) }}" 
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
                placeholder="Nova senha (mínimo 8 caracteres)" 
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
            <button type="submit" class="btn btn-dark">Redefinir senha</button>
        </div>

        <div class="auth-links mt-3">
            <a href="{{ route('login') }}">Voltar ao login</a>
        </div>
    </form>
</x-guest-layout>