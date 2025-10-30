@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-xl font-bold mb-4">Editar card</h1>

    <form method="POST" action="{{ route('organizer.update', $item) }}" class="bg-white p-6 rounded-2xl shadow space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium">Título</label>
            <input name="titulo" value="{{ old('titulo', $item->titulo) }}" class="w-full border rounded-lg px-3 py-2" required>
            @error('titulo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Descrição</label>
            <textarea name="descricao" rows="5" class="w-full border rounded-lg px-3 py-2">{{ old('descricao', $item->descricao) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium">Cliente</label>
                <input name="nome_cliente" value="{{ old('nome_cliente', $item->nome_cliente) }}" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Prazo</label>
                <input type="date" name="prazo" value="{{ old('prazo', optional($item->prazo)->format('Y-m-d')) }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    @foreach($labels as $value => $label)
                        <option value="{{ $value }}" @selected($item->status->value === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('organizer.index') }}" class="px-4 py-2 rounded-2xl bg-gray-100">Cancelar</a>
            <button class="px-4 py-2 rounded-2xl bg-indigo-600 text-white">Salvar</button>
        </div>
    </form>
</div>
@endsection
