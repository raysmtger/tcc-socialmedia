<x-guest-layout>
    <h4 class="fw-bold mb-4">Criar conta</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <input id="name" type="text" name="name" class="form-control" placeholder="Nome" required autofocus>
        </div>

        <div class="mb-3">
            <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>

        <div class="mb-3">
            <input id="password" type="password" name="password" class="form-control" placeholder="Senha" required>
        </div>

        <div class="mb-3">
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirmar senha" required>
        </div>

        <button type="submit" class="btn btn-dark w-100">Registrar</button>

        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-white">Já tenho uma conta</a>
        </div>
    </form>
</x-guest-layout>
