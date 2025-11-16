<x-guest-layout>
    <h4 class="fw-bold mb-4">Confirme sua senha</h4>
    <p class="text-white-50">Por segurança, confirme sua senha antes de continuar.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <input id="password" type="password" name="password" class="form-control" placeholder="Senha atual" required autofocus>
        </div>

        <button type="submit" class="btn btn-dark w-100">Confirmar</button>
    </form>
</x-guest-layout>
