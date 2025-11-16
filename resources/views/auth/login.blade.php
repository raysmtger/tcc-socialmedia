<x-guest-layout>
    <h4 class="fw-bold mb-4">Entrar</h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
        </div>

        <div class="mb-3">
            <input id="password" type="password" name="password" class="form-control" placeholder="Senha" required>
        </div>

        <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember">Lembrar-me</label>
        </div>

        <button type="submit" class="btn btn-dark w-100">Entrar</button>

        <div class="mt-3">
            <a href="{{ route('register') }}" class="text-white">Criar conta</a> |
            <a href="{{ route('password.request') }}" class="text-white">Esqueci minha senha</a>
        </div>
    </form>
</x-guest-layout>
