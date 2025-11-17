{{-- 📁 resources/views/components/idea-card.blade.php --}}

@props(['idea'])

@php
    $statusValue = $idea->status instanceof \App\Enums\OrganizerStatus
        ? $idea->status->value
        : $idea->status;

    $statusLabel = \App\Enums\OrganizerStatus::labels()[$statusValue] ?? ucfirst($statusValue);
    $statusClass = \App\Enums\OrganizerStatus::colors()[$statusValue] ?? 'bg-secondary text-white';
    
    $imagens = is_array($idea->imagens_descricao)
        ? $idea->imagens_descricao
        : json_decode($idea->imagens_descricao ?? '[]', true);
@endphp

<div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100"
     style="background-color: #fff; transition: transform 0.2s; width: 100%;">
    
    <div class="card-body text-center p-4 d-flex flex-column"
         style="border: 3px solid #f8a43d; border-radius: 20px; overflow: hidden; min-height: 420px;">
        
        {{-- Cabeçalho --}}
        <div class="flex-shrink-0">
            <h5 class="fw-bold text-dark mb-1" style="
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                line-height: 1.3;
                max-height: 2.6em;
            ">{{ $idea->titulo }}</h5>
            
            <small class="text-muted d-block mb-3" style="font-size: 0.8rem;">
                {{ $idea->created_at->format('d M, Y') }}
            </small>
        </div>

        {{-- Conteúdo rolável --}}
        <div class="flex-grow-1" style="overflow-y: auto; overflow-x: hidden; margin: 0 -0.5rem; padding: 0 0.5rem;">
            
            {{-- Informações extras --}}
            @if($statusValue !== 'ideia')
                <div class="text-start small text-secondary mb-3">
                    @if($idea->nome_cliente)
                        <p class="mb-1"><strong>Cliente:</strong> {{ $idea->nome_cliente }}</p>
                    @endif
                    @if($idea->prazo)
                        <p class="mb-1"><strong>Prazo:</strong> {{ $idea->prazo->format('d/m/Y') }}</p>
                    @endif
                    @if($idea->plataforma)
                        <p class="mb-1"><strong>Plataforma:</strong> {{ ucfirst($idea->plataforma) }}</p>
                    @endif
                    @if($idea->tipo_conteudo)
                        <p class="mb-0"><strong>Tipo:</strong> {{ str_replace('_', ' ', ucfirst($idea->tipo_conteudo)) }}</p>
                    @endif
                </div>
            @else
                @if($idea->plataforma || $idea->tipo_conteudo)
                    <div class="text-start small text-secondary mb-3">
                        @if($idea->plataforma)
                            <p class="mb-1"><strong>Plataforma:</strong> {{ ucfirst($idea->plataforma) }}</p>
                        @endif
                        @if($idea->tipo_conteudo)
                            <p class="mb-0"><strong>Tipo:</strong> {{ str_replace('_', ' ', ucfirst($idea->tipo_conteudo)) }}</p>
                        @endif
                    </div>
                @endif
            @endif

            {{-- Descrição (mantém quebras de linha) --}}
            <p class="text-dark small text-start mb-3" 
               style="white-space: pre-line; text-align: left; line-height: 1.4;">
                {{ $idea->descricao ?? 'Sem descrição adicionada.' }}
            </p>

            {{-- Imagem (primeira imagem da lista) --}}
            @if (!empty($imagens) && is_array($imagens))
                <div class="mb-3 text-center">
                    <img src="{{ Storage::url($imagens[0]) }}"
                         alt="Imagem da ideia"
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 150px; max-width: 100%; object-fit: contain;">
                </div>
            @endif
        </div>

        {{-- Rodapé --}}
        <div class="flex-shrink-0 mt-2 pt-2" style="border-top: 2px solid #f8a43d;">
            <div class="d-flex justify-content-between align-items-center">
                <span class="badge rounded-pill px-3 py-2 {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>

                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('ideas.edit', $idea->id) }}" 
                       class="text-secondary fs-5" 
                       title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <button type="button"
                            class="btn btn-link text-danger fs-5 p-0"
                            title="Excluir"
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal{{ $idea->id }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de exclusão --}}
<div class="modal fade" id="deleteModal{{ $idea->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Tem certeza que deseja excluir <strong>{{ $idea->titulo }}</strong>?</p>
                <p class="text-muted small mb-0 mt-2">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="bi bi-trash me-1"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
    }
    .card a:hover {
        color: #f8a43d !important;
    }
</style>