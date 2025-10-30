@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- título e botão --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Meus Cards</h1>
            <p class="text-gray-600 text-sm">Visualize, edite e gerencie seus cards de forma prática.</p>
        </div>
        <a href="{{ route('organizer.create') }}"
           class="rounded-2xl px-5 py-3 bg-indigo-600 text-white font-medium shadow hover:bg-indigo-700 transition">
            + Criar Novo Card
        </a>
    </div>

    {{-- mensagens de sucesso --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- grid de cards --}}
    @if($cards->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cards as $card)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 flex flex-col justify-between hover:shadow-xl transition">
                    <div>
                        {{-- título --}}
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $card->titulo }}</h2>

                        {{-- status --}}
                        <span class="
                            px-3 py-1 rounded-full text-xs font-medium
                            @if($card->status === 'feito') bg-green-100 text-green-700
                            @elseif($card->status === 'andamento') bg-yellow-100 text-yellow-700
                            @else bg-gray-100 text-gray-600
                            @endif
                        ">
                            {{ ucfirst($card->status) }}
                        </span>

                        {{-- prazo --}}
                        @if($card->prazo)
                            <p class="mt-3 text-sm text-gray-500">
                                Prazo: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($card->prazo)->format('d/m/Y') }}</span>
                            </p>
                        @endif

                        {{-- conteúdo --}}
                        <p class="mt-4 text-gray-700 text-sm line-clamp-3">
                            {{ $card->conteudo ?: 'Sem descrição disponível.' }}
                        </p>
                    </div>

                    {{-- botões --}}
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('organizer.edit', $card->id) }}"
                           class="rounded-xl px-4 py-2 bg-blue-500 text-white text-sm font-medium shadow hover:bg-blue-600 transition">
                            Editar
                        </a>

                        <form action="{{ route('organizer.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este card?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="rounded-xl px-4 py-2 bg-red-500 text-white text-sm font-medium shadow hover:bg-red-600 transition">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- mensagem de vazio --}}
        <div class="text-center py-16">
            <p class="text-gray-600 text-lg">Nenhum card criado ainda.</p>
            <a href="{{ route('organizer.create') }}"
               class="mt-4 inline-block rounded-xl px-5 py-3 bg-indigo-600 text-white font-medium shadow hover:bg-indigo-700 transition">
                Criar seu primeiro card
            </a>
        </div>
    @endif
</div>
@endsection
