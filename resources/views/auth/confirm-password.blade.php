<x-guest-layout>
    <h4 class="fw-bold mb-4">Confirme sua senha</h4>
    <p class="text-muted mb-4" style="font-size: 0.9rem;">
        Por segurança, confirme sua senha antes de continuar.
    </p>

    {{-- Mensagens de Erro --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <input 
                id="password" 
                type="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Senha atual" 
                required 
                autofocus
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Confirmar</button>
        </div>
    </form>
</x-guest-layout>