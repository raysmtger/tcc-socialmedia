<x-app-layout>
    <div class="container py-5">
        

        {{-- adicionar futuramente filtros --}}
        <div class="card border-0 shadow-sm rounded-3 mb-4" style="border: 2px solid #f8a43d !important;">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <small class="text-muted d-block mb-1">Total de gerações:</small>
                        <strong style="color: #f29d35;">{{ $prompts->total() }}</strong>
                    </div>
                    <div class="col-md-9 text-end">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Mostrando {{ $prompts->firstItem() ?? 0 }} - {{ $prompts->lastItem() ?? 0 }} de {{ $prompts->total() }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lista de Prompts --}}
        @if($prompts->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                <p class="text-muted fs-5">Nenhuma geração encontrada.</p>
                <a href="{{ route('prompt.index') }}" class="btn text-white rounded-pill px-4" style="background-color: #f29d35;">
                    <i class="bi bi-plus-circle me-1"></i> Criar primeira geração
                </a>
            </div>
        @else
            <div class="row g-3">
                @foreach($prompts as $prompt)
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 hover-card" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                
                                {{-- Ícone e Tipo --}}
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 fs-3" style="color: #f29d35;">
                                            {!! \App\Models\Prompt::getTypeIcons()[$prompt->type] !!}
                                        </span>
                                        <div>
                                            <strong class="text-dark d-block">
                                                {{ \App\Models\Prompt::getTypeLabels()[$prompt->type] }}
                                            </strong>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $prompt->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Preview do conteúdo --}}
                                <div class="col-md-5">
                                    <small class="text-muted">
                                        @if(isset($prompt->input_data['tema']))
                                            <strong>Tema:</strong> {{ Str::limit($prompt->input_data['tema'], 60) }}
                                        @elseif(isset($prompt->input_data['campanha']))
                                            <strong>Campanha:</strong> {{ Str::limit($prompt->input_data['campanha'], 60) }}
                                        @elseif(isset($prompt->input_data['nicho']))
                                            <strong>Nicho:</strong> {{ $prompt->input_data['nicho'] }}
                                        @elseif(isset($prompt->input_data['produto']))
                                            <strong>Produto:</strong> {{ Str::limit($prompt->input_data['produto'], 60) }}
                                        @endif
                                    </small>
                                </div>

                                {{-- Badges e Ações --}}
                                <div class="col-md-4 text-end">
                                    @if($prompt->favorited)
                                        <span class="badge rounded-pill px-3 py-2 me-2" style="background-color: #f29d35;">
                                            <i class="bi bi-star-fill"></i> Favorito
                                        </span>
                                    @endif

                                    <a href="{{ route('prompt.show', $prompt->id) }}" 
                                       class="btn btn-sm rounded-pill px-3" 
                                       style="background-color: #f8a43d; color: white;">
                                        <i class="bi bi-eye me-1"></i> Ver
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $prompts->links() }}
            </div>
        @endif

    </div>
</x-app-layout>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(248, 164, 61, 0.15) !important;
    }
</style>