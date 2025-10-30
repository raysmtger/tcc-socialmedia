@php
    $status = $item->status->value;
    $map = [
        'em_andamento' => 'bg-yellow-400 text-gray-900',
        'concluido'    => 'bg-green-500 text-white',
        'ideias'       => 'bg-blue-500 text-white',
    ];
    $badge = $map[$status] ?? 'bg-gray-300 text-gray-800';
@endphp

<div class="rounded-3xl overflow-hidden shadow bg-white flex flex-col">
    <div class="p-4">
        <div class="text-sm font-semibold">{{ $item->titulo }}</div>
        <div class="text-xs text-gray-500">
            {{ optional($item->created_at)->format('d M, Y') }}
        </div>

        <div class="mt-2 flex items-center gap-3 text-xs text-gray-700">
            <div><span class="font-medium">nome:</span> {{ $item->nome_cliente ?? '—' }}</div>
            <div><span class="font-medium">prazo:</span> {{ optional($item->prazo)->format('d/m/Y') ?? '—' }}</div>
        </div>

        <div class="mt-4 text-sm text-gray-800 whitespace-pre-line">
            {{ $item->descricao ?? '—' }}
        </div>
    </div>

    <div class="mt-auto px-4 py-3 flex items-center justify-between bg-gray-50">
        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
            {{ \App\Enums\OrganizerStatus::labels()[$status] ?? ucfirst($status) }}
        </span>

        <div class="flex items-center gap-2">
            <a href="{{ route('organizer.edit', $item) }}" class="p-2 rounded-full hover:bg-gray-200" title="Editar">
                ✏️
            </a>
            <form method="POST" action="{{ route('organizer.destroy', $item) }}"
                  onsubmit="return confirm('Excluir este card?')">
                @csrf @method('DELETE')
                <button class="p-2 rounded-full hover:bg-gray-200" title="Excluir">🗑️</button>
            </form>
        </div>
    </div>
</div>
