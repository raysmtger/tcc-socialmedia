<x-guest-layout>
    <h4 class="fw-bold mb-4">Verificar e-mail</h4>

    <p class="text-muted mb-4" style="font-size: 0.9rem;">
        Obrigado por se cadastrar! Antes de começar, verifique seu e-mail clicando no link que enviamos. 
        Se não recebeu o e-mail, enviaremos outro com prazer.
    </p>

    {{-- Mensagem de Sucesso --}}
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Um novo link de verificação foi enviado para o e-mail cadastrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex gap-2 justify-content-between align-items-center">
        {{-- Reenviar Email --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-dark">
                Reenviar e-mail
            </button>
        </form>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
                Sair
            </button>
        </form>
    </div>
</x-guest-layout>