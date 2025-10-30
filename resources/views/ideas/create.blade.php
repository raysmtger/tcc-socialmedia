@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-8">
    {{-- título da página --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Criar Novo Card</h1>
            <p class="text-gray-600 text-sm">Preencha os campos abaixo para adicionar um novo card.</p>
        </div>
        <a href="{{ route('organizer.index') }}"
           class="rounded-2xl px-5 py-2 bg-gray-200 text-gray-700 font-medium shadow hover:bg-gray-300 transition">
            ← Voltar
        </a>
    </div>

    {{-- formulário --}}
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <form method="POST" action="{{ route('organizer.store') }}" class="space-y-6">
            @csrf

            {{-- título --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input name="titulo" required
                       value="{{ old('titulo') }}"
                       placeholder="Digite o título do card"
                       class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                @error('titulo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    @foreach($labels as $value => $label)
                        <option value="{{ $value }}" @selected(old('status') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- prazo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Prazo</label>
                <input type="date" name="prazo"
                       value="{{ old('prazo') }}"
                       class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                @error('prazo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- conteúdo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descrição / Conteúdo</label>
                <textarea name="conteudo" rows="5"
                          placeholder="Digite os detalhes do card"
                          class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('conteudo') }}</textarea>
                @error('conteudo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- botões --}}
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('organizer.index') }}"
                   class="rounded-2xl px-5 py-2 bg-gray-200 text-gray-700 font-medium shadow hover:bg-gray-300 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="rounded-2xl px-6 py-3 bg-indigo-600 text-white font-medium shadow hover:bg-indigo-700 transition">
                    Salvar Card
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
