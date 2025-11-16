<x-guest-layout>
    <h4 class="fw-bold mb-4">Nova senha</h4>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email', $request->email) }}" required autofocus>
        </div>

        <div class="mb-3">
            <input id="password" type="password" name="password" class="form-control" placeholder="Nova senha" required>
        </div>

        <div class="mb-3">
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirmar senha" required>
        </div>

        <button type="submit" class="btn btn-dark w-100">Redefinir senha</button>
    </form>
</x-guest-layout>
