<x-guest-layout>
    <h4 class="fw-bold mb-4">Recuperar senha</h4>

    <p class="text-white-50">Informe seu e-mail e enviaremos um link para redefinir sua senha.</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
        </div>

        <button type="submit" class="btn btn-dark w-100">Enviar link</button>

        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-white">Voltar ao login</a>
        </div>
    </form>
</x-guest-layout>
